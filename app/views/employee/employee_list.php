<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Quản Lý Nhân Viên - Danh Sách</title>
    <style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #3498db;
        --success-color: #2ecc71;
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
        padding: 10px;
        padding-top: 60px;
        color: var(--text-color);
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 10px;
    }

    h2 {
        color: var(--primary-color);
        margin-bottom: 15px;
        position: relative;
        font-size: 1.5rem;
    }

    h2::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 30px;
        height: 3px;
        background: var(--secondary-color);
    }

    .modern-table {
        background: var(--card-bg);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        overflow-x: auto;
        margin: 10px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 100%; /* Đổi từ 600px thành 100% để phù hợp với màn hình */
    }

    th {
        background: var(--primary-color);
        color: white;
        padding: 8px;
        text-transform: uppercase;
        font-size: 0.75rem; /* Giảm kích thước chữ trên tiêu đề */
        letter-spacing: 1px;
        font-weight: 600;
        text-align: center;
        white-space: nowrap;
    }

    td {
        padding: 8px;
        border-bottom: 1px solid #eee;
        text-align: center;
        font-size: 0.85rem; /* Giảm kích thước chữ trên dữ liệu */
        white-space: nowrap;
    }

    .gender-icon {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        object-fit: cover;
    }

    .action-btn {
    padding: 4px; /* Giảm padding để vừa với icon */
    border-radius: 4px;
    text-decoration: none;
    margin-right: 4px;
    color: white;
    font-size: 0.9rem; /* Tăng kích thước icon nếu cần */
    display: inline-block;
    width: 28px; /* Đặt chiều rộng cố định cho icon */
    height: 28px; /* Đặt chiều cao cố định cho icon */
    text-align: center; /* Căn giữa icon */
    line-height: 20px; /* Căn giữa theo chiều dọc */
}

    .edit-btn {
        background: var(--secondary-color);
    }

    .delete-btn {
        background: var(--danger-color);
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin: 15px 0;
        flex-wrap: wrap;
    }

    .pagination a {
        padding: 6px 12px;
        border-radius: 25px;
        text-decoration: none;
        background: var(--card-bg);
        color: var(--primary-color);
        font-size: 0.8rem;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .pagination a:hover, .pagination a:focus {
        background-color: #3498db;
        color: white;
    }

    .pagination a.active {
        background-color: #2ecc71;
        color: white;
        transform: scale(1.1);
    }

    .header {
        background: var(--primary-color);
        color: white;
        padding: 10px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
    }

    .header a {
        color: white;
        text-decoration: none;
        margin: 0 8px;
        font-size: 0.8rem;
        white-space: nowrap;
    }

    .header .nav-right {
        display: flex;
        align-items: center;
    }

    .header .user-info {
        margin-right: 8px;
        font-size: 0.8rem;
        white-space: nowrap;
    }

    /* Các truy vấn phương tiện */
    @media (max-width: 767px) { /* Cho điện thoại */
        .header {
            flex-direction: column;
            align-items: flex-start;
            padding: 8px 10px; /* Giảm padding */
        }

        .header .nav-left, .header .nav-right {
            width: 100%;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .header .nav-left a {
            margin: 5px 0;
            font-size: 0.75rem; /* Giảm kích thước chữ */
        }

        .header .nav-right {
            justify-content: flex-end;
        }

        .header .user-info {
            margin-right: auto;
            font-size: 0.75rem; /* Giảm kích thước chữ */
        }

        table, thead, tbody, th, td, tr {
            display: block;
        }

        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        td {
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding: 8px 8px 8px 40%; /* Giảm padding-left để hiển thị đầy đủ nội dung */
            text-align: left;
            white-space: normal; /* Cho phép xuống dòng */
            font-size: 0.8rem; /* Giảm kích thước chữ */
        }

        td:before {
            position: absolute;
            top: 6px;
            left: 6px;
            width: 35%; /* Giảm chiều rộng để tránh tràn */
            padding-right: 5px;
            white-space: nowrap;
            font-weight: bold;
            font-size: 0.8rem;
        }

        /* Nhãn dữ liệu */
        td:nth-of-type(1):before { content: "Mã NV"; }
        td:nth-of-type(2):before { content: "Tên NV"; }
        td:nth-of-type(3):before { content: "Giới Tính"; }
        td:nth-of-type(4):before { content: "Nơi Sinh"; }
        td:nth-of-type(5):before { content: "Tên Phòng"; }
        td:nth-of-type(6):before { content: "Lương"; }
        td:nth-of-type(7):before { content: "Hành Động"; }

        .gender-icon {
            position: absolute;
            right: 8px;
            top: 5px;
            width: 20px; /* Giảm kích thước ảnh */
            height: 20px;
        }

        .action-btn {
            display: block;
            margin: 5px 0;
            text-align: center;
            font-size: 0.7rem; /* Giảm kích thước chữ */
        }

        td:nth-of-type(7) {
            padding-top: 30px;
        }

        td:nth-of-type(7):before {
            content: "";
            display: none;
        }

        td:nth-of-type(3) {
            padding-top: 30px;
        }

        .gender-icon {
            position: relative;
            right: auto;
            top: auto;
            margin-left: 10px;
        }
    }

    @media (min-width: 768px) { /* Cho máy tính bảng và desktop */
        .header {
            flex-direction: row;
            align-items: center;
        }
        .header .nav-left, .header .nav-right {
            width: auto;
            margin-bottom: 0;
        }
    }
</style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        ?>
        <div class="header">
            <div class="nav-left">
                <a href="index.php?controller=employee&action=index">Danh Sách NV</a>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
                    <a href="index.php?controller=employee&action=add">Thêm NV</a>
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

        <!-- Content -->
        <h2>THÔNG TIN NHÂN VIÊN</h2>
        <div class="modern-table">
            <table>
                <thead>
                    <tr>
                        <th>Mã Nhân Viên</th>
                        <th>Tên Nhân Viên</th>
                        <th>Giới Tính</th>
                        <th>Nơi Sinh</th>
                        <th>Tên Phòng</th>
                        <th>Lương</th>
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
                            <th>Hành Động</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($employee['Ma_NV']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Ten_NV']); ?></td>
                        <td>
                            <img class="gender-icon"
                                 src="public/images/<?php echo $employee['Phai'] == 'NU' ? 'woman.jpg' : 'man.jpg'; ?>"
                                 alt="<?php echo $employee['Phai'] == 'NU' ? 'Nữ' : 'Nam'; ?>">
                        </td>
                        <td><?php echo htmlspecialchars($employee['Noi_Sinh']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Ten_Phong']); ?></td>
                        <td><?php echo number_format($employee['Luong'], 0, ',', '.'); ?> VNĐ</td>
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
                            <td>
                            <a href="index.php?controller=employee&action=edit&ma_nv=<?php echo $employee['Ma_NV']; ?>"
                                class="action-btn edit-btn">&#9998;</a> <!-- Biểu tượng bút chì -->
                            <a href="index.php?controller=employee&action=delete&ma_nv=<?php echo $employee['Ma_NV']; ?>"
                                class="action-btn delete-btn"
                                onclick="return confirm('Bạn có chắc muốn xóa?')">&#128465;</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="index.php?controller=employee&action=index&page=<?php echo $i; ?>"
                   class="<?php echo $i == $page ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    </div>
</body>
</html>