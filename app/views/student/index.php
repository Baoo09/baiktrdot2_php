<?php
ob_start();
?>
<h1>Danh sách sinh viên</h1>
<a href="index.php?controller=student&action=create" class="btn btn-primary mb-3">Thêm mới</a>

<table class="table">
    <thead>
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Giới Tính</th>
            <th>Ngày Sinh</th>
            <th>Tên Ngành</th>
            <th>Hình Ảnh</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $students->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['MaSV']); ?></td>
            <td><?php echo htmlspecialchars($row['HoTen']); ?></td>
            <td><?php echo htmlspecialchars($row['GioiTinh']); ?></td>
            <td><?php echo htmlspecialchars($row['NgaySinh']); ?></td>
            <td><?php echo htmlspecialchars($row['TenNganh']); ?></td>
            <td>
                <?php if (!empty($row['Hinh']) && file_exists($_SERVER['DOCUMENT_ROOT'] . $row['Hinh'])): ?>
                    <img src="<?php echo htmlspecialchars($row['Hinh']); ?>" alt="Ảnh sinh viên" style="max-width: 100px; max-height: 100px;">
                <?php else: ?>
                    <span>Chưa có ảnh</span>
                <?php endif; ?>
            </td>
            <td>
                <a href="index.php?controller=student&action=detail&id=<?php echo urlencode($row['MaSV']); ?>" class="btn btn-info">Chi tiết</a>
                <a href="index.php?controller=student&action=edit&id=<?php echo urlencode($row['MaSV']); ?>" class="btn btn-warning">Sửa</a>
                <a href="index.php?controller=student&action=delete&id=<?php echo urlencode($row['MaSV']); ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Phân trang -->
<div class="pagination mt-3">
    <?php if ($page > 1): ?>
        <a href="index.php?controller=student&action=index&page=<?php echo $page - 1; ?>" class="btn btn-secondary">Trang trước</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="index.php?controller=student&action=index&page=<?php echo $i; ?>" 
           class="btn btn-<?php echo $i === $page ? 'primary' : 'light'; ?> mx-1">
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="index.php?controller=student&action=index&page=<?php echo $page + 1; ?>" class="btn btn-secondary">Trang sau</a>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>