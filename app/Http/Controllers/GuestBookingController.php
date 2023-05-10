<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\GuestBooking;
use App\Models\HostelRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guestBookings = GuestBooking::all();
        return view('pages.guest-booking.index')->with('guestBookings', $guestBookings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = HostelRoom::where('status', 'Available')
            ->get();
        return view('pages.guest-booking.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'bed_number' => 'required|max:255|exists:bed,bed_number',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255|',
            'email' => 'required|email|max:255|exists:users,email',
            'phone_number' => 'required|max:255|',
            'check_in_date' => 'required|date|max:255',
            'check_out_date' => 'required|date|max:255',
            'amount_paid' => 'required|numeric',
            'balance' => 'required|numeric'
        ]);

        $user = DB::table('users')
            ->where('email', '=', $request->email)
            ->select('id')
            ->first();

        $bed = DB::table('bed')
            ->where('bed_number', '=', $request->bed_number)
            ->select('*')
            ->first();

        GuestBooking::create([
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'email' => $attributes['email'],
            'phone_number' => $attributes['phone_number'],
            'check_in_date' => $attributes['check_in_date'],
            'check_out_date' => $attributes['check_out_date'],
            'amount_paid' => $attributes['amount_paid'],
            'balance' => $attributes['balance'],
            'user_id' => $user->id,
            'hostel_room_id' => $bed->hostel_room_id,
            'bed_id' => $bed->id
        ]);

        // update the availability of the bed to "occupied"
        Bed::where('id', $bed->id)
            ->update(['availability' => 'occupied']);

        return redirect('guest-booking')->with('flash_message', 'Guest Booking Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = GuestBooking::find($id);
        return view('pages.guest-booking.show')->with('booking', $booking);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rooms = HostelRoom::where('status', 'Available')
            ->get();

        $booking = GuestBooking::find($id);

        return view('pages.guest-booking.edit', compact('rooms', 'booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = GuestBooking::find($id);

        $attributes = request()->validate([
            'bed_number' => 'required|max:255|exists:bed,bed_number',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255|',
            'email' => 'required|email|max:255|exists:users,email',
            'phone_number' => 'required|max:255|',
            'check_in_date' => 'required|date|max:255',
            'check_out_date' => 'required|date|max:255',
            'amount_paid' => 'required|numeric',
            'balance' => 'required|numeric'
        ]);

        $user = DB::table('users')
            ->where('email', '=', $request->email)
            ->select('id')
            ->first();

        $bed = DB::table('bed')
            ->where('bed_number', '=', $request->bed_number)
            ->select('*')
            ->first();


        $booking->first_name = $attributes['first_name'];
        $booking->last_name = $attributes['last_name'];
        $booking->email = $attributes['email'];
        $booking->phone_number = $attributes['phone_number'];
        $booking->check_in_date = $attributes['check_in_date'];
        $booking->check_out_date = $attributes['check_out_date'];
        $booking->amount_paid = $attributes['amount_paid'];
        $booking->balance = $attributes['balance'];
        $booking->user_id = $user->id;
        $booking->hostel_room_id = $bed->hostel_room_id;
        $booking->bed_id = $bed->id;
        $booking->save();

        return redirect('guest-booking')->with('flash_message', 'Guest Booking Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        GuestBooking::destroy($id);
        return redirect('guest-booking')->with('flash_message', 'Guest Booking deleted!');
    }
}
