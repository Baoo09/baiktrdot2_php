<?php
ob_start();
?>
<h1>Chi Tiết Sinh Viên</h1>
<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($student['HoTen']); ?></h5>
        <p class="card-text"><strong>Mã Sinh Viên:</strong> <?php echo htmlspecialchars($student['MaSV']); ?></p>
        <p class="card-text"><strong>Giới Tính:</strong> <?php echo htmlspecialchars($student['GioiTinh']); ?></p>
        <p class="card-text"><strong>Ngày Sinh:</strong> <?php echo htmlspecialchars($student['NgaySinh']); ?></p>
        <p class="card-text"><strong>Ngành Học:</strong> <?php echo htmlspecialchars($student['TenNganh']); ?></p>
        <?php if ($student['Hinh']): ?>
            <p class="card-text"><strong>Hình Ảnh:</strong></p>
            <img src="<?php echo htmlspecialchars($student['Hinh']); ?>" alt="Hình ảnh sinh viên" style="max-width: 300px;">
        <?php endif; ?>
    </div>
</div>
<a href="index.php?controller=student&action=index" class="btn btn-primary mt-3">Quay lại</a>
<a href="index.php?controller=student&action=edit&id=<?php echo urlencode($student['MaSV']); ?>" class="btn btn-warning mt-3">Sửa</a>
<a href="index.php?controller=student&action=delete&id=<?php echo urlencode($student['MaSV']); ?>" class="btn btn-danger mt-3" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>