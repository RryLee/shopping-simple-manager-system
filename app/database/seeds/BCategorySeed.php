<?php

use Market\Models\Category;

class BCategorySeed
{
    public function run()
    {
        $data = [
            ['title' => '零食', 'subtitle' => '经典品味,休闲食尚'],
            ['title' => '饮料', 'subtitle' => '养生饮料, 让你充满活力的水'],
            ['title' => '生活用品', 'subtitle' => '从卫生纸到打火机']
        ];

        foreach ($data as $c) {
            Category::create($c);
        }
    }
}
