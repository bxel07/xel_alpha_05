<?php

namespace setup\system\transmission;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use setup\system\core\xgenhandler; // Import the handler class

require_once __DIR__ . "/../../../vendor/autoload.php";

class RequestHandler
{
    public $databaseHandler; // Add a private property for the handler instance

    public function __construct()
    {
        $this->databaseHandler = new xgenhandler(); // Create an instance of the handler class
    }

    // Main Driver
    public function driver()
    {
        // Example GET request
        $this->solve_GET();

        // Example POST request
        $this->solve_POST();

        // Example UPDATE request
        $this->solve_UPDATE();

        // Example DELETE request
        $this->solve_DELETE();
    }

    // GET
    public function solve_GET()
    {
        // Use the handler instance to interact with the database
        $this->databaseHandler->showall();
    }

    // POST
    public function solve_POST()
    {
        // Use the handler instance to interact with the database
        $this->databaseHandler->create("New Title", "New Content");
    }

    // UPDATE
    public function solve_UPDATE()
    {
        // Use the handler instance to interact with the database
        $this->databaseHandler->update(3);
    }

    // DELETE
    public function solve_DELETE()
    {
        // Use the handler instance to interact with the database
        $this->databaseHandler->delete(2);
    }
}

// Usage
$requestHandler = new RequestHandler();
$requestHandler->driver();
