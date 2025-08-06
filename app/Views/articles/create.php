<div class="card">
    <div class="card-header">
        <h2>Create New Article</h2>
    </div>
    
    <div class="card-body">
        <?= form_open_multipart('articles/store') ?>
        <?= csrf_field() ?>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="<?= set_value('title') ?>">
                <?php if (isset($validation) && $validation->hasError('title')) : ?>
                    <div class="error"><?= $validation->getError('title') ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" name="content" id="content" rows="10"><?= set_value('content') ?></textarea>
                <?php if (isset($validation) && $validation->hasError('content')) : ?>
                    <div class="error"><?= $validation->getError('content') ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" class="form-control" name="featured_image" id="featured_image">
            </div>
            
            <div class="form-group">
                <label>Categories</label>
                <div class="checkbox-group">
                    <?php foreach ($categories as $category) : ?>
                        <div class="checkbox-item">
                            <input type="checkbox" name="categories[]" value="<?= $category['id'] ?>" id="category-<?= $category['id'] ?>">
                            <label for="category-<?= $category['id'] ?>"><?= esc($category['name']) ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn">Create Article</button>
                <a href="<?= site_url('articles') ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
