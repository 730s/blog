<?php

namespace App\Config;

class Config {
    public static function getBaseUrl() {
        // Verifica se está rodando em localhost
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        
        // Detecta o diretório do script (para subdiretórios)
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
        
        // Remove barras invertidas (Windows) e barra final
        $scriptDir = str_replace('\\', '/', $scriptDir);
        $scriptDir = rtrim($scriptDir, '/');
        
        return $protocol . "://" . $host . $scriptDir . '/index.php';
    }

    public static function getAssetUrl() {
        // Verifica se está rodando em localhost
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        
        // Detecta o diretório do script (para subdiretórios)
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
        
        // Remove barras invertidas (Windows) e barra final
        $scriptDir = str_replace('\\', '/', $scriptDir);
        $scriptDir = rtrim($scriptDir, '/');
        
        return $protocol . "://" . $host . $scriptDir;
    }
}

// Define a constante BASE_URL globalmente
define('BASE_URL', Config::getBaseUrl());
define('ASSET_URL', Config::getAssetUrl());
