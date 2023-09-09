<?php

namespace setup\config;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

require_once __DIR__."/../../vendor/autoload.php";

class ClassLoader
{
    private string $namespacePrefix = 'devise\\Service\\';

    private array $classes = [];

    private RecursiveIteratorIterator $iterator;

    public function __construct()
    {

        $directory = new RecursiveDirectoryIterator(__DIR__. '/../../devise/Service');
        $this->iterator = new RecursiveIteratorIterator($directory);
    }

    public function Load(): array
    {
        foreach ($this->iterator as $fileInfo) {
            if ($fileInfo->isFile() && $fileInfo->getExtension() === 'php') {
                // Get the file path.
                $filePath = $fileInfo->getPathname();
                // Extract the relative class name.
                $relativeClassName = str_replace(
                    [DIRECTORY_SEPARATOR, '.php'],
                    ['\\', ''],
                    substr($filePath, strpos($filePath, 'Service') + 8)
                );

                // Combine the namespace prefix and relative class name.
                $className = $this->namespacePrefix . $relativeClassName;

                // Check if the class exists and is loadable.
                if (class_exists($className)) {
                    // Store the class name in the array.
                    $this->classes[] = $className;
                }
            }
        }
        return $this->classes;
    }

}