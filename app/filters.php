<?php

$guest = function ($request, $response, $next) use ($app) {
    $c = $app->getContainer();
    if ($c->auth) {
        return $response->withRedirect('/admin');
    }

    $response = $next($request, $response);

    return $response;
};

$authenticated = function ($request, $response, $next) use ($app) {
    $c = $app->getContainer();
    if (! $c->auth) {
        $c->flash->addMessage('message', '请先登陆');
        return $response->withRedirect('/login');
    }

    $response = $next($request, $response);

    return $response;
};

$super = function($request, $response, $next) use ($app) {
    $c = $app->getContainer();

    if (! $c->auth) {
        $c->flash->addMessage('message', '请先登陆');
        return $response->withRedirect('/login');
    } else {
        if (! $c->auth->issuper) {
            $c->flash->addMessage('error_admin', '请注意你的身份，兄弟!!!');
            return $response->withRedirect('/admin');
        }
    }

    $response = $next($request, $response);

    return $response;
};
