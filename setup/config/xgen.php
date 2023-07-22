<?php

namespace setup\config;

use setup\system\core\xgenconf;
use setup\interface\appXgen;
class xgen extends xgenconf implements appXgen{

    /**
     * @param string $table
     * @return mixed
     */
    public function show(string $table)
    {
        return  $this->selectAll($table);
        // TODO: Implement show() method.
    }

    /**
     * @param string $table
     * @param int $id
     * @return mixed
     */
    public function showById(string $table, int $id)
    {
        return $this->selectById($table, $id);
        // TODO: Implement showById() method.
    }

    /**
     * @param array $data
     * @param string $table
     * @param int $recordId
     * @return mixed
     */
    public function renew(string $table, array $data, int $recordId)
    {
        return $this->update($table,$data,$recordId);
        // TODO: Implement renew() method.
    }

    /**
     * @param string $table
     * @param int $id
     * @return mixed
     */
    public function destroy(string $table, int $id)
    {
        return $this->delete($table,$id);
        // TODO: Implement destroy() method.
    }

    /**
     * @param array $data
     * @param string $table
     * @return mixed
     */
    public function insert(string $table, array $data)
    {
        return $this->insertdata($table, $data);
        // TODO: Implement insert() method.
    }
}