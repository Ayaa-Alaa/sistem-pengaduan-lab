<?php
namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total'    => Keluhan::count(),
            'pending'  => Keluhan::where('status', 'pending')->count(),
            'diproses' => Keluhan::where('status', 'diproses')->count(),
            'selesai'  => Keluhan::where('status', 'selesai')->count(),
        ];
        $keluhans = Keluhan::with('user')->latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'keluhans'));
    }

    public function keluhanList(Request $request)
    {
        $query = Keluhan::with('user');

        if ($request->status)   $query->where('status', $request->status);
        if ($request->kategori) $query->where('kategori', $request->kategori);
        if ($request->search)   $query->where('judul', 'like', '%'.$request->search.'%');

        $keluhans = $query->latest()->paginate(10);
        return view('admin.keluhan-list', compact('keluhans'));
    }

    public function keluhanDetail($id)
    {
        $keluhan = Keluhan::with('user')->findOrFail($id);
        return view('admin.keluhan-detail', compact('keluhan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status'        => 'required|in:pending,diproses,selesai,ditolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $keluhan = Keluhan::findOrFail($id);
        $keluhan->update([
            'status'        => $request->status,
            'catatan_admin' => $request->catatan_admin,
            'handled_by'    => Auth::id(),
            'resolved_at'   => in_array($request->status, ['selesai','ditolak']) ? now() : null,
        ]);

        // Notifikasi ke mahasiswa
        Notifikasi::create([
            'user_id' => $keluhan->user_id,
            'judul'   => 'Status Keluhan Diperbarui',
            'pesan'   => 'Keluhan "' . $keluhan->judul . '" sekarang berstatus: ' . strtoupper($request->status),
            'url'     => route('keluhan.show', $keluhan->id),
        ]);

        return back()->with('success', 'Status keluhan berhasil diperbarui!');
    }

    public function laporan(Request $request)
    {
        $keluhans = Keluhan::with('user')
            ->when($request->bulan, fn($q) => $q->whereMonth('created_at', $request->bulan))
            ->when($request->tahun, fn($q) => $q->whereYear('created_at', $request->tahun))
            ->get();

        $stats = [
            'total'    => $keluhans->count(),
            'selesai'  => $keluhans->where('status', 'selesai')->count(),
            'pending'  => $keluhans->where('status', 'pending')->count(),
            'ditolak'  => $keluhans->where('status', 'ditolak')->count(),
        ];

        return view('admin.laporan', compact('keluhans', 'stats'));
    }

    public function exportPdf(Request $request)
    {
    $keluhans = Keluhan::with('user')
        ->when($request->bulan, fn($q) => $q->whereMonth('created_at', $request->bulan))
        ->when($request->tahun, fn($q) => $q->whereYear('created_at', $request->tahun))
        ->get();

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.laporan-pdf', compact('keluhans'));
    return $pdf->download('laporan-keluhan.pdf');
    }
}