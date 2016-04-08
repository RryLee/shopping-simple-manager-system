<?php

$app->post('/admin/users/update', function ($request, $response, $args) use ($app) {
    $c = $app->getContainer();

    $id = (int) $request->getParam('id');
    $username = $request->getParam('username');
    $issuper = $request->getParam('issuper');

    $v = $c->validator;
    $v->validate([
        'username' => [$username, 'required|min(2)']
    ]);

    if ($v->passes()) {
        $user = $c->user->find($id);
        $user->username = $username;
        $user->issuper = $issuper !== null ? 1 : 0;
        $user->save();

        $c->flash->addMessage('message_admin', '修改成功');
        return $response->withRedirect($c->router->pathFor('admin.users'));
    }

    $c->flash->addMessage('error_admin', '用户名不合法');
    return $response->withRedirect($c->router->pathFor('admin.users.edit', ['id' => $id]));
})->add($super)->setName('admin.users.update');
