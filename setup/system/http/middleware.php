<?php

class Middleware {
    private $token;

    public function __construct() {
        $token = openssl_random_pseudo_bytes(32);
        $encrypt = bin2hex($token);
        $this->token = $encrypt;
    }

    public function getToken() {
        return $this->token;
    }

    public function redirect() {

    }
}