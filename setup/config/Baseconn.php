<?php

// psr-4 autoloading
namespace setup\config;
//require_once __DIR__."./../../vendor/autoload.php";

// library mengaktifkan variabel globel
use Dotenv\Dotenv;

// library PDO mysql
use PDO;
use PDOException;

class BaseConn {
    // attribute untuk koneksi pdo
    private $pdo;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__.'/../..');
        $dotenv->load();

        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $database = $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        try {
            $this->pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Cant connect to database " . $e;
        }
    }

    // untuk testing
    public function getPDO(){
        return $this->pdo;
    }
}
?>