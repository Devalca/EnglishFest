<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function contests()
    {
        return $this->belongsTo(Contest::class, 'contest_id', 'id');
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
