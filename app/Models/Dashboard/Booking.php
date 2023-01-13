<?php

namespace App\Models\Dashboard;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Dashboard\BookingDetails;

class Booking extends Model
{
    use HasFactory;
    protected $table = "bookings";
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function bookingdetails()
    {
        return $this->hasMany(BookingDetails::class, 'booking_id','id');
    }

    public function used_balance()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
