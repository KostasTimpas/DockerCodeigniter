<div class="card">
    <div class="card-header">
        <h2>Category: <?= esc($category['name']) ?></h2>
        <div>
            <a href="<?= site_url('categories/edit/' . $category['id']) ?>" class="btn btn-secondary">Edit</a>
            <a href="<?= site_url('categories/delete/' . $category['id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
        </div>
    </div>
    
    <div class="card-body">
        <?php if (!empty($category['description'])) : ?>
            <div style="margin-bottom: 30px;">
                <h3>Description</h3>
                <p><?= esc($category['description']) ?></p>
            </div>
        <?php endif; ?>
        
        <h3>Articles in this Category</h3>
        
        <?php if (empty($articles)) : ?>
            <p>No articles found in this category.</p>
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
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div style="margin-top: 20px">
    <a href="<?= site_url('categories') ?>" class="btn">Back to Categories</a>
</div>
