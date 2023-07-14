<?php
$arg = $argv[1];
if ($arg) {
    $output = shell_exec("php vendor/bin/phpunit setup/tests/$arg.php");
    echo $output;
} else {
    $output = shell_exec("php vendor/bin/phpunit");
    echo $output;
}

