<?php

namespace Market\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent
{
    protected $fillable = [
        'title',
        'subtitle',
    ];
}
