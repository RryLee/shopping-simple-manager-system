<?php

use Market\Models\Category;

$app->get('/admin/categories/create', function ($request, $response, $args) use ($app) {
    return $this->view->render($response, 'admin/categories/create.html', [
        'cateName' => '商品分类',
        'error_admin' => $app->getContainer()->flash->getMessage('error_admin')[0]
    ]);
})->add($authenticated)->setName('admin.categories.create');

$app->post('/admin/categories/store', function ($request, $response, $args) use ($app) {
    $c = $app->getContainer();
    $title = $request->getParam('title');
    $subtitle = $request->getParam('subtitle');

    $v = $c->validator;
    $v->validate([
        'title' => [$title, 'required|createTitle']
    ]);

    if ($v->passes()) {
        Category::create([
            'title' => $title,
            'subtitle' => $subtitle
        ]);

        $c->flash->addMessage('message_admin', '成功' . $title . '创建分类');
        return $response->withRedirect($c->router->pathFor('admin.categories'));
    }

    $c->flash->addMessage('error_admin', '分类名称可能存在一些问题');
    return $response->withRedirect($c->router->pathFor('admin.categories.create'));
})->add($authenticated)->setName('admin.categories.store');
