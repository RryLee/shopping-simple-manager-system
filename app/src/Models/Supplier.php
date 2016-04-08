<?php

namespace Market\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Supplier extends Eloquent
{
    protected $fillable = [
        'brand',
        'linkman',
        'phone',
    ];
}
