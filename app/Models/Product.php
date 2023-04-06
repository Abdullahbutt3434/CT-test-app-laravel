<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Product extends Model
{
    use HasFactory;
    public const jsonFile = 'product.json';
    protected $fillable = ['id','name','quantity','price'];

}
