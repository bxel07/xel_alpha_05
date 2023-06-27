<?php

// // Bundle class
// namespace devise\Basedata;

// // integrasi class ke koneksi
// use xel\framework\Devise\BaseConn;
// // use xel\framework\Helper\Xgenquery as autoquery;

// // autoloader psr-4
// require_once __DIR__."/../../vendor/autoload.php";

// // Melihat display error
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// class Basedata {
//     // attribute menampung koneksi database
//     protected $conn;
//     protected $xgen;

//     public function __construct()
//     {
//         // instance koneksi database
//         $this->conn = new BaseConn();

//         // Auto Query
//         // $this->xgen = new autoquery();
//     }

//     public function verified(){
//         return $this->conn->getPDO();
//     }
// }