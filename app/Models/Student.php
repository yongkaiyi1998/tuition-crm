<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'status'
    ];

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }
}
