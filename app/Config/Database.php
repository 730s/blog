<?php

namespace App\Config;

use PDO;
use PDOException;

class Database {
    // Instância única da classe (Padrão Singleton)
    private static $instance = null;
    private $conn;

    // Configurações do banco de dados
    private $host = 'localhost';
    private $db_name = 'blog_db';
    private $username = 'root';
    private $password = '';

    /**
     * Construtor privado para impedir instanciação direta.
     * Estabelece a conexão com o banco de dados usando PDO.
     */
    private function __construct() {
        try {
            // Cria a conexão PDO
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            
            // Configura o modo de erro para exceções
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Configura o modo de fetch padrão para array associativo
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            // Define o charset para UTF-8
            $this->conn->exec("set names utf8");
        } catch(PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
    }

    /**
     * Retorna a instância única da conexão com o banco de dados.
     * 
     * @return PDO Objeto de conexão PDO.
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}
