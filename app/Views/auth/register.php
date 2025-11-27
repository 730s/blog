<?php require_once '../app/Views/layouts/header.php'; ?>

<div class="auth-container">
    <h2><i class="fa-solid fa-user-plus"></i> Cadastro</h2>

    <?php if (isset($error)): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?= $error ?>',
                    confirmButtonColor: '#d6e6c3',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/auth/register" method="POST">
        <div class="form-group">
            <label for="username">Usuário</label>
            <div class="input-wrapper">
                <input type="text" name="username" id="username" placeholder="Seu nome de usuário" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-wrapper">
                <input type="email" name="email" id="email" placeholder="seu@email.com" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <div class="input-wrapper">
                <input type="password" name="password" id="password" placeholder="Escolha uma senha forte" required>
            </div>
        </div>

        <button type="submit" class="btn">Cadastrar</button>
    </form>

    <p>Já tem conta? <a href="<?= BASE_URL ?>/auth/login">Faça login</a></p>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>