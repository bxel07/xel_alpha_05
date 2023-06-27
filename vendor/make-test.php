<?php
$arg1 = $argv[1];

$myfile = fopen("setup/tests/" .$arg1. ".php", "w") or die("cant create file");

$text =
" 
<?php

    use PHPUnit\Framework\TestCase;
    
    Class $arg1 extends TestCase
    {
        public function test()
        {
            echo 'testing';
        }
    }
?> 
";
fwrite($myfile, $text);
fclose($myfile);


