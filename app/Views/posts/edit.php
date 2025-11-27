<?php require_once '../app/Views/layouts/header.php'; ?>

<div class="container main-content">
    
    <div class="content-form-card">
        <h2>Editar Post</h2>
        
        <?php if (isset($data['error'])): ?>
            <div class="alert error"><?= $data['error'] ?></div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/posts/edit/<?= $data['post']['id'] ?>" method="POST">
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title" id="title" value="<?= htmlspecialchars($data['post']['title']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="image">URL da Imagem (Opcional)</label>
                <input type="text" name="image" id="image" value="<?= htmlspecialchars($data['post']['image']) ?>">
            </div>
            
            <div class="form-group">
                <label for="content">Conteúdo</label>
                <textarea name="content" id="content" rows="10" required><?= htmlspecialchars($data['post']['content']) ?></textarea>
            </div>
            
            <button type="submit" class="btn">Atualizar Post</button>
        </form>
    </div>
    </div>

<?php require_once '../app/Views/layouts/footer.php'; ?>