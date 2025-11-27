<?php

namespace App\Models;

use App\Core\Model;

class User extends Model {
    protected $table = 'users';

    /**
     * Registra um novo usuário.
     * 
     * @param array $data Dados do usuário (username, email, password).
     * @return bool True se registrado com sucesso, False caso contrário.
     */
    public function register($data) {
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        return $stmt->execute([
            'username' => $data['username'],
            'email' => $data['email'],
            // Hash da senha para segurança
            'password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }

    /**
     * Realiza o login do usuário.
     * 
     * @param string $email Email do usuário.
     * @param string $password Senha do usuário.
     * @return mixed Dados do usuário se login bem-sucedido, False caso contrário.
     */
    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        // Verifica se o usuário existe e se a senha corresponde ao hash
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    /**
     * Busca um usuário pelo email.
     * 
     * @param string $email Email a ser buscado.
     * @return mixed Dados do usuário ou False.
     */
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    /**
     * Busca um usuário pelo nome de usuário.
     * 
     * @param string $username Nome de usuário a ser buscado.
     * @return mixed Dados do usuário ou False.
     */
    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }

    /**
     * Busca um usuário pelo ID.
     * 
     * @param int $id ID do usuário.
     * @return mixed Dados do usuário ou False.
     */
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Atualiza os dados do usuário.
     * 
     * @param int $id ID do usuário.
     * @param array $data Novos dados do usuário.
     * @return bool True se atualizado com sucesso, False caso contrário.
     */
    public function update($id, $data) {
        $query = "UPDATE users SET username = :username, email = :email";
        $params = [
            'id' => $id,
            'username' => $data['username'],
            'email' => $data['email']
        ];

        // Atualiza a senha apenas se for fornecida
        if (!empty($data['password'])) {
            $query .= ", password = :password";
            $params['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $query .= " WHERE id = :id";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }
}
