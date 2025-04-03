<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-details {
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin: 2rem 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 2rem;
        }
        img {
            border-radius: 8px;
            margin: 1rem 0;
        }
        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .btn-back:hover {
            background: #0056b3;
            color: white;
        }
        .price {
            font-size: 1.25rem;
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head></head>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Chi tiết sản phẩm</h1>
        <?php if ($product): ?>
            <div class="product-details">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p>Giá: <?php echo number_format($product['price'], 2); ?> VND</p>
                <p>Mô tả: <?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                <?php if ($product['image']): ?>
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="max-width: 300px;">
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>Sản phẩm không tồn tại!</p>
        <?php endif; ?>
        <a href="?controller=product&action=index">Quay lại danh sách sản phẩm</a>
    </div>
</body>
</html>