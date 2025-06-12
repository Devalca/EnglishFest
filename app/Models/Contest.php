<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(Contest::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Contest::class, 'parent_id', 'id');
    }

    public function academicPeriod()
    {
        return $this->belongsTo(AcademicPeriod::class);
    }
}
