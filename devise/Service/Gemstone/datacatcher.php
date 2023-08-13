<?php

namespace devise\Service\Gemstone;
use \Gemstone\main;
use \setup\config\Display;
class datacatcher {

    protected $gem;

    protected $url;

    public function __construct()
    {
        $this->gem = new main();
    }

    public function index()
    {
        session_start();
        $data = $_POST;

        $data1 = $this->sazitize($data);

       $encrypt = $this->gem->ed($_SESSION["param"],$data1);

       $wrapper = [
         'gemstone' => $encrypt,
         'salt' => $_SESSION["param"]
       ];

        $url = '/'.$_SESSION["url_patch"];

       session_write_close();
       Display::redirectWithMessage($url, 'Data processed successfully.', $wrapper);
    }


    public function sazitize(array $data): array
    {
        $sanitizedData = [];

        foreach ($data as $key => $value) {
            $sanitizedValue = $this->sanitizeValue($value);
            $sanitizedData[$key] = $sanitizedValue;
        }

        return $sanitizedData;
    }

    private function sanitizeValue($value): string
    {
        // Apply your sanitization logic here
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

}