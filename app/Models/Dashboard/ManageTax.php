<?php

namespace App\Models\Dashboard;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageTax extends Model
{
    use HasFactory;


    public function get_user_list()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
