<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'status'
    ];

    public function enrollments() 
    {
        return $this->hasMany(Enrollment::class);
    }

    public function scopeSearch (Builder $query, $search) 
    {
        if (blank($search)) {
            return $query;
        }

        return $query->where(function($q) use ($search){
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    }
}
