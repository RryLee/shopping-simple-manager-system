<?php

$app->get('/admin/users/edit/{id}', function ($request, $response, $args) use ($app) {
    $id = (int) $args['id'];
    $user = $this->user->find($id);

    return $this->view->render($response, 'admin/users/edit.html', [
        'cateName' => '管理员管理',
        'user' => $user,
        'error_admin' => $app->getContainer()->flash->getMessage('error_admin')[0]
    ]);
})->add($super)->setName('admin.users.edit');
