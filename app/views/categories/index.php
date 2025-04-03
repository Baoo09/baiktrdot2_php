<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách danh mục</title>
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
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .category-card {
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
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        .category-name {
            font-weight: 500;
            color: #2c3e50;
            font-size: 1.2rem;
            margin-bottom: 10px;
            height: 2.4em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
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
            <h1>Danh sách danh mục</h1>
            <a href="?controller=category&action=add" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Thêm danh mục
            </a>
        </div>

        <div class="category-grid">
            <?php foreach ($categories as $category): ?>
            <div class="category-card">
                <div class="category-name"><?= htmlspecialchars($category['name']) ?></div>
                <div class="description"><?= htmlspecialchars($category['description'] ?? 'Không có mô tả') ?></div>
                <div class="action-buttons">
                    <a href="?controller=category&action=edit&id=<?= $category['id'] ?>" class="btn btn-warning btn-action">
                        <i class="fas fa-edit"></i> Sửa
                    </a>
                    <a href="?controller=category&action=delete&id=<?= $category['id'] ?>" class="btn btn-danger btn-action" 
                       onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
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