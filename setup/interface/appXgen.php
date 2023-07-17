<?php

namespace setup\interface;

interface appXgen {
    /*
        This is an interface function witch used for integrate indirectly
        between xgen core system with service layer and basedata.
    */
    public function show(string $table);
    public function showById(string $table, int $id);
    public function insert(string $table, array $data);
    public function renew(string $table, array $data, int $recordId);
    public function destroy(string $table, int $id);
}