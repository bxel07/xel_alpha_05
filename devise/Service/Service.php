<?php

namespace devise\Service;
use setup\baseclass\BaseServise;
use stdClass;

class Service extends BaseServise {
    public function index() {
       $data1 = $this->xgen()->show('news');

       $nama = [
         'data' => 'ddata',
         'nomor' => '10'
       ];

        $this->render('welcome', compact('nama'));
    }

    public function test() {
        $this->render('redirect');
    }

    public function test1() {
        session_start();
            $data = $_SESSION['processed_data'];
            var_dump($data->fname);
        session_write_close();
    }
}