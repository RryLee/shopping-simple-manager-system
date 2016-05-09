<?php

use Market\Models\Goods;

$app->get('/admin/goods', function ($request, $response, $args) use ($app) {
    $goods = Goods::with(['category', 'supplier'])->get();

    return $this->view->render($response, 'admin/goods/index.html', [
        'cateName' => '商品管理',
        'goods' => $goods,
        'message_admin' => $app->getContainer()->flash->getMessage('message_admin')[0]
    ]);
})->add($authenticated)->setName('admin.goods');
