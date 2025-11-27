<?php

namespace App\Models;

use App\Core\Model;

class Post extends Model {
    protected $table = 'posts';
    
    /**
     * Busca todos os posts juntamente com o nome do autor.
     * 
     * @return array Lista de posts com dados do usuário.
     */
    public function getAllWithUsers() {
        // JOIN para pegar o nome do usuário que criou o post
        $stmt = $this->db->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Busca um post específico com o nome do autor.
     * 
     * @param int $id ID do post.
     * @return mixed Dados do post com nome do autor.
     */
    public function findWithUser($id) {
        $stmt = $this->db->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Cria um novo post.
     * 
     * @param array $data Dados do post (user_id, title, content, image).
     * @return bool True se criado com sucesso.
     */
    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO posts (user_id, title, content, image) VALUES (:user_id, :title, :content, :image)");
        return $stmt->execute([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $data['image'] ?? null
        ]);
    }

    /**
     * Atualiza um post existente.
     * 
     * @param int $id ID do post.
     * @param array $data Novos dados do post.
     * @return bool True se atualizado com sucesso.
     */
    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE posts SET title = :title, content = :content, image = :image WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $data['image'] ?? null
        ]);
    }
}
