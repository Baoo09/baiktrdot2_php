<?php
ob_start();
?>
<h1>Sửa Thông Tin Sinh Viên</h1>
<form method="POST" action="index.php?controller=student&action=edit&id=<?php echo urlencode($student['MaSV']); ?>" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="MaSV" class="form-label">Mã Sinh Viên</label>
        <input type="text" class="form-control" id="MaSV" name="MaSV" value="<?php echo htmlspecialchars($student['MaSV']); ?>" readonly>
    </div>
    <div class="mb-3">
        <label for="HoTen" class="form-label">Họ Tên</label>
        <input type="text" class="form-control" id="HoTen" name="HoTen" value="<?php echo htmlspecialchars($student['HoTen']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="GioiTinh" class="form-label">Giới Tính</label>
        <select class="form-select" id="GioiTinh" name="GioiTinh" required>
            <option value="Nam" <?php echo $student['GioiTinh'] === 'Nam' ? 'selected' : ''; ?>>Nam</option>
            <option value="Nữ" <?php echo $student['GioiTinh'] === 'Nữ' ? 'selected' : ''; ?>>Nữ</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="NgaySinh" class="form-label">Ngày Sinh</label>
        <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" value="<?php echo htmlspecialchars($student['NgaySinh']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="Hinh" class="form-label">Hình Ảnh</label>
        <input type="file" class="form-control" id="Hinh" name="Hinh" accept="image/*">
        <?php if ($student['Hinh']): ?>
            <p class="mt-2">Ảnh hiện tại:</p>
            <img src="<?php echo htmlspecialchars($student['Hinh']); ?>" alt="Hình ảnh sinh viên" style="max-width: 200px;" class="mt-2">
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="MaNganh" class="form-label">Ngành Học</label>
        <select class="form-select" id="MaNganh" name="MaNganh" required>
            <option value="CNTT" <?php echo $student['MaNganh'] === 'CNTT' ? 'selected' : ''; ?>>Công nghệ thông tin</option>
            <option value="QTKD" <?php echo $student['MaNganh'] === 'QTKD' ? 'selected' : ''; ?>>Quản trị kinh doanh</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="index.php?controller=student&action=index" class="btn btn-secondary">Hủy</a>
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>