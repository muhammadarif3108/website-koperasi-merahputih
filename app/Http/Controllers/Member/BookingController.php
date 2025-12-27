<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $equipment = Equipment::where('stock', '>', 0)->get();
        return view('member.booking.index', compact('equipment'));
    }

    public function show(Equipment $equipment)
    {
        return view('member.booking.show', compact('equipment'));
    }

    public function create(Equipment $equipment)
    {
        if ($equipment->available_stock <= 0) {
            return redirect()->route('member.booking.index')
                ->with('error', 'Alat tidak tersedia untuk disewa.');
        }

        return view('member.booking.create', compact('equipment'));
    }

    public function store(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:booking_date',
        ]);

        $bookingDate = \Carbon\Carbon::parse($validated['booking_date']);
        $returnDate = \Carbon\Carbon::parse($validated['return_date']);
        $duration = $bookingDate->diffInDays($returnDate) + 1;
        $totalPrice = $equipment->price_per_day * $duration;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'equipment_id' => $equipment->id,
            'booking_date' => $validated['booking_date'],
            'return_date' => $validated['return_date'],
            'duration_days' => $duration,
            'price_per_day' => $equipment->price_per_day,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        return redirect()->route('member.booking.my-bookings')
            ->with('success', 'Booking berhasil dibuat! Silakan upload bukti pembayaran.');
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('equipment')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('member.booking.my-bookings', compact('bookings'));
    }

    public function showBooking(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('member.booking.detail', compact('booking'));
    }

    public function uploadPayment(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        $path = $request->file('bukti_pembayaran')->store('payments', 'public');

        $booking->update([
            'bukti_pembayaran' => $path
        ]);

        return redirect()->route('member.booking.detail', $booking)
            ->with('success', 'Bukti pembayaran berhasil diupload!');
    }
}
