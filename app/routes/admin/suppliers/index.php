<?php

use Market\Models\Supplier;

$app->get('/admin/suppliers', function ($request, $response, $args) use ($app) {
    $suppliers = Supplier::all();

    return $this->view->render($response, 'admin/suppliers/index.html', [
        'cateName' => '供应商管理',
        'suppliers' => $suppliers,
        'message_admin' => $app->getContainer()->flash->getMessage('message_admin')[0]
    ]);
})->add($authenticated)->setName('admin.suppliers');
