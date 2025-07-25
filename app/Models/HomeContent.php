<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    protected $casts = [
        'fees' => 'array',
        'cs' => 'array',
    ];
}
