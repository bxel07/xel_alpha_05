<?php

namespace setup\config;
use devise\Service\Service;

class bootstrap {

    public $path = __DIR__.'/../../devise/Service/';
    public $class = '/class\s+(\w+)/';
    public $functions = '/function\s+(\w+)/';

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

    public function getData()
    {
        $folder = $this->path;
        $files = scandir($folder);
        return $files;
    }

    protected function getExpression($source)
    {
        $classPattern = $this->class;

        preg_match_all($classPattern, $source, $classMatches);
        $className = $classMatches[1][0] ?? null;
        return $className;
    }

    public function getService()
    {
        $folderFile = $this->path;
        $files = $this->getData();
        $classList = [];

        foreach ($files as $file)
        {
            $filePath = $folderFile . $file;

            if(is_file($filePath))
            {
                require_once $filePath;
                $source = file_get_contents($filePath); // Get the contents of the file

                // Use regular expressions to extract class and function names
                $className = $this->getExpression($source);

                if (!empty($className)) {
                    preg_match_all($this->functions, $source, $functionMatches);
                    $functionNames = $functionMatches[1];

                    array_unshift($functionNames, $className); // Add class name at index 0

                    $classList[$className] = $functionNames;
                }
            }
        }

        return $classList;
    }
    public function getValue(string $key, int $value){
        $x = $this->getService();
        $dataArr = $x[$key];
        $y = $x[$key][$value];
        $z = $x[$key][0];
        $namespace = "devise\\Service\\" . $z;
        require_once 'devise/Service/' . $z . ".php";
        $class = new $namespace();
        $clas = $class->$y();
        return $clas;
    }
}