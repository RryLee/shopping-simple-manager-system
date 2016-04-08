<?php

$app->get('/admin/info', function ($request, $response, $args) use ($app) {
    return $this->view->render($response, 'admin/info.html', [
        'cateName' => '资料修改',
        'error_admin' => $app->getContainer()->flash->getMessage('error_admin')[0],
        'message_admin' => $app->getContainer()->flash->getMessage('message_admin')[0],
    ]);
})->add($authenticated)->setName('admin.info');

$app->post('/admin/info', function ($request, $response, $args) use ($app) {
    $c = $app->getContainer();

    $username = $request->getParam('username');
    $oldpassword = $request->getParam('oldpassword');
    $password = $request->getParam('password');
    $password_confirmation = $request->getParam('password_confirmation');

    $v = $c->validator;
    $v->validate([
        'username' => [$username, 'required|min(2)'],
        'oldpassword' => [$oldpassword, 'required|matchesCurrentPassword'],
        'password' => [$password, 'required|min(6)|max(22)'],
        'password_confirmation' => [$password_confirmation, 'required|matches(password)'],
    ]);

    if ($v->passes()) {
        $user = $c->auth;
        $user->update([
            'username' => $username,
            'password' => $c->hash->password($password)
        ]);

        $c->flash->addMessage('message_admin', '资料更新成功');
        return $response->withRedirect($c->router->pathFor('admin.info'));
    }

    $c->flash->addMessage('error_admin', '表单填写有误');
    return $response->withRedirect($c->router->pathFor('admin.info'));
})->add($authenticated)->setName('admin.info.update');
