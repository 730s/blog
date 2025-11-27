<?php

namespace App\Core;

class Controller {
    /**
     * Carrega um Modelo (Model).
     * 
     * @param string $model Nome do modelo a ser instanciado.
     * @return object Instância do modelo.
     */
    public function model($model) {
        require_once '../app/Models/' . $model . '.php';
        $modelClass = "App\\Models\\" . $model;
        return new $modelClass();
    }

    /**
     * Carrega uma Visualização (View).
     * 
     * @param string $view Nome do arquivo da view (sem extensão .php).
     * @param array $data Dados a serem passados para a view (opcional).
     */
    public function view($view, $data = []) {
        // Verifica se o arquivo da view existe
        if (file_exists('../app/Views/' . $view . '.php')) {
            require_once '../app/Views/' . $view . '.php';
        } else {
            // Interrompe a execução se a view não for encontrada
            die("View does not exist.");
        }
    }
}
