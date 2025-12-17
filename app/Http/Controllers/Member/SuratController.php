<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function index()
    {
        $surats = Surat::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('member.surat.index', compact('surats'));
    }

    public function create()
    {
        return view('member.surat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_surat' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Surat::create([
            'user_id' => Auth::id(),
            'jenis_surat' => $validated['jenis_surat'],
            'keperluan' => $validated['keperluan'],
            'deskripsi' => $validated['deskripsi'],
            'status' => 'pending'
        ]);

        return redirect()->route('member.surat.index')
            ->with('success', 'Surat berhasil diajukan!');
    }

    public function show(Surat $surat)
    {
        // Pastikan user hanya bisa lihat surat miliknya
        if ($surat->user_id !== Auth::id()) {
            abort(403);
        }

        return view('member.surat.show', compact('surat'));
    }

    public function download(Surat $surat)
    {
        // Pastikan user hanya bisa download surat miliknya yang sudah disetujui
        if ($surat->user_id !== Auth::id() || $surat->status !== 'disetujui' || !$surat->file_surat) {
            abort(403);
        }

        return Storage::disk('public')->download($surat->file_surat);
    }
}
