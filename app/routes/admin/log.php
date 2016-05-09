<?php

use Market\Helpers\Filer;

$app->get('/admin/log', function ($request, $response, $args) use ($app) {

    $filer = new Filer('storage/log-goods.txt');

    $records = $filer->read(null, true);

    return $this->view->render($response, 'admin/log.html', [
        'cateName' => '交易记录',
        'records' => $records
    ]);

})->add($authenticated)->setName('admin.log');
