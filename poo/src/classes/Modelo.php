<?php
require_once 'EntidadBase.php';

class Modelo extends EntidadBase {
    public function __construct() {
        parent::__construct("modelos", "modelo_id");
    }

    public function getAllWithMarca() {
        return $this->executeFetchAll("
            SELECT modelos.modelo_id, modelos.modelo_name, marcas.marca_name 
            FROM modelos 
            JOIN marcas ON modelos.marca_id = marcas.marca_id
        ");
    }

    public function add($marcaId, $name) {
        $this->execute("INSERT INTO modelos (marca_id, modelo_name) VALUES (:marca_id, :name)", [
            'marca_id' => $marcaId,
            'name' => $name
        ]);
    }

    public function edit($id, $marcaId, $name) {
        $this->execute("UPDATE modelos SET marca_id = :marca_id, modelo_name = :name WHERE modelo_id = :id", [
            'marca_id' => $marcaId,
            'id' => $id,
            'name' => $name
        ]);
    }
}
