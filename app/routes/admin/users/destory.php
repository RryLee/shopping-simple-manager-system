<?php

$app->post('/admin/users/destory', function ($request, $response, $args) use ($app) {
    $c = $app->getContainer();

    $id = (int) $request->getParam('id');

    $user = $c->user->find($id);
    $user->delete();

    $c->flash->addMessage('message_admin', '删除成功');
    return $response->withRedirect($c->router->pathFor('admin.users'));
})->add($super)->setName('admin.users.destory');
