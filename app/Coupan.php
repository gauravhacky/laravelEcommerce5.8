<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupan extends Model
{
    use SoftDeletes;
    protected $table = 'coupon';
    protected $dates = ['deleted_at'];
}
