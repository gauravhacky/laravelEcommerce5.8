<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use SoftDeletes;
    protected $table = 'products_attributes';
    protected $dates = ['deleted_at'];
}
