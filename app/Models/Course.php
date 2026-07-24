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

    public function scopeSearch(Builder $query, $search) 
    {
        if (blank($search)) {
            return $query;
        }

        return $query->where(function($q) use ($search){
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('fee', 'like', "%{$search}%");
        });
    }

    public function scopeStatus(Builder $query, $status)
    {
        if (blank($status)) {
            return $query;
        }

        return $query->where('status', $status);
    }
}
