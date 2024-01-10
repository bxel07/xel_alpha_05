 
<?php

    use PHPUnit\Framework\TestCase;
    
    Class Testing extends TestCase
    {
        public function testCoba()
        {

            $test = 'halo';

            $this->assertEquals('halo', $test);
        }
    }

