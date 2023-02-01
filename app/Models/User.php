<?php

namespace App\Models;

use App\Models\Dashboard\Booking;
use App\Models\Dashboard\File;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Dashboard\Balance;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name', 'company_name', 'email', 'mobile_number', 'password', 'address', 'role', 'user_type', 'status','gst_no','aadhar_no','pan'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'name' => 'encrypted'

    ];

    public function aadharCard()
    {
        return $this->morphMany(File::class, 'file');
    }

    public function panCard()
    {
        return $this->morphMany(File::class, 'file');
    }

    public function gstCertificate()
    {
        return $this->morphMany(File::class, 'file');
    }

    public function user_booking_history()
    {
        return $this->hasMany(Booking::class, 'users_id', 'id');
    }

    public function user_balance_allocated()
    {
        return $this->hasOne(Balance::class, 'user_id', 'id');
    }
}
