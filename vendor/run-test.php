<?php
$arg = $argv[1];
if ($arg = "all") {
    $output = shell_exec("php vendor/bin/phpunit setup/tests/");
    echo "<pre>$output</pre>";
} elseif($arg) {
    $output = shell_exec("php vendor/bin/phpunit setup/tests/$arg.php");
    echo "<pre>$output</pre>";
}

