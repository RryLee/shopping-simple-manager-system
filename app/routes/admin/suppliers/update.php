<?php

use Market\Models\Supplier;

$app->post('/admin/suppliers/update', function ($request, $response, $args) use ($app) {
    $c = $app->getContainer();

    $id = (int) $request->getParam('id');
    $brand = $request->getParam('brand');
    $linkman = $request->getParam('linkman');
    $phone = $request->getParam('phone');

    $v = $c->validator;
    $v->validate([
        'id' => [$id, 'required'],
        'brand' => [$brand, 'required|updateBrand'],
        'linkman' => [$linkman, 'required'],
        'phone' => [$phone, 'required|min(6)'],
    ]);

    if ($v->passes()) {
        $supplier = Supplier::find($id);
        $supplier->brand = $brand;
        $supplier->linkman = $linkman;
        $supplier->phone = $phone;
        $supplier->save();

        $c->flash->addMessage('message_admin', '修改成功');
        return $response->withRedirect($c->router->pathFor('admin.suppliers'));
    }

    $c->flash->addMessage('error_admin', '请确认后填写');
    return $response->withRedirect($c->router->pathFor('admin.suppliers.edit', ['id' => $id]));
})->add($authenticated)->setName('admin.suppliers.update');
