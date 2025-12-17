<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimpananController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $simpanans = Simpanan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('member.simpanan.index', compact('simpanans', 'user'));
    }

    public function create()
    {
        return view('member.simpanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nominal' => 'required|numeric|min:10000',
            'bukti_transfer' => 'required|image|max:2048',
        ]);

        $path = $request->file('bukti_transfer')->store('transfers', 'public');

        Simpanan::create([
            'user_id' => Auth::id(),
            'nominal' => $validated['nominal'],
            'bukti_transfer' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('member.simpanan.index')
            ->with('success', 'Setoran simpanan berhasil diajukan!');
    }

    public function show(Simpanan $simpanan)
    {
        if ($simpanan->user_id !== Auth::id()) {
            abort(403);
        }

        return view('member.simpanan.show', compact('simpanan'));
    }

    public function history()
    {
        $user = Auth::user();
        $riwayat = Simpanan::where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->orderBy('approved_at', 'desc')
            ->get();

        return view('member.simpanan.history', compact('riwayat', 'user'));
    }
}
