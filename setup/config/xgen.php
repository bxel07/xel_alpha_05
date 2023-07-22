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


    public function showById(string $table, $id)
    {
        return $this->selectById($id, $table);
        // TODO: Implement showById() method.
    }

    /**
     * @param array $data
     * @param string $table
     * @param int $recordId
     * @return mixed
     */
    public function renew(array $data, string $table, $recordId)
    {
        return $this->update($data,$table,$recordId);
        // TODO: Implement renew() method.
    }

    /**
     * @param string $table
     * @param  $id
     * @return mixed
     */
    public function destroy(string $table, $id)
    {
        return $this->delete($table,$id);
        // TODO: Implement destroy() method.
    }

    /**
     * @param array $data
     * @param string $table
     * @return mixed
     */
    public function insert(array $data, string $table)
    {
        return $this->insertdata($data,$table);
        // TODO: Implement insert() method.
    }
}