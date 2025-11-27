<?php require_once '../app/Views/layouts/header.php'; ?>

<div class="auth-container">
    <h2><i class="fa-solid fa-user-pen"></i> Meu Perfil</h2>

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

    <?php if (isset($success)): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: '<?= $success ?>',
                    confirmButtonColor: '#d6e6c3',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/user/update" method="POST">
        <div class="form-group">
            <label for="username">Usuário</label>
            <div class="input-wrapper">
                <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-wrapper">
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Nova Senha (deixe em branco para manter)</label>
            <div class="input-wrapper">
                <input type="password" name="password" id="password" placeholder="Nova senha">
            </div>
        </div>

        <button type="submit" class="btn">Salvar Alterações</button>
    </form>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
