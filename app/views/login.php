<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Quản Lý sinh viên </title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text-color);
        }

        .login-container {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 400px;
            animation: scaleIn 0.5s ease-out;
        }

        h2 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            animation: slideIn 0.5s ease-out;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
            transition: width 0.3s ease;
        }

        h2:hover::after {
            width: 100px;
        }

        .form-group {
            margin-bottom: 20px;
            animation: fadeInUp 0.5s ease-out;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        input:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.2);
            background: white;
        }

        input::placeholder {
            color: #999;
        }

        button {
            background: var(--secondary-color);
            color: white;
            padding: 12px;
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
            text-align: center;
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
    <div class="login-container">
        <h2>Đăng Nhập</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="index.php?controller=auth&action=handleLogin" method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Tên đăng nhập" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Mật khẩu" required>
            </div>
            <button type="submit">Đăng Nhập</button>
        </form>
    </div>
</body>
</html>