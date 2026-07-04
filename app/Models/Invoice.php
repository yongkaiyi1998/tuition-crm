<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
      'enrollment_id',
      'invoice_no',
      'amount',
      'balance',  
      'due_date',
      'student_name',
      'course_name',
      'status'
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function recalculate()
    {
        $totalPaid = $this->payments()
            ->where('status', 'paid')
            ->sum('amount');

        $this->balance = $this->amount - $totalPaid;

        if ($this->balance <= 0) {
            $this->balance = 0;
            $this->status = 'paid';
        } elseif ($this->balance < $this->amount) {
            $this->status = 'partial';
        } else {
            $this->status = 'unpaid';
        }

        $this->save();
    }
}
