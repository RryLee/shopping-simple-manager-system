<?php

$app->get('/logout', function ($request, $response, $args) use ($app) {
    $c = $app->getContainer();

    unset($_SESSION[$c->config->get('auth.session')]);
    if ($_COOKIE[$c->config->get('auth.remember')]) {
        $c->auth->removeRememberCredentials();
        setcookie($c->config->get('auth.remember'), null, time() - 2);
    }

    $c->flash->addMessage('message', '安全退出');
    return $response->withRedirect('/');
})->add($authenticated)->setName('logout');
