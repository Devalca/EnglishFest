<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id', 'id');
    }

}
