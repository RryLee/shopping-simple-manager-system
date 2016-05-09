<?php

use Market\Models\Supplier;

$app->post('/admin/suppliers/destory', function ($request, $response, $args) use ($app) {
    $c = $app->getContainer();

    $id = (int) $request->getParam('id');

    $supplier = Supplier::find($id);
    $supplier->delete();

    $c->flash->addMessage('message_admin', '删除成功');
    return $response->withRedirect($c->router->pathFor('admin.suppliers'));
})->add($authenticated)->setName('admin.suppliers.destory');
