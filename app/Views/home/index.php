<?php require_once '../app/Views/layouts/header.php'; ?>

<div class="container main-content">
    
    <h1 class="section-title">Últimos Posts</h1>

    <div class="posts-grid">
        <?php if (!empty($data['posts'])): ?>
            <?php foreach ($data['posts'] as $post): ?>
                <article class="post-card">
                    <?php if (!empty($post['image'])): ?>
                        <img src="<?= $post['image'] ?>" alt="<?= $post['title'] ?>">
                    <?php else: ?>
                        <?php endif; ?>

                    <h3>
                        <a href="<?= BASE_URL ?>/posts/show/<?= $post['id'] ?>">
                            <?= htmlspecialchars($post['title']) ?>
                        </a>
                    </h3>
                    
                    <p class="meta">
                        Por <?= htmlspecialchars($post['username']) ?> em <?= date('d/m/Y', strtotime($post['created_at'])) ?>
                    </p>
                    
                    <p>
                        <?= substr(htmlspecialchars($post['content']), 0, 120) ?>...
                    </p>
                    
                    <a href="<?= BASE_URL ?>/posts/show/<?= $post['id'] ?>" class="btn">Ler mais</a>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center;">Nenhum post encontrado.</p>
        <?php endif; ?>
    </div>

</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>