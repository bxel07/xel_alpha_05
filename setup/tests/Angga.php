<?php

    use PHPUnit\Framework\TestCase;
    use setup\config\bootstrap;
    
    Class Angga extends TestCase
    {
        public function test()
        {
            $class = new bootstrap();
            $str = "halo guys";
            $str2 = $class->getValue('Test', 2);

            $this->assertEquals($str2, $str);
        }
    }
?> 
