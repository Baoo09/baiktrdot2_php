<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa danh mục</title>
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
            max-width: 600px;
            margin: 2rem auto;
            padding: 0 15px;
        }
        .form-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }
        h1 {
            color: #1a1a1a;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .btn-primary {
            background: #007bff;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
        }
        .btn-primary:hover {
            background: #0056b3;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
        }
        .form-control {
            border-radius: 8px;
            margin-bottom: 15px;
        }
        label {
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h1>Chỉnh sửa danh mục</h1>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST" action="?controller=category&action=edit&id=<?= $category['id'] ?>">
                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                <div>
                    <label for="name">Tên danh mục:</label>
                    <input type="text" id="name" name="name" class="form-control" 
                           value="<?= htmlspecialchars($category['name']) ?>" required>
                </div>
                <div>
                    <label for="description">Mô tả:</label>
                    <textarea id="description" name="description" class="form-control" rows="4"><?= htmlspecialchars($category['description'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Cập nhật danh mục
                </button>
            </form>
            <a href="?controller=category&action=index" class="btn btn-link mt-3 d-block text-center">Quay lại</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>