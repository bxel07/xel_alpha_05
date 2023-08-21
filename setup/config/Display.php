<?php

namespace setup\config;
use \Gemstone\main;
use JetBrains\PhpStorm\NoReturn;
use stdClass;

class Display {

    /**
     * @param string $display
     * @param array $mapper
     * @return void
     * Rendering data to display with sanitize data first
     */
    public static function render(string $display, array $mapper = [])
    {

        if(!empty($mapper)) {
            //getting variable name which stored on array
            $rename = array_key_first($mapper);

            //get inside the variabel name index
            $data_old = $mapper[$rename];

            //sanitize data first
            $after_sanitize = self::sanitize($data_old);

            //rename variable to stored name on array in top
            ${$rename} = self::arrayToObject($after_sanitize);
        }


        //requiring data to display layer
        require __DIR__.'/../../devise/Display/'.$display.'.php';
    }

    /**
     * @param string $url
     * @param string $message
     * @param array $data
     * @param int $statusCode
     * @return void
     * Redirect function with session to store data
     */
    #[NoReturn] public static function redirectWithMessage(string $url, string $message ='', array $data =[], int $statusCode = 302): void
    {

        // Set session cookie parameters including the SameSite attribute
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'secure' => false, // Set to false for testing on localhost
            'httponly' => true,
            'samesite' => 'Strict', // or 'None' for testing on localhost, but use cautiously
        ]);

        //storing data to session
        $_SESSION['flash_message'] = $message;
        $_SESSION['processed_data'] =  self::Gemdata($data);

        //end the session
        session_write_close();

        // Redirect to the specified URL
        header("Location: $url", true, $statusCode);
        exit(); // Make sure to exit the script after sending the redirect header
    }

    public static function redirect($url): void
    {
        header("Location: $url");
    }

    /**
     * @param array $data
     * @return array
     * Sanitize data using htmlspecialchars  to prevent injected script
     */
    public static function  sanitize($data) {
        if(is_array($data)) {
            $sanitizedData = [];

            foreach ($data as $key => $value) {
                $sanitizedData[$key] =  self::sanitize($value);
            }

            return $sanitizedData;
        }else {
            return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        }
    }

    /**
     * @param $data
     * @return mixed|stdClass
     * convert data array to object
     */
    public static function arrayToObject($data): mixed
    {
        if (is_array($data)) {
            $object = new stdClass();
            foreach ($data as $key => $value) {
                $object->$key = self::arrayToObject($value);
            }
            return $object;
        } else {
            return $data;
        }
    }

    /**
     * @param array $data
     * @return object
     * To get and decrypt data from session which stored data
     */
    public static function Gemdata(array $data = []): object
    {
        session_start();
        $instance = new main();
        $dec = $instance->dd($data['salt'], $data['gemstone']);
        return (object) $dec;

        session_write_close();
    }


}









/**
 * cache implementation using sympfony cache but still skeleton
 */
//namespace setup\config;
//
//use Symfony\Component\Cache\Adapter\FilesystemAdapter;
//use Symfony\Contracts\Cache\ItemInterface;
//
//class Display {
//    protected static $cachePool;
//
//    public static function initCache() {
//        if (!isset(self::$cachePool)) {
//            self::$cachePool = new FilesystemAdapter();
//        }
//    }
//
//    public static function render(string $display, array $data = []) {
//        self::initCache();
//
//        $cacheKey = 'display_' . $display;
//
//        $cachedContent = self::$cachePool->get($cacheKey, function (ItemInterface $item) use ($display, $data) {
//            ob_start();
//            require __DIR__ . '/../../devise/Display/' . $display . '.php';
//            $content = ob_get_clean();
//
//            // Cache for 1 hour (adjust as needed)
//            $item->expiresAfter(2300);
//
//
//            return $content;
//        });
//
//        // Convert data to an object array and add content
//        $dataObject = (object) $data;
//        $dataObject->content = $cachedContent;
//
//        return $dataObject;
//    }
//}
