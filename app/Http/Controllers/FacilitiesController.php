<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacilitiesController extends Controller
{
    
    public function index()
    {
        // $facilities = Facility::all();
        $facilities = Facility::orderBy('created_at', 'desc')->paginate(4);
        return view('pages.facilities.index')->with('facilities', $facilities);
    }

    public function create()
    {

        return view('pages.facilities.create');
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'facility_id' => 'required',
            'facility_name' => 'required',
            'facility_description' => 'required',
            'availability' => 'required'
        ]);
        
        // Create the Facility 
        $facility = new Facility;
        $facility->id = $request->input('facility_id');
        $facility->Facility_Name = $request->input('facility_name');
        $facility->Description = $request->input('facility_description');
        $facility->Availability = $request->input('availability');
        $facility->save();

        return redirect('facilities')->with('flash_message', 'New Facility was Added!');

    }
    public function show(string $id)
    {
        $facility = Facility::find($id);
        return view('pages.facilities.show')->with('facility', $facility);
    }


    public function edit(string $id)
    {
        return view('pages.facilities.edit');
    }

  
    public function update(Request $request, string $id)
    {
        
    }

  
    public function destroy(string $id)
    {
        //
    }
}
