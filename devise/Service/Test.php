<?php

namespace devise\Service;
use setup\baseclass\BaseData;

class Test {
    public string $strings = 'halo';
    public function index() {
        echo "Testing from our local testing";
    }

    public function testing()
    {
        return $this->strings;
    }
}