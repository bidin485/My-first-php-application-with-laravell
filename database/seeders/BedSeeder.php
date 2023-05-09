<?php


namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Bed;
use Illuminate\Support\Facades\DB;

class BedSeeder extends Seeder
{
    public function run()
    {
    $room1 = DB::table('hostel_rooms')
        ->where('room_number', '=', 'B042')
        ->select('id')
        ->first();

    $room2 = DB::table('hostel_rooms')
        ->where('room_number', '=', 'A101')
        ->select('id')
        ->first();

        $data=[
            [
                'bed_number' => 'BE1',
                'availability' => 'vacant',
                'hostel_room_id' => $room1->id
            ],
            [
                'bed_number' => 'BE2',
                'availability' => 'occupied',
                'hostel_room_id' => $room2->id
            ],




        ];
        Bed::insert($data);
    }
}
