<?php

use Market\Models\Category;

$app->get('/admin/categories', function ($request, $response, $args) use ($app) {
    $categories = Category::all();

    return $this->view->render($response, 'admin/categories/index.html', [
        'cateName' => '商品分类',
        'categories' => $categories,
        'message_admin' => $app->getContainer()->flash->getMessage('message_admin')[0]
    ]);
})->add($authenticated)->setName('admin.categories');
