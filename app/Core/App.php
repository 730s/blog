<?php

namespace App\Core;

class App {
    // Controlador padrão se nenhum for especificado na URL
    protected $controller = 'HomeController';
    
    // Método padrão se nenhum for especificado
    protected $method = 'index';
    
    // Parâmetros passados na URL
    protected $params = [];

    /**
     * Construtor da classe App.
     * Responsável por processar a URL e rotear para o Controlador e Método apropriados.
     */
    public function __construct() {
        $url = $this->parseUrl();

        // Verifica se o controlador existe (primeiro segmento da URL)
        if (isset($url[0]) && file_exists('../app/Controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        // Inclui o arquivo do controlador e instancia a classe
        require_once '../app/Controllers/' . $this->controller . '.php';
        $this->controller = new ("App\\Controllers\\" . $this->controller);

        // Verifica se o método existe no controlador (segundo segmento da URL)
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Obtém os parâmetros restantes da URL (se houver)
        $this->params = $url ? array_values($url) : [];

        // Chama o método do controlador passando os parâmetros
        // Exemplo: HomeController->index($params)
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Analisa a URL recebida.
     * Retorna um array com os segmentos da URL.
     * 
     * @return array|null
     */
    public function parseUrl() {
        // Se o .htaccess estiver funcionando e passando 'url' via GET
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        // Fallback: Analisa REQUEST_URI manualmente
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $scriptName = $_SERVER['SCRIPT_NAME']; // Ex: /Blog/public/index.php

        // Remove o script name da URI se ele estiver presente no início
        if (strpos($uri, $scriptName) === 0) {
            $uri = substr($uri, strlen($scriptName));
        } elseif (strpos($uri, dirname($scriptName)) === 0) {
            // Remove o diretório do script se estiver presente (caso sem index.php explícito)
            $uri = substr($uri, strlen(dirname($scriptName)));
        }

        // Remove barras extras e sanitiza
        $uri = filter_var(rtrim(ltrim($uri, '/'), '/'), FILTER_SANITIZE_URL);
        
        return $uri ? explode('/', $uri) : [];
    }
}
