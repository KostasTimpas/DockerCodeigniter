<div class="card">
    <div class="card-header">
        <h2>All Categories</h2>
        <a href="<?= site_url('categories/create') ?>" class="btn">Create New Category</a>
    </div>
    
    <?php if (empty($categories)) : ?>
        <div class="card-body">
            <p>No categories found. Create a new one!</p>
        </div>
    <?php else : ?>
        <div class="grid">
            <?php foreach ($categories as $category) : ?>
                <div class="card">
                    <h3><?= esc($category['name']) ?></h3>
                    
                    <?php if (!empty($category['description'])) : ?>
                        <p><?= esc($category['description']) ?></p>
                    <?php else : ?>
                        <p><em>No description available</em></p>
                    <?php endif; ?>
                    
                    <div style="margin-top: 15px">
                        <a href="<?= site_url('categories/' . $category['id']) ?>" class="btn">View Articles</a>
                        <a href="<?= site_url('categories/edit/' . $category['id']) ?>" class="btn btn-secondary">Edit</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
