<?php

// app/Http/Controllers/Admin/SuratController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        $surats = Surat::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.surat.index', compact('surats'));
    }

    public function show(Surat $surat)
    {
        return view('admin.surat.show', compact('surat'));
    }

    public function approve(Request $request, Surat $surat)
    {
        $validated = $request->validate([
            'file_surat' => 'required|file|mimes:pdf|max:5120',
        ]);

        $path = $request->file('file_surat')->store('surat', 'public');

        $surat->update([
            'status' => 'disetujui',
            'file_surat' => $path
        ]);

        return redirect()->route('admin.surat.index')
            ->with('success', 'Surat berhasil disetujui!');
    }

    public function reject(Request $request, Surat $surat)
    {
        $validated = $request->validate([
            'alasan_penolakan' => 'required|string',
        ]);

        $surat->update([
            'status' => 'ditolak',
            'alasan_penolakan' => $validated['alasan_penolakan']
        ]);

        return redirect()->route('admin.surat.index')
            ->with('success', 'Surat berhasil ditolak!');
    }
}
