<?php

use Market\Models\Goods;

$app->post('/admin/goods/destory', function ($request, $response, $args) use ($app) {
    $c = $app->getContainer();

    $id = (int) $request->getParam('id');

    $goods = Goods::find($id);
    $goods->delete();

    $c->flash->addMessage('message_admin', '删除成功');
    return $response->withRedirect($c->router->pathFor('admin.goods'));
})->add($authenticated)->setName('admin.goods.destory');
