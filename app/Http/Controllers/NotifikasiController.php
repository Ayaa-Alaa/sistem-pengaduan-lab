<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasis = Notifikasi::where('user_id', Auth::id())
                                 ->latest()->get();
        return view('notifikasi.index', compact('notifikasis'));
    }

    public function markRead($id)
    {
        Notifikasi::where('id', $id)
                  ->where('user_id', Auth::id())
                  ->update(['dibaca' => true]);
        return back();
    }
}