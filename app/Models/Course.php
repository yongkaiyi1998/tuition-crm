<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
        'fee',
        'duration',
        'duration_type',
        'status'
    ];

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }
}
