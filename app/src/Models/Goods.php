<?php

namespace Market\Models;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Goods extends Eloquent
{
    protected $fillable = [
        'category_id',
        'supplier_id',
        'name',
        'amount',
        'price',
        'image'
    ];

    public static function cost()
    {
        $pdo = Capsule::connection()->getPdo();
        $stmt = $pdo->prepare('select sum((amount * price)) as cost from goods');
        $stmt->execute();

        return $stmt->fetch()['cost'];
    }

    public function category()
    {
        return $this->belongsTo('Market\Models\Category');
    }

    public function supplier()
    {
        return $this->belongsTo('Market\Models\Supplier');
    }
}
