<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #2c3e50, #34495e);
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --background: #f5f7fa;
            --text-color: #ecf0f1;
            --shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        }

        .header {
            background: var(--primary-gradient);
            color: var(--text-color);
            padding: 1.2rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
            animation: slideDown 0.5s ease-out;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header a {
            color: inherit;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
        }

        .header a:hover {
            color: var(--secondary-color);
            transform: translateY(-2px);
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--secondary-color);
            transition: width 0.3s ease, left 0.3s ease;
        }

        .header a:hover::after {
            width: 100%;
            left: 0;
        }

        .user-info {
            margin-right: 1rem;
            font-weight: 500;
        }

        .brand-logo {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-color);
            text-transform: uppercase;
            letter-spacing: 1px;
            animation: pulse 2s infinite;
        }

        @keyframes slideDown {
            from { transform: translateY(-100%); }
            to { transform: translateY(0); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                padding: 1rem;
            }
            
            .nav-left, .nav-right {
                flex-direction: column;
                width: 100%;
                align-items: center;
            }
            
            .nav-left {
                margin-bottom: 1rem;
            }
            
            .header a {
                width: 100%;
                text-align: center;
                padding: 0.75rem;
            }
            
            .user-info {
                text-align: center;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="nav-left">
            <span class="brand-logo">KING</span>
            <a href="index.php?controller=student&action=index">Danh Sách Sinh Viên</a>
            
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
                <a href="index.php?controller=student&action=create">Thêm Sinh Viên</a>
            <?php endif; ?>
        </div>
        <div class="nav-right">
            <?php if (isset($_SESSION['user'])): ?>
                <span class="user-info">Xin chào, <?php echo htmlspecialchars($_SESSION['user']['fullname']); ?></span>
                <a href="index.php?controller=auth&action=logout">Đăng Xuất</a>
            <?php else: ?>
                <a href="index.php?controller=auth&action=login">Đăng Nhập</a>
                
            <?php endif; ?>
        </div>
    </div>
</body>
</html>