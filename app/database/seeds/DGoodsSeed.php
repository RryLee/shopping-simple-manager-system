<?php

use Market\Models\Goods;

class DGoodsSeed
{
    public function run()
    {
        $goods = [
            ['category_id' => 1, 'supplier_id' => 1, 'name' => '旺旺雪饼', 'amount' => 100, 'price' => 2.0],
            ['category_id' => 1, 'supplier_id' => 2, 'name' => '盼盼薯片', 'amount' => 50, 'price' => 3.0],
            ['category_id' => 2, 'supplier_id' => 1, 'name' => '旺仔牛奶', 'amount' => 30, 'price' => 5.0],
            ['category_id' => 3, 'supplier_id' => 3, 'name' => '止血贴贴灵', 'amount' => 50, 'price' => 10.0],
        ];

        foreach ($goods as $goods) {
            Goods::create($goods);
        }
    }
}
