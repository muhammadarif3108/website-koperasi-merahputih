<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SimpananController extends Controller
{
    public function index()
    {
        $simpanans = Simpanan::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.simpanan.index', compact('simpanans'));
    }

    public function show(Simpanan $simpanan)
    {
        return view('admin.simpanan.show', compact('simpanan'));
    }

    public function approve(Simpanan $simpanan)
    {
        DB::transaction(function () use ($simpanan) {
            // Update status simpanan
            $simpanan->update([
                'status' => 'disetujui',
                'approved_at' => now()
            ]);

            // Tambahkan saldo user
            $user = $simpanan->user;
            $user->saldo_simpanan += $simpanan->nominal;
            $user->save();
        });

        return redirect()->route('admin.simpanan.index')
            ->with('success', 'Setoran berhasil disetujui dan saldo telah ditambahkan!');
    }

    public function reject(Request $request, Simpanan $simpanan)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string',
        ]);

        $simpanan->update([
            'status' => 'ditolak',
            'keterangan' => $validated['keterangan']
        ]);

        return redirect()->route('admin.simpanan.index')
            ->with('success', 'Setoran berhasil ditolak!');
    }

    public function members()
    {
        $members = User::where('role', 'member')
            ->withCount(['simpanan as total_setoran' => function ($query) {
                $query->where('status', 'disetujui');
            }])
            ->get();

        return view('admin.simpanan.members', compact('members'));
    }

    public function memberDetail(User $user)
    {
        if ($user->role !== 'member') {
            abort(404);
        }

        $riwayat = Simpanan::where('user_id', $user->id)
            ->where('status', 'disetujui')
            ->orderBy('approved_at', 'desc')
            ->get();

        return view('admin.simpanan.member-detail', compact('user', 'riwayat'));
    }
}
