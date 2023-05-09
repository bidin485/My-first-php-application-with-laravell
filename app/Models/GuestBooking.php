<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestBooking extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'user_id',
        'hostel_room_id',
        'bed_id',
        'check_in_date',
        'check_out_date',
        'amount_paid',
        'balance'
        //payment method
    ];
    public function user(){
        return $this->hasMany(User::class);
    }

    use HasFactory;
}
