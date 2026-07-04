<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
      'payment_no',
      'invoice_id',
      'amount',
      'payment_date',
      'payment_method',  
      'reference_no',
      'remark',
      'status'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function scopePaid(Builder $query) 
    {
        return $query->where('status', 'paid');
    }
}
