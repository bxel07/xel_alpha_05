<?php

namespace setup\config;
use devise\Service\Service;

class bootstrap {

    public static function autoload() {

    }

    public function __construct()
    {
        spl_autoload_register([$this, 'register']);

    }

    public function register(string $class)
    {
        $class = substr($class, strlen(__NAMESPACE__.'\\'));
        $class = str_replace('\\','/',$class);
        $class = $class.'.php';
        if(!file_exists($class)) {
            return;
        }
        require_once $class;
    }

    public function data_array() {
        $folderPath = __DIR__.'/../../devise/Service/';

        $files = scandir($folderPath); // Get all files and directories within the folder

        $classList = [];

        foreach ($files as $file) {
            $filePath = $folderPath . $file;

            if (is_file($filePath)) {
                require_once $filePath; // Require the file if it's a PHP file

                $source = file_get_contents($filePath); // Get the contents of the file

                // Use regular expressions to extract class and function names
                $classPattern = '/class\s+(\w+)/';
                $functionPattern = '/function\s+(\w+)/';

                preg_match_all($classPattern, $source, $classMatches);
                $className = $classMatches[1][0] ?? null;

                if (!empty($className)) {
                    preg_match_all($functionPattern, $source, $functionMatches);
                    $functionNames = $functionMatches[1];

                    array_unshift($functionNames, $className); // Add class name at index 0

                    $classList[$className] = $functionNames;
                }
            }
        }

        var_dump($classList);
    }

    public function getValue(string $key, int $value){
        $x = $this->data_array();
        $dataArr = $x[$key];
        $y = $x[$key][$value];
        $z = $x[$key][0];
        $namespace = "\\devise\\Service\\" . $z;
        require_once 'devise/Service/' . $z . ".php";
        $class = new $namespace();
        $clas = $class->$y();
        return $y;
    }
}

$x = new bootstrap();
$x->data_array();