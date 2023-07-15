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

    protected function getExpression($file, $class)
    {
        require_once $file;
        $source = file_get_contents($file); // Get the contents of the file

        $classPattern = $this->class;
        $functionPattern = $this->functions;

        preg_match_all($classPattern, $source, $classMatches);
        $className = $classMatches[1][0] ?? null;

        if (!empty($className)) {
            preg_match_all($functionPattern, $source, $functionMatches);
            $functionNames = $functionMatches[1];

            array_unshift($functionNames, $className); // Add class name at index 0

            $class[$className] = $functionNames;
        }

        return $class;
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
                $classList = $this->getExpression($filePath, $classList);
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