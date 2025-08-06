<div class="card">
    <div class="card-header">
        <h2>Create New Category</h2>
    </div>
    
    <div class="card-body">
        <?= form_open('categories/store') ?>
        <?= csrf_field() ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?= set_value('name') ?>">
                <?php if (isset($validation) && $validation->hasError('name')) : ?>
                    <div class="error"><?= $validation->getError('name') ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="5"><?= set_value('description') ?></textarea>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn">Create Category</button>
                <a href="<?= site_url('categories') ?>" class="btn btn-secondary">Cancel</a>
            </div>
        <?= form_close() ?>
    </div>
</div>
