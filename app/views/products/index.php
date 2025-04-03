<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f4f9;
            min-height: 100vh;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 15px;
        }
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        h1 {
            color: #1a1a1a;
            font-size: 2rem;
            font-weight: 600;
            margin: 0;
        }
        .search-bar {
            max-width: 300px;
        }
        .search-bar input {
            border-radius: 20px;
            padding: 8px 15px;
            border: 1px solid #ddd;
        }
        .btn-primary {
            background: #007bff;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #0056b3;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .product-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 15px;
            transition: all 0.3s ease;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        .product-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .product-name {
            font-weight: 500;
            color: #2c3e50;
            font-size: 1.1rem;
            margin-bottom: 10px;
            height: 2.4em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .price {
            color: #e74c3c;
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        .description {
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 15px;
            height: 3em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .btn-action {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            width: 80px;
        }
        .btn-warning {
            background: #f39c12;
            border: none;
        }
        .btn-warning:hover {
            background: #e67e22;
        }
        .btn-danger {
            background: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-section">
            <h1>Danh sách sản phẩm</h1>
            <div class="d-flex gap-3">
                <div class="search-bar">
                    <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                </div>
                <a href="?controller=product&action=add" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Thêm sản phẩm
                </a>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
            <div class="product-card">
                <a href="?controller=product&action=show&id=<?= $product['id'] ?>" class="text-decoration-none">
                    <img src="/php_MVC/<?= $product['image'] ?? 'https://via.placeholder.com/250x180' ?>" 
                        class="product-image" 
                        alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="product-name"><?= htmlspecialchars($product['name']) ?></div>
                    <div class="price"><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</div>
                    <div class="description">
                        <?= htmlspecialchars($product['description']) ?><br>
                        <small>Danh mục: <?= htmlspecialchars($product['category_name'] ?? 'Chưa có') ?></small>
                    </div>
                </a>
                <div class="action-buttons">
                    <a href="?controller=product&action=edit&id=<?= $product['id'] ?>" class="btn btn-warning btn-action">
                        <i class="fas fa-edit"></i> Sửa
                    </a>
                    <a href="?controller=product&action=delete&id=<?= $product['id'] ?>" class="btn btn-danger btn-action" 
                       onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                        <i class="fas fa-trash"></i> Xóa
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>