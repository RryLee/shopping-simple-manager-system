<?php

use Market\Models\Supplier;

$app->get('/admin/suppliers/edit/{id}', function ($request, $response, $args) use ($app) {
    $id = (int) $args['id'];
    $supplier = Supplier::find($id);

    return $this->view->render($response, 'admin/suppliers/edit.html', [
        'cateName' => '供应商管理',
        'supplier' => $supplier,
        'error_admin' => $app->getContainer()->flash->getMessage('error_admin')[0]
    ]);
})->add($authenticated)->setName('admin.suppliers.edit');
