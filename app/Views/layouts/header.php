<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Leo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?= ASSET_URL ?>/css/style.css">
</head>
<body>
    <nav>
        <div class="container">
            <a href="<?= BASE_URL ?>/" class="logo">Blog Leo</a>
            <ul>
                <li><a href="<?= BASE_URL ?>/">Home</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="<?= BASE_URL ?>/posts/create">Novo Post</a></li>
                    <li><a href="<?= BASE_URL ?>/auth/logout">Sair (<?= $_SESSION['username'] ?>)</a></li>
                <?php else: ?>
                    <li><a href="<?= BASE_URL ?>/auth/login">Login</a></li>
                    <li><a href="<?= BASE_URL ?>/auth/register">Cadastro</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="container main-content">
