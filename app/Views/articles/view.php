<div class="card">
    <div class="card-header">
        <h2><?= esc($article['title']) ?></h2>
        <div>
            <a href="<?= site_url('articles/edit/' . $article['id']) ?>" class="btn btn-secondary">Edit</a>
            <a href="<?= site_url('articles/delete/' . $article['id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
        </div>
    </div>
    
    <div class="card-body">
        <?php if (!empty($article['featured_image'])) : ?>
            <img src="<?= base_url($article['featured_image']) ?>" alt="<?= esc($article['title']) ?>" class="featured-image">
        <?php endif; ?>
        
        <div style="margin-bottom: 20px;">
            <p>Posted on: <?= date('F j, Y', strtotime($article['created_at'])) ?></p>
            
            <?php if (!empty($article['categories'])) : ?>
                <div class="categories-list">
                    <?php foreach ($article['categories'] as $category) : ?>
                        <a href="<?= site_url('categories/' . $category['id']) ?>" class="category-badge">
                            <?= esc($category['name']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div>
            <?= $article['content'] ?>
        </div>
    </div>
</div>

<div style="margin-top: 20px">
    <a href="<?= site_url('articles') ?>" class="btn">Back to Articles</a>
</div>
