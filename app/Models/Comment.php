<?php

namespace App\Models;

use App\Core\Model;

class Comment extends Model {
    protected $table = 'comments';

    /**
     * Busca comentários de um post específico.
     * 
     * @param int $postId ID do post.
     * @return array Lista de comentários com nome do autor.
     */
    public function getByPostId($postId) {
        // JOIN para incluir o nome do usuário que fez o comentário
        $stmt = $this->db->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = :post_id ORDER BY created_at DESC");
        $stmt->execute(['post_id' => $postId]);
        return $stmt->fetchAll();
    }

    /**
     * Cria um novo comentário.
     * 
     * @param array $data Dados do comentário (post_id, user_id, content).
     * @return bool True se criado com sucesso.
     */
    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (:post_id, :user_id, :content)");
        return $stmt->execute([
            'post_id' => $data['post_id'],
            'user_id' => $data['user_id'],
            'content' => $data['content']
        ]);
    }
}
