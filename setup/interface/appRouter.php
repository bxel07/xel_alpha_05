<?php

namespace setup\interface;

interface appRouter{

    /**
     * @param string $path
     * @param string $controller
     * @param string $function
     * @param array $middleware
     * @return mixed
     */
    public function get(string $path, string $controller, string $function, array $middleware = []);
    public function post(string $path, string $controller, string $function, array $middleware = []);
    public function put(string $path, string $controller, string $function, array $middleware = []);
    public function patch(string $path, string $controller, string $function, array $middleware = []);
    public function delete(string $path, string $controller, string $function, array $middleware = []);
    public function exec();

}
