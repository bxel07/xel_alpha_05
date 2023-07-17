<?php

namespace setup\interface;

interface appMiddleware {
    public function before(): void;
}