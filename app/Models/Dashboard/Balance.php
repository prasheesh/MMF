<?php

namespace App\Models\dashboard;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;
    protected $table = "balances";

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    


}
