<?php
    require_once 'vendor/autoload.php';
//    require_once __DIR__.'/../vendor/autoload.php';
    use PHPUnit\Framework\TestCase;
    use setup\config\bootstrap;
    require_once __DIR__."/../../vendor/autoload.php";
    
    Class Angga extends TestCase
    {
        public function test()
        {
            $class = new bootstrap();
            $str = "halo";
            $str2 = $class->getValue('Test', 2);

            $this->assertEquals($str2, $str);
        }
    }
?> 
