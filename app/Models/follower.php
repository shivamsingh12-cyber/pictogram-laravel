<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class follower extends Model
{
    use HasFactory;

    protected $guarded =[];
    
    protected $casts = [
        'user_id' => 'array',
    ];
}
