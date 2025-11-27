<?php

namespace App\Core;

use App\Config\Database;
use PDO;

class Model {
    protected $db;
    protected $table;

    /**
     * Construtor da classe Model.
     * Inicializa a conexão com o banco de dados.
     */
    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Busca todos os registros da tabela associada ao modelo.
     * 
     * @return array Array de objetos ou arrays associativos com os dados.
     */
    public function findAll() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Busca um registro pelo ID.
     * 
     * @param int $id ID do registro.
     * @return mixed O registro encontrado ou false.
     */
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Deleta um registro pelo ID.
     * 
     * @param int $id ID do registro a ser deletado.
     * @return bool True se deletado com sucesso, False caso contrário.
     */
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
