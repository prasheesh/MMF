<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PnrDetail extends Model
{
    use HasFactory;
    protected $table = "pnr_details";
    protected $guarded = [];
}
