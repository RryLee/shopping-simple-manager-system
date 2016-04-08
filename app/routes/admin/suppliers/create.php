<?php

use Market\Models\Supplier;

$app->get('/admin/suppliers/create', function ($request, $response, $args) use ($app) {
    return $this->view->render($response, 'admin/suppliers/create.html', [
        'cateName' => '供应商管理',
        'error_admin' => $app->getContainer()->flash->getMessage('error_admin')[0]
    ]);
})->add($authenticated)->setName('admin.suppliers.create');

$app->post('/admin/suppliers/store', function ($request, $response, $args) use ($app) {
    $c = $app->getContainer();
    $brand = $request->getParam('brand');
    $linkman = $request->getParam('linkman');
    $phone = $request->getParam('phone');

    $v = $c->validator;
    $v->validate([
        'brand' => [$brand, 'required|createBrand'],
        'linkman' => [$linkman, 'required'],
        'phone' => [$phone, 'required|min(6)'],
    ]);

    if ($v->passes()) {
        Supplier::create([
            'brand' => $brand,
            'linkman' => $linkman,
            'phone' => $phone
        ]);

        $c->flash->addMessage('message_admin', '成功添加' . $brand);
        return $response->withRedirect($c->router->pathFor('admin.suppliers'));
    }

    $c->flash->addMessage('error_admin', '请确认后填写');
    return $response->withRedirect($c->router->pathFor('admin.suppliers.create'));
})->add($authenticated)->setName('admin.suppliers.store');
