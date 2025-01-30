<?php
require_once 'Database.php';

abstract class EntidadBase {
    protected $pdo;
    protected $table;
    protected $primaryKey;

    public function __construct($table, $primaryKey) {
        $this->pdo = (new Database())->connect();
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    public function getById($id) {
        return $this->executeFetch("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?", [$id]);
    }

    public function getAll() {
        return $this->executeFetchAll("SELECT * FROM {$this->table}");
    }

    public function delete($id) {
        $this->execute("DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?", [$id]);
    }

    protected function execute($query, $params = []) {
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    protected function executeFetch($query, $params = []) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function executeFetchAll($query, $params = []) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
