<?php

use Carbon\Carbon;

$app->get('/login', function ($request, $response, $args) use ($app) {
    return $this->view->render($response, 'auth/login.html', [
        'message' => $app->getContainer()->flash->getMessage('message')[0],
        'error' => $app->getContainer()->flash->getMessage('error')[0]
    ]);
})->add($guest)->setName('login');

$app->post('/login', function ($request, $response, $args) {
    $email = $request->getParam('email');
    $password = $request->getParam('password');
    $remember = $request->getParam('remember');

    $v = $this->validator;
    $v->validate([
        'email' => [$email, 'required'],
        'password' => [$password, 'required']
    ]);

    if ($v->passes()) {
        $user = $this->user->where('email', $email)->first();

        if ($user && $this->hash->check($password, $user->password)) {
            $_SESSION[$this->config->get('auth.session')] = $user->id;

            if ($remember === 'on') {
                $rememberIdentifier = $this->randomlib->generateString(128);
                $rememberToken = $this->randomlib->generateString(128);

                $user->updateRememberCredentials(
                    $rememberIdentifier,
                    $this->hash->hash($rememberToken)
                );

                setcookie($this->config->get('auth.remember'), "{$rememberIdentifier}__{$rememberToken}", time() + 3600 * 24 * 7);
            }

            return $response->withRedirect('/admin');
        } else {
            $this->flash->addMessage('error', '用户名或者密码错误');
            return $response->withRedirect('/login');
        }
    }
    $this->view->render($response, 'auth/login.html', [
        'errors' => $v->errors(),
        'request' => $request
    ]);
})->add($guest)->setName('login.post');
