<?php

namespace setup\config;
class Display{
    public static function render(string $display, array $data = [], string $name ='') {
        $groupedData = array_column($data, null, 'id'); // Group data based on the 'id' key
        foreach ($groupedData as $key => $value) {
            ${$key} = self::getDataValue($groupedData, $key);
        }
        require __DIR__.'/../../devise/Display/'.$display.'.php';
    }
    public static function getDataValue(array $data, string $key) {
        return $data[$key] ?? null;
    }

}