<?php
require_once 'Database.php';

class Modelo {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->connect();
    }

    public function getById($id) {
        return $this->executeFetch("SELECT * FROM modelos WHERE modelo_id = ?", [$id]);
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

    public function delete($id) {
        $this->execute("DELETE FROM modelos WHERE modelo_id = :id", ['id' => $id]);
    }

    public function edit($id, $marcaId, $name) {
        $this->execute("UPDATE modelos SET marca_id = :marca_id, modelo_name = :name WHERE modelo_id = :id", [
            'marca_id' => $marcaId,
            'id' => $id,
            'name' => $name
        ]);
    }    

    private function execute($query, $params = []) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    private function executeFetch($query, $params = []) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    private function executeFetchAll($query, $params = []) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }
}
