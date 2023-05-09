<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\HostelBooking;
use App\Models\HostelRoom;
use App\Models\HostelRoomType;
use App\Models\tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class HostelBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hostel_booking = HostelBooking::all();
        return view('pages.hostel_booking.index')->with('hostel_booking', $hostel_booking);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($category, $id)
    {
        $hostelRoom = HostelRoom::find($id);

        $beds = DB::table('bed')
            ->where('hostel_room_id', $id)
            ->where('availability', 'vacant')
            ->select('bed_number')
            ->get();

        return view('pages.hostel_booking.create', compact('hostelRoom', 'beds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $attributes = request()->validate([
            'bed_number' => 'required|max:255|exists:bed,bed_number',
            'email' => 'required|email|max:255|exists:tenant,email',
            'check_in_date' => 'required|date|max:255',
            'check_out_date' => 'required|date|max:255',
            'amount_paid' => 'required|numeric|max:99999999.99',
            'balance' => 'required|numeric|max:99999999.99'
        ]);

        $tenant = DB::table('tenant')
            ->where('email', $request->email)
            ->select('id')
            ->first();
        $bed = DB::table('bed')
            ->where('bed_number', '=', $request->bed_number)
            ->select('*')
            ->first();

        HostelBooking::create([
            'check_in_date' => $attributes['check_in_date'],
            'check_out_date' => $attributes['check_out_date'],
            'amount_paid' => $attributes['amount_paid'],
            'balance' => $attributes['balance'],
            'tenant_id' => $tenant->id,
            'hostel_room_id' => $bed->hostel_room_id,
            'bed_id' => $bed->id
        ]);

        // update the availability of the bed to "occupied"
        Bed::where('id', $bed->id)
            ->update(['availability' => 'occupied']);

        return redirect('hostel_booking')->with('flash_message', 'Hostel Booking Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hostel_booking = HostelBooking::find($id);
        return view('pages.hostel_booking.show')->with('hostel_booking', $hostel_booking);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hostel_booking = HostelBooking::find($id);

        $beds = DB::table('bed')
            ->where('hostel_room_id', $hostel_booking->hostel_room_id)
            ->where('availability', 'vacant')
            ->select('bed_number')
            ->get();

        return view('pages.hostel_booking.edit', compact('hostel_booking', 'beds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $hostel_booking = HostelBooking::find($id);

        $attributes = request()->validate([
            'bed_number' => 'required|max:255|exists:bed,bed_number',
            'email' => 'required|email|max:255|exists:tenant,email',
            'check_in_date' => 'required|date|max:255',
            'check_out_date' => 'required|date|max:255',
            'amount_paid' => 'required|numeric|max:99999999.99',
            'balance' => 'required|numeric|max:99999999.99'
        ]);

        $tenant = DB::table('tenant')
            ->where('email', $request->email)
            ->select('id')
            ->first();

        $bed = DB::table('bed')
            ->where('bed_number', '=', $request->bed_number)
            ->select('*')
            ->first();

        $hostel_booking->check_in_date = $request->check_in_date;
        $hostel_booking->check_out_date = $request->check_out_date;
        $hostel_booking->amount_paid = $request->amount_paid;
        $hostel_booking->balance = $request->balance;
        $hostel_booking->tenant_id = $tenant->id;
        $hostel_booking->hostel_room_id = $bed->hostel_room_id;
        $hostel_booking->bed_id = $bed->id;
        $hostel_booking->save();

        return redirect('hostel_booking')->with('flash_message', 'HostelBooking Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        HostelBooking::destroy($id);
        return redirect('hostel_booking')->with('flash_message', 'HostelBooking deleted!');
    }

    public function select_category()
    {

        $hostelRoomTypes = HostelRoomType::all();
        return view('pages.hostel_booking.select-category')->with('hostelRoomTypes', $hostelRoomTypes);
    }

    public function select_room(string $category)
    {
        // Retrieve the hostel room type ID
        $hostelRoomType = DB::table('hostel_room_types')
            ->where('room_type', $category)
            ->select('*')
            ->first();

        // Retrieve the available hostel rooms
        $hostelRooms = DB::table('hostel_rooms')
            ->where('hostel_room_type_id', $hostelRoomType->id)
            ->where('status', 'Available')
            ->get();

        return view('pages.hostel_booking.select-room', compact('hostelRoomType', 'hostelRooms'));
    }


    public function booking_category_create(string $category)
    {
        $hostelRoomTypes = HostelRoomType::all();
        return view('pages.hostel_booking.category-create-index')->with('hostelRoomTypes', $hostelRoomTypes);
    }
}
