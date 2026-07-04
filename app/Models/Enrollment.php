<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'enroll_date',
        'course_name',
        'original_fee',
        'final_fee',
        'status'
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
