<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeSearch (Builder $query, $search) 
    {
        if (blank($search)) {
            return $query;
        }

        return $query->where(function($q) use ($search){
            $q->whereHas('student', function ($student) use ($search){
                $student->where('name', 'like', "%{$search}%");
            })->orWhereHas('course', function ($course) use ($search){
                $course->where('name', 'like', "%{$search}%");
            });
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
