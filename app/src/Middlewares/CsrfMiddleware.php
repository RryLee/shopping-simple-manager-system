<?php

namespace Market\Middlewares;

use Exception;

class CsrfMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        $key = $this->container->config->get('csrf.key');

        if (! isset($_SESSION[$key])) {
            $_SESSION[$key] = $this->container->hash->hash(
                $this->container->randomlib->generateString(128)
            );
        }

        $token = $_SESSION[$key];

        if (in_array($request->getMethod(), ['POST', 'PUT', 'DELETE', 'PEATCH'])) {
            $submittedToken = $request->getParam($key) ?: '';
            if (! $this->container->hash->hashCheck($token, $submittedToken)) {
                throw new Exception('csrf token mismatch');
            }
        }

        $view = $this->container->view;
        $view->getEnvironment()->addGlobal('csrf_key', $key);
        $view->getEnvironment()->addGlobal('csrf_token', $token);

        return $next($request, $response);
    }
}
