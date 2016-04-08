<?php

$app->get('/admin/users/create', function ($request, $response, $args) use ($app) {
    return $this->view->render($response, 'admin/users/create.html', [
        'cateName' => '管理员管理',
        'error_admin' => $app->getContainer()->flash->getMessage('error_admin')[0]
    ]);
})->add($super)->setName('admin.users.create');

$app->post('/admin/users/store', function ($request, $response, $args) use ($app) {
    $c = $app->getContainer();
    $username = $request->getParam('username');
    $email = $request->getParam('email');
    $password = $request->getParam('password');
    $password_confirmation = $request->getParam('password_confirmation');
    $issuper = $request->getParam('issuper');

    $v = $c->validator;
    $v->validate([
        'username' => [$username, 'required|min(2)'],
        'email' => [$email, 'required|email|createEmail'],
        'password' => [$password, 'required|min(6)|max(22)'],
        'password_confirmation' => [$password_confirmation, 'required|matches(password)'],
    ]);

    if ($v->passes()) {
        $c->user->create([
            'username' => $username,
            'email' => $email,
            'password' => $c->hash->password($password),
            'issuper' => $issuper !== null ? 1 : 0
        ]);

        $c->flash->addMessage('message_admin', '成功创建管理员');
        return $response->withRedirect($c->router->pathFor('admin.users'));
    }

    $c->flash->addMessage('error_admin', '请仔细填写表单');
    return $response->withRedirect($c->router->pathFor('admin.users.create'));
})->add($super)->setName('admin.users.store');
