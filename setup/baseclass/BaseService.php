<?php

    namespace setup\baseclass;
    use setup\config\xgen;
    use setup\config\Display;

    class BaseService {
        public function __construct()
        {

        }

        public function render(string $path, array $data =[], string $name ='') {
            Display::render($path,$data, $name);
        }

        public function connect () {
            return  new xgen();
        }
    }