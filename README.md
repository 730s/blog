# Blog MVC em PHP

Este é um projeto de Blog desenvolvido para a disciplina de Programação WEB, utilizando PHP (sem frameworks), HTML, CSS e JavaScript. O sistema segue o padrão de arquitetura MVC (Model-View-Controller).

## Funcionalidades

- **Autenticação**: Cadastro e Login de usuários.
- **Posts**: Criação, visualização, edição e exclusão de posts (CRUD).
- **Comentários**: Adição e listagem de comentários em posts.
- **Segurança**: Proteção contra SQL Injection (Prepared Statements), hash de senhas e controle de sessão.
- **Interface**: Layout responsivo e feedback visual.

## Estrutura do Projeto

A estrutura de diretórios segue o padrão MVC:

- `app/`
    - `Config/`: Configurações do banco de dados (`Database.php`).
    - `Controllers/`: Lógica de controle (`AuthController`, `PostController`, etc.).
    - `Core/`: Classes base do framework (`App`, `Controller`, `Model`).
    - `Models/`: Acesso a dados (`User`, `Post`, `Comment`).
    - `Views/`: Templates HTML (`auth`, `home`, `posts`, `layouts`).
- `public/`: Raiz do servidor web.
    - `css/`: Estilos CSS.
    - `js/`: Scripts JavaScript.
    - `index.php`: Ponto de entrada da aplicação.
- `sql/`: Scripts de banco de dados (`schema.sql`).

## Configuração e Instalação (XAMPP)

1.  **Preparação**:
    - Certifique-se de ter o XAMPP instalado e os serviços Apache e MySQL rodando.
    - Mova a pasta do projeto para o diretório `htdocs` do XAMPP (geralmente `C:\xampp\htdocs`).
    - O caminho final deve ser algo como `C:\xampp\htdocs\Blog`.

2.  **Banco de Dados**:
    - Acesse o phpMyAdmin em `http://localhost/phpmyadmin`.
    - Crie um banco de dados chamado `blog_db`.
    - Importe o arquivo `sql/schema.sql` (na aba "Importar") para criar as tabelas.
    - **Nota**: O projeto já está configurado para usar as credenciais padrão do XAMPP (usuário `root`, senha vazia). Se o seu XAMPP tiver senha, edite `app/Config/Database.php`.

3.  **Acesso**:
    - Abra o navegador e acesse `http://localhost/Blog/public`.
    - O sistema detectará automaticamente o caminho base, então deve funcionar corretamente mesmo em subdiretórios.

## Como Funciona (Arquitetura MVC)

O sistema utiliza uma arquitetura MVC personalizada para organizar o código e separar as responsabilidades.

### 1. Roteamento (Core/App.php)
Toda requisição é direcionada para o `public/index.php`, que instancia a classe `App`.
- A classe `App` analisa a URL (ex: `/posts/show/1`).
- O primeiro segmento define o **Controller** (`PostsController`).
- O segundo segmento define o **Método** (`show`).
- Os demais segmentos são passados como **Parâmetros** (`1`).

### 2. Controladores (Controllers/)
Os controladores recebem a requisição e decidem o que fazer.
- Eles podem carregar **Models** para buscar dados.
- Eles carregam **Views** para exibir a resposta ao usuário.
- Exemplo: `PostsController::show($id)` busca o post pelo ID usando o Model e carrega a view `posts/show`.

### 3. Modelos (Models/)
Responsáveis pela lógica de dados e interação com o banco de dados.
- Estendem a classe base `Model`, que já possui a conexão PDO.
- Exemplo: `Post::findWithUser($id)` executa uma query SQL com JOIN para buscar o post e o autor.

### 4. Visualizações (Views/)
Arquivos PHP/HTML que exibem os dados para o usuário.
- Recebem dados do controlador através da variável `$data`.
- Exemplo: `<?php echo $data['post']['title']; ?>`.

## Tecnologias Utilizadas

- **Backend**: PHP 8+ (PDO)
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Banco de Dados**: MySQL

## Autor

Desenvolvido por Leonardo Sade para o trabalho de Programação WEB.
