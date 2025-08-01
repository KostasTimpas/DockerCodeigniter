<div class="card">
    <div class="card-header">
        <h2>All Articles</h2>
        <a href="<?= site_url('articles/create') ?>" class="btn">Create New Article</a>
    </div>
    
    <?php if (empty($articles)) : ?>
        <div class="card-body">
            <p>No articles found. Create a new one!</p>
        </div>
    <?php else : ?>
        <div class="grid">
            <?php foreach ($articles as $article) : ?>
                <div class="card">
                    <?php if (!empty($article['featured_image'])) : ?>
                        <img src="<?= base_url($article['featured_image']) ?>" alt="<?= esc($article['title']) ?>" class="featured-image">
                    <?php endif; ?>
                    
                    <h3><?= esc($article['title']) ?></h3>
                    
                    <p><?= substr(strip_tags($article['content']), 0, 150) ?>...</p>
                    
                    <div style="margin-top: 15px">
                        <a href="<?= site_url('articles/' . $article['id']) ?>" class="btn">Read More</a>
                        <a href="<?= site_url('articles/edit/' . $article['id']) ?>" class="btn btn-secondary">Edit</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
