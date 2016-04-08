<?php

use Market\Models\Supplier;

class CSupplierSeed
{
    public function run()
    {
        $data = [
            ['brand' => '旺旺有限公司', 'linkman' => '旺仔', 'phone' => '13212345432'],
            ['brand' => '盼盼有限公司', 'linkman' => '小王', 'phone' => '13312345434'],
            ['brand' => '七度空间有限公司', 'linkman' => '暗爽', 'phone' => '13412345438']
        ];

        foreach ($data as $c) {
            Supplier::create($c);
        }
    }
}
