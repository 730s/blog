<?php require_once '../app/Views/layouts/header.php'; ?>

<div class="container main-content">
    
    <article class="post-detail-card">
        <?php if ($data['post']['image']): ?>
            <img src="<?= ASSET_URL ?>/<?= $data['post']['image'] ?>" alt="<?= $data['post']['title'] ?>">
        <?php endif; ?>
        
        <h1><?= $data['post']['title'] ?></h1>
        <p class="meta">
            Por <strong><?= $data['post']['username'] ?></strong> em <?= date('d/m/Y \à\s H:i', strtotime($data['post']['created_at'])) ?>
        </p>
        
        <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $data['post']['user_id'] || $_SESSION['role'] == 'admin')): ?>
            <div class="actions">
                <a href="<?= BASE_URL ?>/posts/edit/<?= $data['post']['id'] ?>" class="btn">Editar</a>
                <a href="<?= BASE_URL ?>/posts/delete/<?= $data['post']['id'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este post?')">Excluir</a>
            </div>
        <?php endif; ?>

        <div class="content-body">
            <?= nl2br(htmlspecialchars($data['post']['content'])) ?>
        </div>
    </article>
    <div class="comments-section">
        <h3>Comentários</h3>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="comment-card" style="background-color: var(--bg-input);">
                <form action="<?= BASE_URL ?>/comments/create" method="POST">
                    <input type="hidden" name="post_id" value="<?= $data['post']['id'] ?>">
                    <div class="form-group" style="margin-bottom: 10px;">
                        <textarea name="content" rows="3" placeholder="Escreva um comentário..." required style="min-height: 80px;"></textarea>
                    </div>
                    <button type="submit" class="btn">Comentar</button>
                </form>
            </div>
        <?php else: ?>
            <p style="text-align: center; margin-bottom: 20px;">
                <a href="<?= BASE_URL ?>/auth/login" style="color: var(--text-main); font-weight: bold;">Faça login</a> para comentar.
            </p>
        <?php endif; ?>

        <div class="comments-list">
            <?php if (!empty($data['comments'])): ?>
                <?php foreach ($data['comments'] as $comment): ?>
                    <div class="comment-card">
                        <p><strong><?= $comment['username'] ?></strong> disse:</p>
                        <p style="margin: 8px 0;"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                        <small style="color: var(--text-muted);"><?= date('d/m/Y H:i', strtotime($comment['created_at'])) ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; color: var(--text-muted);">Seja o primeiro a comentar!</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>