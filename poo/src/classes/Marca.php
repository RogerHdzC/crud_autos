<?php
require_once 'EntidadBase.php';

class Marca extends EntidadBase {
    public function __construct() {
        parent::__construct("marcas", "marca_id");
    }

    public function add($name) {
        $this->execute("INSERT INTO marcas (marca_name) VALUES (:name)", ['name' => $name]);
    }

    public function edit($id, $name) {
        $this->execute("UPDATE marcas SET marca_name = :name WHERE marca_id = :id", ['id' => $id, 'name' => $name]);
    }
}
