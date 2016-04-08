<?php

namespace Market\Helpers;

class Hash
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function password($password)
    {
        return password_hash(
            $password,
            $this->config->get('app.hash.algo'),
            ['cost' => $this->config->get('app.hash.cost')]
        );
    }

    public function check($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function hash($string)
    {
        return hash('sha256', $string);
    }

    public function hashCheck($know, $string)
    {
        return hash_equals($know, $string);
    }
}
