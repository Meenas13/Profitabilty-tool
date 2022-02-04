<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//customer model
class Customer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'customers';
    protected $fillable = ['name','phone','city','address','add_by','update_by'];
}
