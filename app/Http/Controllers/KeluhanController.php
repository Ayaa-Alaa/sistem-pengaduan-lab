<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KeluhanController extends Controller
{
    public function index()
    {
        $keluhans = Keluhan::where('user_id', Auth::id())
                           ->latest()->paginate(10);
        return view('mahasiswa.dashboard', compact('keluhans'));
    }

    public function create()
    {
        return view('mahasiswa.keluhan-buat');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori'  => 'required|in:hardware,software,jaringan,fasilitas,lainnya',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'foto'      => 'nullable|image|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('keluhan', 'public');
        }

        $keluhan = Keluhan::create([
            'user_id'   => Auth::id(),
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori'  => $request->kategori,
            'prioritas' => $request->prioritas,
            'foto'      => $fotoPath,
        ]);

        // Kirim notifikasi ke semua admin
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notifikasi::create([
                'user_id' => $admin->id,
                'judul'   => 'Keluhan Baru Masuk',
                'pesan'   => 'Keluhan baru dari ' . Auth::user()->name . ': ' . $keluhan->judul,
                'url'     => route('admin.keluhan.detail', $keluhan->id),
            ]);
        }

        return redirect()->route('dashboard')
                         ->with('success', 'Keluhan berhasil dikirim!');
    }

    public function show($id)
    {
        $keluhan = Keluhan::where('user_id', Auth::id())->findOrFail($id);
        return view('mahasiswa.keluhan-detail', compact('keluhan'));
    }
}