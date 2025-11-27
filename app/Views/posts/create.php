<?php require_once '../app/Views/layouts/header.php'; ?>

<div class="container main-content">
    
    <div class="content-form-card">
        <h2>Novo Post</h2>
        
        <?php if (isset($data['error'])): ?>
            <div class="alert error"><?= $data['error'] ?></div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/posts/create" method="POST">
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title" id="title" required placeholder="Digite o título do post">
            </div>
            
            <div class="form-group">
                <label for="image">URL da Imagem (Opcional)</label>
                <input type="text" name="image" id="image" placeholder="https://exemplo.com/imagem.jpg">
            </div>
            
            <div class="form-group">
                <label for="content">Conteúdo</label>
                <textarea name="content" id="content" rows="10" required placeholder="Escreva seu conteúdo aqui..."></textarea>
            </div>
            
            <button type="submit" class="btn">Publicar</button>
        </form>
    </div>
    </div>

<?php require_once '../app/Views/layouts/footer.php'; ?>