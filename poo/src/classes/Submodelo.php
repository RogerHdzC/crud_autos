<?php
require_once 'EntidadBase.php';

class Submodelo extends EntidadBase {
    public function __construct() {
        parent::__construct("submodelos", "submodelo_id");
    }

    public function getAllWithModelo() {
        return $this->executeFetchAll("
            SELECT submodelos.submodelo_id, submodelos.submodelo_name, submodelos.submodelo_year, submodelos.submodelo_ac, modelos.modelo_name 
            FROM submodelos 
            JOIN modelos ON submodelos.modelo_id = modelos.modelo_id
        ");
    }

    public function add($modeloId, $name, $year, $ac) {
        $this->execute("INSERT INTO submodelos (modelo_id, submodelo_name, submodelo_year, submodelo_ac) 
                        VALUES (:modelo_id, :name, :year, :ac)", [
            'modelo_id' => $modeloId,
            'name' => $name,
            'year' => $year,
            'ac' => $ac
        ]);
    }

    public function edit($id, $modeloId, $name, $year, $ac) {
        $this->execute("UPDATE submodelos SET modelo_id = :modelo_id, submodelo_name = :name, submodelo_year = :year, submodelo_ac = :ac WHERE submodelo_id = :id", [
            'modelo_id' => $modeloId,
            'id' => $id,
            'name' => $name,
            'year' => $year,
            'ac' => $ac
        ]);
    }
}
