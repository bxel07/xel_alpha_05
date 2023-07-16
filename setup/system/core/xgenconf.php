<?php

namespace setup\system\core;
use setup\config\BaseConn;
use PDO;

class xgenconf{
    public function connection():PDO {
        $instance = new BaseConn();
        return $instance->getPDO();
    }

    // select all
    protected function selectAll(string $table) {

        try {
            $conn = $this->connection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM ".$table);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            echo "query error :" . $exception->getMessage();
        }
    }
    // select by id
    protected function selectById(int $id, string $table) {
        try {
            $conn = $this->connection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM ".$table." where id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $exception) {
            echo "query error :" . $exception->getMessage();
        }
    }

    // insert
    protected function insertdata(array $data, string $table) {
        try {
            $conn = $this->connection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Set PDO attribute to use unbuffered queries
            $conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

            $fields = array_keys($data);
            $placeholders = ":" . implode(", :", $fields);

            $sql = "INSERT INTO $table (" . implode(", ", $fields) . ") VALUES (" . $placeholders . ")";
            $stmt = $conn->prepare($sql);

            // Bind each value from the $data array to the corresponding placeholder in the SQL statement
            foreach ($data as $field => $value) {
                $stmt->bindValue(":$field", $value);
            }
            $stmt->execute();
            echo "query success";
        } catch (\PDOException $exception) {
            echo "query error: " . $exception->getMessage();
        }
    }

    // update
    public function update(array $data, string $table, int $recordId)
    {
        try {
            $conn = $this->connection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Build the SET part of the UPDATE statement with column=value pairs
            $setValues = [];
            foreach ($data as $field => $value) {
                $setValues[] = "$field = :$field";
            }
            $setClause = implode(", ", $setValues);

            $sql = "UPDATE $table SET $setClause WHERE id = :record_id";
            $stmt = $conn->prepare($sql);

            // Bind each value from the $data array to the corresponding placeholder in the SQL statement
            foreach ($data as $field => $value) {
                $stmt->bindValue(":$field", $value);
            }

            // Bind the recordId to the placeholder :record_id
            $stmt->bindValue(":record_id", $recordId, PDO::PARAM_INT);

            $stmt->execute();
            echo "Query successful";
        } catch (\PDOException $exception) {
            echo "Query error: " . $exception->getMessage();
        }
    }

    // delete
    protected function delete(string $table, int $id) {
        try {
            $conn = $this->connection();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("DELETE FROM ".$table." where id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (\PDOException $exception) {
            echo "Query error: " . $exception->getMessage();
        }
    }

}