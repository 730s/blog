<?php

namespace App\Controllers;

use App\Core\Controller;

class CommentsController extends Controller {
    /**
     * Cria um novo comentário em um post.
     * Requer que o usuário esteja logado.
     */
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
            $data = [
                'post_id' => $_POST['post_id'],
                'user_id' => $_SESSION['user_id'],
                'content' => $_POST['content']
            ];

            $commentModel = $this->model('Comment');
            $commentModel->create($data);
            
            // Redireciona de volta para o post
            header('Location: ' . BASE_URL . '/posts/show/' . $_POST['post_id']);
        } else {
            header('Location: ' . BASE_URL . '/');
        }
    }
}
