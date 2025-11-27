<?php

namespace App\Controllers;

use App\Core\Controller;

class AuthController extends Controller {
    /**
     * Gerencia o login do usuário.
     * Exibe o formulário de login (GET) ou processa a autenticação (POST).
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('User');
            $user = $userModel->login($_POST['email'], $_POST['password']);

            if ($user) {
                // Define as variáveis de sessão após login bem-sucedido
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header('Location: ' . BASE_URL . '/');
            } else {
                // Exibe erro se as credenciais forem inválidas
                $this->view('auth/login', ['error' => 'Invalid credentials']);
            }
        } else {
            // Exibe o formulário de login
            $this->view('auth/login');
        }
    }

    /**
     * Gerencia o registro de novos usuários.
     * Exibe o formulário de registro (GET) ou processa o cadastro (POST).
     */
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('User');
            
            // Validação básica: verifica se o email já existe
            if ($userModel->findByEmail($_POST['email'])) {
                $this->view('auth/register', ['error' => 'Email already exists']);
                return;
            }

            // Tenta registrar o usuário
            if ($userModel->register($_POST)) {
                header('Location: ' . BASE_URL . '/auth/login');
            } else {
                $this->view('auth/register', ['error' => 'Registration failed']);
            }
        } else {
            // Exibe o formulário de registro
            $this->view('auth/register');
        }
    }

    /**
     * Realiza o logout do usuário.
     * Destrói a sessão e redireciona para a página de login.
     */
    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . '/auth/login');
    }
}
