<?php require_once '../app/Views/layouts/header.php'; ?>

<div class="auth-container">
    <h2><i class="fa-solid fa-right-to-bracket"></i> Login</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <i class="fa-solid fa-circle-exclamation"></i> <?= $error ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/auth/login" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-wrapper">
                <input type="email" name="email" id="email" placeholder="seu@email.com" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <div class="input-wrapper">
                <input type="password" name="password" id="password" placeholder="Sua senha" required>
            </div>
        </div>

        <button type="submit" class="btn">Entrar</button>
    </form>

    <p>Não tem conta? <a href="<?= BASE_URL ?>/auth/register">Cadastre-se</a></p>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>