<?php

$app->get('/admin/users', function ($request, $response, $args) use ($app) {
    $users = $this->user->getAll();

    return $this->view->render($response, 'admin/users/index.html', [
        'cateName' => '管理员管理',
        'users' => $users,
        'message_admin' => $app->getContainer()->flash->getMessage('message_admin')[0]
    ]);
})->add($authenticated)->setName('admin.users');
