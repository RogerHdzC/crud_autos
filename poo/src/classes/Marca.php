<?php
require_once 'Database.php';

class Marca {
    private $pdo;

    public function __construct() {
        $this->pdo = (new Database())->connect();
    }

    public function getById($id) {
        return $this->executeFetch("SELECT * FROM marcas WHERE marca_id = ?", [$id]);
    }

    public function getAll() {
        return $this->executeFetchAll("SELECT * FROM marcas");
    }

    public function add($name) {
        $this->execute("INSERT INTO marcas (marca_name) VALUES (:name)", ['name' => $name]);
    }

    public function delete($id) {
        $this->execute("DELETE FROM marcas WHERE marca_id = :id", ['id' => $id]);
    }

    public function edit($id, $name) {
        $this->execute("UPDATE marcas SET marca_name = :name WHERE marca_id = :id", ['id' => $id, 'name' => $name]);
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
