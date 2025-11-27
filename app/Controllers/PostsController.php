<?php

namespace App\Controllers;

use App\Core\Controller;

class PostsController extends Controller {
    /**
     * Construtor do controlador de Posts.
     * Verifica se o usuário está logado para ações restritas (middleware simples).
     */
    public function __construct() {
        // Se não estiver logado e não for a página inicial
        if (!isset($_SESSION['user_id']) && $_SERVER['REQUEST_URI'] != '/') {
            // Permite visualizar posts, mas restringe criar, editar e deletar
            $action = explode('/', $_SERVER['REQUEST_URI'])[2] ?? '';
            if (in_array($action, ['create', 'edit', 'delete'])) {
                header('Location: ' . BASE_URL . '/auth/login');
                exit;
            }
        }
    }

    /**
     * Exibe um post específico e seus comentários.
     * 
     * @param int $id ID do post.
     */
    public function show($id) {
        $postModel = $this->model('Post');
        $post = $postModel->findWithUser($id);
        
        // Se o post não existir, redireciona para a home
        if (!$post) {
            header('Location: ' . BASE_URL . '/');
            exit;
        }

        // Busca os comentários do post
        $commentModel = $this->model('Comment');
        $comments = $commentModel->getByPostId($id);

        $this->view('posts/show', ['post' => $post, 'comments' => $comments]);
    }

    /**
     * Cria um novo post.
     */
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image' => $_POST['image'] // Em uma aplicação real, aqui seria feito o upload do arquivo
            ];

            $postModel = $this->model('Post');
            if ($postModel->create($data)) {
                header('Location: ' . BASE_URL . '/');
            } else {
                $this->view('posts/create', ['error' => 'Something went wrong']);
            }
        } else {
            $this->view('posts/create');
        }
    }

    /**
     * Edita um post existente.
     * 
     * @param int $id ID do post.
     */
    public function edit($id) {
        $postModel = $this->model('Post');
        $post = $postModel->findById($id);

        // Verifica permissão: apenas o autor ou admin podem editar
        if ($post['user_id'] != $_SESSION['user_id'] && $_SESSION['role'] != 'admin') {
            header('Location: ' . BASE_URL . '/');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image' => $_POST['image']
            ];

            if ($postModel->update($id, $data)) {
                header('Location: ' . BASE_URL . '/posts/show/' . $id);
            } else {
                $this->view('posts/edit', ['post' => $post, 'error' => 'Something went wrong']);
            }
        } else {
            $this->view('posts/edit', ['post' => $post]);
        }
    }

    /**
     * Deleta um post.
     * 
     * @param int $id ID do post.
     */
    public function delete($id) {
        $postModel = $this->model('Post');
        $post = $postModel->findById($id);

        // Verifica permissão: apenas o autor ou admin podem deletar
        if ($post['user_id'] == $_SESSION['user_id'] || $_SESSION['role'] == 'admin') {
            $postModel->delete($id);
        }

        header('Location: ' . BASE_URL . '/');
    }
}
