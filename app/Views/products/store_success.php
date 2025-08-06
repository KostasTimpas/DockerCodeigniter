<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Success</title>
</head>
<body>
<h1><?= esc($message) ?></h1>
<p>You can now view the product: <a href="/products/show/<?= esc($product_id) ?>">View Product</a></p>
</body>
</html>