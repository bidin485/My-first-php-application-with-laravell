<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\HostelBooking;
use Illuminate\Support\Facades\DB;

class HostelBookingSeeder extends Seeder
{
    public function run()
    {

        $tenant1 = DB::table('tenant')
            ->where('email','john.smith@example.com')
            ->select('id')
            ->first();
        $booking1 = DB::table('hostel_rooms')
            ->where('room_number', '=', 'A101')
            ->select('id')
            ->first();

        $booking2 = DB::table('hostel_rooms')
            ->where('room_number', '=', 'B042')
            ->select('id')
            ->first();
        $booking3 = DB::table('bed')
            ->where('bed_number', '=', 'BE1')
            ->select('id')
            ->first();
        $booking4 = DB::table('bed')
            ->where('bed_number', '=', 'BE2')
            ->select('id')
            ->first();

        $data = [
            [


                'check_in_date' => '2023-05-01',
                'check_out_date' => '2023-05-05',
                'amount_paid' => 150000,
                'balance' => 500000,
                'tenant_id'=>$tenant1->id,
                'hostel_room_id'=>$booking1->id,
                'bed_id'=>$booking3->id
            ],
            [


                'check_in_date' => '2023-05-02',
                'check_out_date' => '2023-05-08',
                'amount_paid' => 750000,
                'balance' => 0,
                'tenant_id'=>$tenant1->id,
                'hostel_room_id'=>$booking2->id,
                'bed_id'=>$booking4->id
            ],
        ];

        HostelBooking::insert($data);
    }
}

