<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; padding: 20px; max-width: 800px; margin: auto; }
        .product-card { border: 1px solid #ccc; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .source { font-style: italic; color: #888; margin-top: 10px; }
    </style>
</head>
<body>

<h1>Product Details</h1>

<div class="product-card">
    <h2><?= esc($product['name']) ?></h2>
    <p><strong>ID:</strong> <?= esc($product['id']) ?></p>
    <p><strong>Price:</strong> $<?= number_format($product['price'], 2) ?></p>
    <p><strong>Description:</strong> <?= esc($product['description']) ?></p>
    <p class="source">Data source: <?= esc($source) ?></p>
</div>

</body>
</html>