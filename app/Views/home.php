<div class="card" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white; text-align: center; padding: 40px 20px; margin-bottom: 40px;">
    <h1 style="font-size: 2.5rem; margin-bottom: 20px;">Welcome to Articles & Categories</h1>
    <p style="font-size: 1.2rem; max-width: 700px; margin: 0 auto;">A simple platform to manage articles with categories. Create, read, update, and delete articles and categories with ease.</p>
    <div style="margin-top: 30px;">
        <a href="<?= site_url('articles') ?>" class="btn" style="background: white; color: var(--primary-color); margin-right: 10px;">Browse Articles</a>
        <a href="<?= site_url('categories') ?>" class="btn" style="background: white; color: var(--primary-color);">Browse Categories</a>
    </div>
</div>


<div class="card">
    <div class="card-header">
        <h2>Latest Articles</h2>
        <a href="<?= site_url('articles') ?>" class="btn">View All Articles</a>
    </div>
    
    <?php if (empty($articles)) : ?>
        <div class="card-body">
            <p>No articles found. Create a new one!</p>
            <a href="<?= site_url('articles/create') ?>" class="btn">Create New Article</a>
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
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<div class="card" style="margin-top: 40px;">
    <div class="card-header">
        <h2>Categories</h2>
        <a href="<?= site_url('categories') ?>" class="btn">View All Categories</a>
    </div>
    
    <?php if (empty($categories)) : ?>
        <div class="card-body">
            <p>No categories found. Create a new one!</p>
            <a href="<?= site_url('categories/create') ?>" class="btn">Create New Category</a>
        </div>
    <?php else : ?>
        <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-top: 20px;">
            <?php foreach ($categories as $category) : ?>
                <a href="<?= site_url('categories/' . $category['id']) ?>" class="category-badge" style="font-size: 16px; padding: 8px 15px;">
                    <?= esc($category['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
