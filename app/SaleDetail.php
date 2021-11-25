<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;
    protected $table = 'sales_detail';
    protected $fillable = [
        'id_sale',
        'quantity',
        'price',
        'discount',
        'total'
    ];
    public $timestamps = false;
}
