<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Facility;
use App\Models\GuestBooking;
use App\Models\HostelRoom;
use App\Models\HostelRoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = HostelRoomType::all();
        $facilities = Facility::all();
        $rooms = HostelRoom::where('status', 'Available')
                ->get();

        return view('landingPage', compact('categories', 'facilities', 'rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $hostelRoom = HostelRoom::find($id);

        $beds = DB::table('bed')
            ->where('hostel_room_id', $id)
            ->where('availability', 'vacant')
            ->select('bed_number')
            ->get();

        return view('guest.createBooking', compact('hostelRoom', 'beds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $guest = request()->user();

        $attributes = request()->validate([
            'bed_number' => 'required|max:255|exists:bed,bed_number',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255|',
            'email' => 'required|email|max:255|',
            'phone_number' => 'required|max:255|',
            'check_in_date' => 'required|date|max:255',
            'check_out_date' => 'required|date|max:255',
            'amount_paid' => 'required|numeric',
            'balance' => 'required|numeric'
        ]);

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
            'user_id' => $guest->id,
            'hostel_room_id' => $bed->hostel_room_id,
            'bed_id' => $bed->id
        ]);

        // update the availability of the bed to "occupied"
        Bed::where('id', $bed->id)
            ->update(['availability' => 'occupied']);

        return redirect('guest')->with('flash_message', 'Thank you for Booking!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getBookings()
    {
        $user = request()->user();

        $bookings = GuestBooking::where('user_id', $user->id)
                ->get();

        return view('guest.getBookings', compact('bookings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        GuestBooking::destroy($id);
        return redirect('guest/bookings')->with('flash_message', 'Guest Booking canceled!');
    }
}
