<?php
declare(strict_types=1);
namespace setup\security;
use JetBrains\PhpStorm\NoReturn;
use setup\config\xgen;
use Gemstone\main;
use setup\config\Display;
use stdClass;

require_once __DIR__.'/../../vendor/autoload.php';
// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");
class Gems_Auth
{

    public array $validator = [];

    protected xgen $conn;

    protected main $main;


    private array $token = [
        'type1' => 'Diamond', 'type2' => 'Ruby', 'type3' => 'Sapphire', 'type4' => 'Lapis Lazuli'
    ];

    public function __construct()
    {
        $this->conn = new xgen();
        $this->main = new main();

    }

    public function schema(string $table, array $data): bool
    {

        $get = $this->fetachdata($table);
        return $this->compareArrays([$data], $get);
    }

    private function fetachdata(string $table): stdClass
    {
        $data = $this->conn->show($table);
        $data1 = $data;
        return  $this->arrayToObject($data1);
    }

    private function compareArrays($array1, $array2): bool
    {
        foreach ($array1 as $item1) {
            $foundMatch = false;
            foreach ($array2 as $item2) {
                if ($this->compareObjects($item1, $item2)) {
                    $foundMatch = true;
                    break;
                }
            }
            if (!$foundMatch) {
                return false;
            }
        }
        return true;
    }

    private function compareObjects($obj1, $obj2): bool
    {
        foreach ($obj1 as $key => $value) {
            if (!property_exists($obj2, $key) || $obj2->$key !== $value) {
                return false;
            }
        }
        return true;
    }

    protected function arrayToObject(array $array =[]): stdClass
    {
        if (is_array($array)) {
            $obj = new stdClass();
            foreach ($array as $key => $value) {
                $obj->$key = is_array($value) ? $this->arrayToObject($value) : $value;
            }
            return $obj;
        }
        return $array;
    }


    /**
     * Redirect
     */

    #[NoReturn] public function redirect(string $url, int $status = 302): void
    {
        header("Location: $url", true, $status);
        exit();
    }


    /**
     * @param int $set_time
     * @return void
     * creating session after login
     */
    public function start_session(int $set_time = 10,  int $cookie_expiration = 10): void
    {
        // Set the expiration time for the session (in seconds)
        $expirationTime = time() + $set_time;

        // Store the expiration time in the session
        $_SESSION['expiration_time'] = $expirationTime;

        // Set a cookie with the session expiration time
        setcookie('session_expiration', (string)$expirationTime, [
            'expires' => time() + $cookie_expiration,
            'path' => '/',
            'secure' => '',   // Transmit only over HTTPS
            'httponly' => true, // Prevent JavaScript access
            'samesite' => 'Strict', // Apply strict SameSite attribute
        ]);

        $this->premake_token();
    }

    public function endSession(): void
    {
        $this->clear_token();
    }

    private function regenerateSessionId(): void
    {
        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);
    }




    /**
     * @return void
     */
    private function premake_token(): void
    {
        $shuffledValues = array_values($this->token);
        shuffle($shuffledValues);
        $shuffledArray = array_combine(array_keys($this->token), $shuffledValues);
        $this->generate_gemstone_token_time($shuffledArray);
    }

    private function generate_gemstone_token_time(array $data = []):void {
        $random_key = array_rand($data);
        $random_value = $data[$random_key];

        $randlength = random_int(64, 128);
        $random_data[] = substr(bin2hex(random_bytes($randlength)), 0, $randlength);

        $crypt = $this->main->ed($random_value, $random_data);

        $_SESSION['Gemstone_Auth_Token'] = $crypt;
    }

    private function clear_token(): void
    {
        if (isset($_SESSION['Gemstone_Auth_Token'])) {
            unset($_SESSION['Gemstone_Auth_Token']);
        }

        // Clear the expiration_time session variable
        if (isset($_SESSION['expiration_time'])) {
            unset($_SESSION['expiration_time']);
        }

        // Clear all session variables
        $_SESSION = array();

        //

        if (isset($_COOKIE['session_expiration'])) {
            unset($_COOKIE['session_expiration']);
            setcookie('session_expiration', '', time() - 3600, '/');        }
        // Destroy the session
        session_destroy();
    }




}



//
//
//    public function start_session() {
//        $this->pre_make_token();
//    }
//
//    public function regenerate_token(): void
//    {
//        if(isset($_COOKIE['Gemstone_Auth_Token'])){
//            $this->remove_gemstone_token_cookie();
//        }
//
//    }
//
//    private function pre_make_token() {
//        $shuffledValues = array_values($this->token);
//        shuffle($shuffledValues);
//        $shuffledArray = array_combine(array_keys($this->token), $shuffledValues);
//
//        return $this->generate_gemstone_token_time($shuffledArray);
//    }
//
//
//    /**
//     * @throws \Exception
//     */
//    private function generate_gemstone_token_time(array $data = []): ?string
//    {
//
//        $random_key = array_rand($data);
//        $random_value = $data[$random_key];
//
//        //generate random string
//        $randlength = random_int(64,128);
//        $random_data [] = substr(bin2hex(random_bytes($randlength)), 0, $randlength);
//
//        $crypt = $this->main->ed($random_value, $random_data);
//
//        setcookie('Gemstone_Auth_Token', $crypt, [
//            'expires' => time() + 3600,
//            'path' => '/',
//            'secure' => false,
//            'httponly' => true,
//            'samesite' => 'Strict',
//        ]);
//
//
//
//        return $crypt;
//    }
//
//
//    public function logout() {
//        $this->remove_gemstone_token_cookie();
//        // Perform any other logout actions here
//    }
//
//    private function remove_gemstone_token_cookie(): void
//    {
//        setcookie('Gemstone_Auth_Token', '', time() - 3600, '/');
//    }
//

//}
