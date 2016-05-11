<?php

use Market\Models\Category;

$app->post('/admin/categories/update', function ($request, $response, $args) use ($app) {
    $c = $app->getContainer();

    $id = (int) $request->getParam('id');
    $title = $request->getParam('title');
    $subtitle = $request->getParam('subtitle');

    $v = $c->validator;
    $v->validate([
        'id' => [$id, 'required'],
        'title' => [$title, 'required|updateTitle']
    ]);

    if ($v->passes()) {
        $category = Category::find($id);
        $category->title = $title;
        $category->subtitle = $subtitle;
        $category->save();

        $c->flash->addMessage('message_admin', '修改成功');
        return $response->withRedirect($c->router->pathFor('admin.categories'));
    }

    $c->flash->addMessage('error_admin', '分类名称可能存在一些问题');
    return $response->withRedirect($c->router->pathFor('admin.categories.edit', ['id' => $id]));
})->add($authenticated)->setName('admin.categories.update');
