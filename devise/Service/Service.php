<?php

namespace devise\Service;
use setup\baseclass\BaseServise;
use setup\system\di\Dependency1;
use setup\system\di\Dependency2;

class Service extends BaseServise {

    protected Dependency2 $data;
    protected Dependency1 $data1;

    /**
     * @param Dependency2 $dependency2
     * @param Dependency1 $dependency1
     */
    public function __construct(
        Dependency2 $dependency2,
        Dependency1 $dependency1
    )
    {
        $this->data = $dependency2;
        $this->data1 = $dependency1;
    }

    /**
     * @return void
     */
    public function index():void {
       $data1 = $this->xgen()->show('news');

       $nama = [
         'data' => 'ddata',
         'nomor' => '10'
       ];

        $this->data->index();
        $this->data1->index();


        $this->render('welcome', compact('nama'));
    }

    public function test():void {
        $this->render('redirect');
    }

    public function test1():void {
            session_start();
            $data = $_SESSION['processed_data'];
            var_dump($data->lname);
            session_write_close();
    }
}