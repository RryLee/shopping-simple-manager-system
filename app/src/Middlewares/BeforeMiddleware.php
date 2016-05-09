<?php

namespace Market\Middlewares;

class BeforeMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if (isset($_SESSION[$this->container->config->get('auth.session')])) {
            $this->container->auth = $this->container->user
                ->whereId($_SESSION[$this->container->config->get('auth.session')])
                ->first();
        }

        $this->checkRememberMe();

        $view = $this->container->view;
        $view->getEnvironment()->addGlobal('auth', $this->container->auth);

        return $next($request, $response);
    }

    protected function checkRememberMe()
    {
        if (isset($_COOKIE[$this->container->config->get('auth.remember')]) and ! $this->container->auth) {
            $data = $_COOKIE[$this->container->config->get('auth.remember')];
            $credentials = explode('__', $data);

            if (empty(trim($data)) || count($credentials) !== 2) {
                $this->app->response->redirect($this->app->urlFor('home'));
            } else {
                $identifier = $credentials[0];
                $token = $this->container->hash->hash($credentials[1]);
                $user = $this->container->user
                    ->where('remember_identifier', $identifier)
                    ->first();
                if ($user and $this->container->hash->hashCheck($token, $user->remember_token)) {
                        $_SESSION[$this->container->config->get('auth.session')] = $user->id;
                        $this->container->auth = $user;
                } else {
                    setcookie($this->config->get('auth.remember'), null, time() - 2);
                }
            }
        }
    }
}
