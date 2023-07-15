<?php

namespace setup\interface;

interface Middleware {
    public function before(): void;
}