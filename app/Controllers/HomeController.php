<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {
    /**
     * Exibe a página inicial do blog.
     * Lista todos os posts.
     */
    public function index() {
        $postModel = $this->model('Post');
        $posts = $postModel->getAllWithUsers();
        $this->view('home/index', ['posts' => $posts]);
    }
}
