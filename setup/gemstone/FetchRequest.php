<?php

namespace setup\gemstone;
class FetchRequest{
    public function index() {

        var_dump($_POST);
        header("location: /");
    }
}
