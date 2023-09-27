<?php

namespace devise\Middleware;

use setup\interface\appMiddleware;

class Middleware implements appMiddleware
{

    public function before(): void
    {
        echo "CSRF Test";
    }
}