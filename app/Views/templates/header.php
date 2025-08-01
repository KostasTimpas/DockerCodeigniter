<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?> - Articles & Categories</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
            --danger-color: #e74c3c;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            background-color: var(--dark-color);
            color: #fff;
            padding: 20px 0;
            margin-bottom: 30px;
        }
        
        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        header h1 {
            font-size: 24px;
            font-weight: 500;
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 20px;
        }
        
        nav ul li a {
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        nav ul li a:hover {
            color: var(--secondary-color);
        }
        
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            background: #2980b9;
        }
        
        .btn-secondary {
            background: var(--secondary-color);
        }
        
        .btn-secondary:hover {
            background: #27ae60;
        }
        
        .btn-danger {
            background: var(--danger-color);
        }
        
        .btn-danger:hover {
            background: #c0392b;
        }
        
        .card {
            background: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .card-body {
            margin-bottom: 20px;
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            color: #fff;
        }
        
        .alert-success {
            background-color: var(--secondary-color);
        }
        
        .alert-danger {
            background-color: var(--danger-color);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 16px;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        
        .error {
            color: var(--danger-color);
            font-size: 14px;
            margin-top: 5px;
        }
        
        .categories-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        
        .category-badge {
            background-color: var(--primary-color);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
        }
        
        .featured-image {
            width: 100%;
            height: auto;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            max-height: 400px;
            object-fit: cover;
        }
        
        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }
        
        .checkbox-item {
            display: flex;
            align-items: center;
        }
        
        .checkbox-item input {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Articles & Categories</h1>
            <nav>
                <ul>
                    <li><a href="<?= site_url('/') ?>">Home</a></li>
                    <li><a href="<?= site_url('articles') ?>">Articles</a></li>
                    <li><a href="<?= site_url('categories') ?>">Categories</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="container">
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>
