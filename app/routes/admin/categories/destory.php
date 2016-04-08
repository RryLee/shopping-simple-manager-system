<?php

use Market\Models\Category;

$app->post('/admin/categories/destory', function ($request, $response, $args) use ($app) {
    $c = $app->getContainer();

    $id = (int) $request->getParam('id');

    $category = Category::find($id);
    $category->delete();

    $c->flash->addMessage('message_admin', '删除成功');
    return $response->withRedirect($c->router->pathFor('admin.categories'));
})->add($authenticated)->setName('admin.categories.destory');
