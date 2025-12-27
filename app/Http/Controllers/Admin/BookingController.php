<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'equipment'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function approve(Booking $booking)
    {
        DB::transaction(function () use ($booking) {
            $booking->update([
                'status' => 'disetujui',
                'approved_at' => now()
            ]);
        });

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil disetujui!');
    }

    public function reject(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string',
        ]);

        $booking->update([
            'status' => 'dibatalkan',
            'keterangan' => $validated['keterangan']
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil ditolak!');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,disetujui,berlangsung,selesai,dibatalkan',
        ]);

        $booking->update($validated);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Status booking berhasil diupdate!');
    }
}
