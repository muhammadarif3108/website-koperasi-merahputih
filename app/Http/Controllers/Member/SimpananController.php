<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SimpananController extends Controller
{
    public function index()
    {
        $simpanan = Simpanan::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $user = Auth::user();

        return view('member.simpanan.index', compact('simpanan', 'user'));
    }

    public function create()
    {
        return view('member.simpanan.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'jenis_transaksi' => 'required|in:setor,tarik',
            'jumlah' => 'required|numeric|min:10000',
            'keterangan' => 'nullable|string',
        ];

        // Bukti transaksi hanya wajib untuk setoran
        if ($request->jenis_transaksi === 'setor') {
            $rules['bukti_transaksi'] = 'required|image|max:2048';
        } else {
            $rules['bukti_transaksi'] = 'nullable|image|max:2048';
        }

        $validated = $request->validate($rules);

        // Validasi tambahan untuk penarikan
        if ($validated['jenis_transaksi'] === 'tarik') {
            $user = Auth::user();
            if ($user->saldo_simpanan < $validated['jumlah']) {
                return back()->withErrors(['jumlah' => 'Saldo simpanan tidak mencukupi!'])->withInput();
            }
        }

        $path = null;
        if ($request->hasFile('bukti_transaksi')) {
            $path = $request->file('bukti_transaksi')->store('simpanan', 'public');
        }

        Simpanan::create([
            'user_id' => Auth::id(),
            'jenis_transaksi' => $validated['jenis_transaksi'],
            'jumlah' => $validated['jumlah'],
            'keterangan' => $validated['keterangan'],
            'bukti_transaksi' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('member.simpanan.index')
            ->with('success', 'Transaksi simpanan berhasil diajukan!');
    }

    public function show(Simpanan $simpanan)
    {
        // Pastikan user hanya bisa lihat simpanan miliknya
        if ($simpanan->user_id !== Auth::id()) {
            abort(403);
        }

        return view('member.simpanan.show', compact('simpanan'));
    }
}
