<?php

namespace devise\Service\Gemstone;
use \Gemstone\main;
use \setup\config\Display;
class datacatcher {

    protected main $gem;


    public function __construct(main $gem)
    {
        $this->gem = $gem;
    }

    public function index(): void
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
        // Set more permissive Content Security Policy for localhost development
        header("Content-Security-Policy: default-src 'self' 'unsafe-inline' 'unsafe-eval';");
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

    /**
     * @throws \Exception
     */
    private function sanitizeValue($value): ?string
    {
        // Check for common PHP injection patterns
        $phpPatterns = [
            '/\b(system|exec|passthru|shell_exec|popen|proc_open|eval|assert)\b/i',
            '/\b(php:\/\/|data:|expect:|file:\/\/|phar:\/\/|zlib:\/\/)\b/i',
        ];

        // Check for common JavaScript injection patterns
        $jsPatterns = [
            '/<script\b/i',
            '/on\w+\s*=\s*(["\']?)\s*[^>]*\1/i',
        ];

        foreach ($phpPatterns as $pattern) {
            if (preg_match($pattern, $value)) {
                return null;
            }
        }

        foreach ($jsPatterns as $pattern) {
            if (preg_match($pattern, $value)) {
                return null;
            }
        }

        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        // Apply your sanitization logic here
    }

}