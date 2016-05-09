<?php

use Market\Models\Goods;
use Market\Models\Category;
use Market\Models\Supplier;

$app->get('/admin/goods/edit/{id}', function ($request, $response, $args) use ($app) {
    $id = (int) $args['id'];

    $goods = Goods::find($id);
    $categories = Category::lists('title', 'id');
    $suppliers = Supplier::lists('brand', 'id');

    return $this->view->render($response, 'admin/goods/edit.html', [
        'cateName' => '商品管理',
        'goods' => $goods,
        'categories' => $categories,
        'suppliers' => $suppliers,
        'error_admin' => $app->getContainer()->flash->getMessage('error_admin')[0]
    ]);
})->add($authenticated)->setName('admin.goods.edit');
