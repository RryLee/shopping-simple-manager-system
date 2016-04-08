<?php

use Market\Models\Goods;

$app->post('/admin/goods/update', function ($request, $response, $args) use ($app) {
    $c = $app->getContainer();
    $id = (int) $request->getParam('id');

    $name = $request->getParam('name');
    $amount = $request->getParam('amount');
    $price = $request->getParam('price');
    $category_id = $request->getParam('category_id');
    $supplier_id = $request->getParam('supplier_id');

    $v = $c->validator;
    $v->validate([
        'name' => [$name, 'required'],
        'amount' => [$amount, 'required|int'],
        'price' => [$price, 'required|number'],
        'category_id' => [$category_id, 'required|int|existCategory'],
        'supplier_id' => [$supplier_id, 'required|int|existSupplier'],
    ]);

    if ($v->passes()) {
        $goods = Goods::find($id);
        $goods->update([
            'name' => $name,
            'amount' => $amount,
            'price' => $price,
            'category_id' => $category_id,
            'supplier_id' => $supplier_id,
        ]);

        $c->flash->addMessage('message_admin', '修改成功');
        return $response->withRedirect($c->router->pathFor('admin.goods'));
    }

    $c->flash->addMessage('error_admin', '请确认后填写');
    return $response->withRedirect($c->router->pathFor('admin.goods.create'));
})->add($authenticated)->setName('admin.goods.update');
