<?php

namespace setup\baseclass;
use setup\config\RequestHandler;
use setup\config\Display;

class BaseServise{

    public function __construct(
        protected RequestHandler $requestHandler,
    ) {

    }

    public function render(string $path ='', array $data = [], string $name = ''): void
    {
        Display::render($path, $data, $name);
    }

    public function RedirectWithData(string $url, string $message = '', $data =[], int $statusCode = 302): void
    {
        Display::redirectWithMessage($url,$message, $data ,$statusCode);
    }

    public function redirect($url): void
    {
        Display::redirect($url);
    }
}