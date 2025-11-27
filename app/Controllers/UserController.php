<?php

namespace App\Controllers;

use App\Core\Controller;

class UserController extends Controller {
    /**
     * Exibe a página de perfil do usuário.
     */
    public function profile() {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            return;
        }

        $userModel = $this->model('User');
        $user = $userModel->findById($_SESSION['user_id']);

        $this->view('user/profile', ['user' => $user]);
    }

    /**
     * Atualiza as informações do perfil do usuário.
     */
    public function update() {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('User');
            $id = $_SESSION['user_id'];
            
            // Validação: verifica se o email já existe (excluindo o próprio usuário)
            $existingEmail = $userModel->findByEmail($_POST['email']);
            if ($existingEmail && $existingEmail['id'] != $id) {
                $user = $userModel->findById($id);
                $this->view('user/profile', ['user' => $user, 'error' => 'Este email já está em uso por outro usuário.']);
                return;
            }

            // Validação: verifica se o nome de usuário já existe (excluindo o próprio usuário)
            $existingUser = $userModel->findByUsername($_POST['username']);
            if ($existingUser && $existingUser['id'] != $id) {
                $user = $userModel->findById($id);
                $this->view('user/profile', ['user' => $user, 'error' => 'Este nome de usuário já está em uso.']);
                return;
            }

            // Tenta atualizar o usuário
            if ($userModel->update($id, $_POST)) {
                // Atualiza a sessão com o novo nome de usuário
                $_SESSION['username'] = $_POST['username'];
                
                // Recarrega os dados do usuário para exibir na view
                $user = $userModel->findById($id);
                $this->view('user/profile', ['user' => $user, 'success' => 'Perfil atualizado com sucesso!']);
            } else {
                $user = $userModel->findById($id);
                $this->view('user/profile', ['user' => $user, 'error' => 'Falha ao atualizar perfil. Tente novamente.']);
            }
        }
    }
}
