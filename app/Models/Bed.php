<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $table = 'bed';

    protected $fillable = [
        'bed_number',
        'availability',
        'hostel_room_id'
    ];

    public function hostelRoom()
    {
        return $this->belongsTo(HostelRoom::class);
    }

    public function hostelBooking()
    {
        return $this->hasMany(HostelBooking::class);
    }

    use HasFactory;
}
