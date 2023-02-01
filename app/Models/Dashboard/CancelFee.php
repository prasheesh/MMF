<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'key_name',
        'value'
    ];
}
