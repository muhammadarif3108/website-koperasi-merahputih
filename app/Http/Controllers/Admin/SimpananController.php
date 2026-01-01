<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SimpananController extends Controller
{
    public function index()
    {
        $simpanan = Simpanan::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.simpanan.index', compact('simpanan'));
    }

    public function show(Simpanan $simpanan)
    {
        return view('admin.simpanan.show', compact('simpanan'));
    }

    public function approve(Simpanan $simpanan)
    {
        DB::transaction(function () use ($simpanan) {
            $user = $simpanan->user;

            // Update saldo berdasarkan jenis transaksi
            if ($simpanan->jenis_transaksi === 'setor') {
                $user->saldo_simpanan += $simpanan->jumlah;
            } else { // tarik
                $user->saldo_simpanan -= $simpanan->jumlah;
            }

            $user->save();

            // Update status simpanan
            $simpanan->update([
                'status' => 'disetujui',
                'approved_at' => now(),
                'approved_by' => Auth::id()
            ]);
        });

        return redirect()->route('admin.simpanan.index')
            ->with('success', 'Transaksi simpanan berhasil disetujui!');
    }

    public function reject(Request $request, Simpanan $simpanan)
    {
        $validated = $request->validate([
            'alasan_penolakan' => 'required|string',
        ]);

        $simpanan->update([
            'status' => 'ditolak',
            'alasan_penolakan' => $validated['alasan_penolakan'],
            'approved_by' => Auth::id()
        ]);

        return redirect()->route('admin.simpanan.index')
            ->with('success', 'Transaksi simpanan berhasil ditolak!');
    }
}
