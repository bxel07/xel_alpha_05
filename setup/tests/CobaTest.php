<?php
namespace setup\tests;
use devise\Service\Test;
use PHPUnit\Framework\TestCase;
class CobaTest extends TestCase
{
    public function testCoba()
    {
        $x = 5;

        $this->assertEquals(5, $x);
    }

    public function testCobaService()
    {
        $test = new Test();
        $str = 'halo guys';
        $str2 = $test->testing();

        $this->assertEquals($str2, $str);
    }
}