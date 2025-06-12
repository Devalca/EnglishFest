<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicPeriod extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::saving(function ($model) {
            if ($model->active) {
                static::where('id', '!=', $model->id)->update(['active' => false]);
            }
        });
    }

    public function contests()
    {
        return $this->hasMany(Contest::class);
    }
}
