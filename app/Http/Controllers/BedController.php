<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bed = Bed::all();
        return view('pages.bed.index')->with('bed', $bed);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hostelRooms = DB::table('hostel_rooms')
        ->where('status', '=', 'Available')
        ->select('*')
        ->get();

        return view('pages.bed.create', compact('hostelRooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'bed_number' => 'required|max:10|regex:/^BE[0-9]{1,6}$/|unique:bed,bed_number',
            'availability' => 'required|max:255'

        ]);

        $hostelRoom = DB::table('hostel_rooms')
        ->where('room_number', '=', $request->room_number)
        ->select('id')
        ->first();


        Bed::create([
            'bed_number' => $attributes['bed_number'],
            'availability' => $attributes['availability'],
            'hostel_room_id' => $hostelRoom->id

        ]);

        return redirect('bed')->with('flash_message', 'Bed Added!');
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
    public function edit(string $id)
    {

        $hostelRooms = DB::table('hostel_rooms')
        ->where('status', '=', 'Available')
        ->select('*')
        ->get();

        $bed = Bed::find($id);
        return view('pages.bed.edit', compact('bed','hostelRooms'));
    }
    public function update(Request $request, string $id)
    {
        $bed = Bed::find($id);
        $attributes = request()->validate([
            'bed_number' => 'required|max:10|regex:/^BE[0-9]{1,6}$/|unique:bed,bed_number,' . $id,
            'availability' => 'required|max:255'
        ]);

        $hostelRoom = DB::table('hostel_rooms')
        ->where('room_number', '=', $request->room_number)
        ->select('id')
        ->first();

        $bed->bed_number= $request->bed_number;
        $bed->availability= $request->availability;
        $bed->hostel_room_id= $hostelRoom->id;
        $bed->save();
        return redirect('bed')->with('flash_message', 'Bed Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Bed::destroy($id);
        return redirect('bed')->with('flash_message', 'Bed deleted!');
    }

    }


