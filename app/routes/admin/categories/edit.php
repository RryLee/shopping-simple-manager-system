<?php

use Market\Models\Category;

$app->get('/admin/categories/edit/{id}', function ($request, $response, $args) use ($app) {
    $id = (int) $args['id'];
    $category = Category::find($id);

    return $this->view->render($response, 'admin/categories/edit.html', [
        'cateName' => '商品分类',
        'category' => $category,
        'error_admin' => $app->getContainer()->flash->getMessage('error_admin')[0]
    ]);
})->add($authenticated)->setName('admin.categories.edit');
