<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;    
    protected $table = 'files';

    protected $fillable = [
        'file_type', 'file_id', 'url', 'source', 'fileable_params', 'title', 'description'
    ];
    
}
