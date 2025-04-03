<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Nhân Viên - Sửa</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --danger-color: #e74c3c;
            --background: #f5f7fa;
            --card-bg: #ffffff;
            --text-color: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--background);
            padding: 20px;
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            animation: fadeIn 0.5s ease-in;
        }

        h2 {
            color: var(--primary-color);
            margin-bottom: 25px;
            position: relative;
            animation: slideIn 0.5s ease-out;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
            transition: width 0.3s ease;
        }

        h2:hover::after {
            width: 100px;
        }

        .form-container {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            margin: 20px 0;
            animation: scaleIn 0.5s ease-out;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-group {
            margin-bottom: 20px;
            animation: fadeInUp 0.5s ease-out;
        }

        label {
            display: block;
            color: var(--primary-color);
            margin-bottom: 6px;
            font-weight: 500;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.2);
            background: white;
        }

        input:disabled {
            background: #f0f0f0;
            color: #666;
        }

        button {
            background: var(--secondary-color);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        button:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }

        .error {
            color: var(--danger-color);
            margin-bottom: 15px;
            padding: 8px 12px;
            background: #fee;
            border-radius: 4px;
            font-size: 14px;
            animation: shake 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes scaleIn {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        @keyframes fadeInUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php require_once 'app/views/shares/header.php'; ?>
        <h2>SỬA NHÂN VIÊN</h2>
        <div class="form-container">
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="index.php?controller=employee&action=handleEdit" method="POST">
                <input type="hidden" name="ma_nv" value="<?php echo $employee['Ma_NV']; ?>">
                <div class="form-group">
                    <label>Mã Nhân Viên:</label>
                    <input type="text" value="<?php echo $employee['Ma_NV']; ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Tên Nhân Viên:</label>
                    <input type="text" name="ten_nv" value="<?php echo $employee['Ten_NV']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Giới Tính:</label>
                    <select name="phai" required>
                        <option value="NAM" <?php echo $employee['Phai'] == 'NAM' ? 'selected' : ''; ?>>Nam</option>
                        <option value="NU" <?php echo $employee['Phai'] == 'NU' ? 'selected' : ''; ?>>Nữ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nơi Sinh:</label>
                    <input type="text" name="noi_sinh" value="<?php echo $employee['Noi_Sinh']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Phòng Ban:</label>
                    <select name="ma_phong" required>
                        <?php foreach ($departments as $department): ?>
                            <option value="<?php echo $department['Ma_Phong']; ?>" 
                                    <?php echo $employee['Ma_Phong'] == $department['Ma_Phong'] ? 'selected' : ''; ?>>
                                <?php echo $department['Ten_Phong']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Lương:</label>
                    <input type="number" name="luong" value="<?php echo $employee['Luong']; ?>" required>
                </div>
                <button type="submit">Cập Nhật</button>
            </form>
        </div>
    </div>
</body>
</html>