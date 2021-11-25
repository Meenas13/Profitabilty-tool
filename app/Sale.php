<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = [
        'customer_id',
        'add_by',
        'update_by',
        'date',
        'bill_no',
        'tax',
        'total',
        'paid',
        'due',
        'discount',
        'comment',
        'status'
    ];
}
