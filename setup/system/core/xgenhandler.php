<?php


namespace setup\system\core;
require_once __DIR__ . "/../../../vendor/autoload.php";

use PDO;
use setup\config\BaseConn;

class xgenhandler
{
    public function connection(): PDO
    {
        $instance = new BaseConn();
        return $instance->getPDO();
    }

    public function create(string $title, string $content)
    {

        try {
            $conn = $this->connection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $change = [
                "title" => $title,
                "content" => $content
            ];

            $title = $change["title"];
            $content = $change["content"];


            $sql = "INSERT INTO news (title,content) VALUES (:title,:content)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->execute();

            echo "insert  successfully";
        } catch (\PDOException $exception) {
            echo "query error" . $exception->getMessage();
        }
    }

    public function showall()
    {
        $conn = $this->connection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT id, title, content FROM news");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<pre>";
        var_dump($result);
    }

    public function showbyid(int $id)
    {
        $conn = $this->connection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT id, title, content FROM news WHERE id = $id");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result);
    }

    public function getupdate(int $id): array
    {
        $conn = $this->connection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT id, title, content FROM news WHERE id = $id");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update(int $data)
    {
        $conn = $this->connection();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $change = [
            "title" => "ambasing",
            "content" => "zore zore"
        ];

        $title = $change["title"];
        $content = $change["content"];

        $id = $data;// set the value of $id here

        $sql = "UPDATE news SET title = :title, content = :content WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo "update success";
    }

    public function delete($id)
    {
        try {
            $conn = $this->connection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $data = $id;
            $sql = "DELETE from news where id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $data);
            $stmt->execute();
            echo "delete successfully";
        } catch (\PDOException $exception) {
            echo "query error" . $exception->getMessage();
        }
    }
}


//Testing purpose
$instance = new xgenhandler();

////Untuk menampilkan semua data //GET
$instance->showall();
//
////untuk menampilkan spesifik data berdasarkan ID
$instance->showbyid(3);
//
////untuk menambahkan data
$instance->create("kafka", "Please step on me!!");
//
////untuk mengupdate data
$instance->update(3);
//
////untuk menghapus data
$instance->delete(2);