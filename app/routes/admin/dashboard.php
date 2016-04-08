<?php

use Market\Models\User;
use Market\Models\Goods;
use Market\Models\Category;
use Market\Models\Supplier;

$app->get('/admin', function ($request, $response, $args) use ($app) {
    $data['adminCount'] = User::count();
    $data['superCount'] = User::where('issuper', 1)->count();
    $data['cateCount'] = Category::count();
    $data['supplierCount'] = Supplier::count();
    $data['goodsCount'] = Goods::count();
    $data['goodsCost'] = Goods::cost();

    return $this->view->render($response, 'admin/dashboard.html', [
        'cateName' => '控制台',
        'data' => $data,
        'error_admin' => $app->getContainer()->flash->getMessage('error_admin')[0]
    ]);
})->add($authenticated)->setName('admin.dashboard');
