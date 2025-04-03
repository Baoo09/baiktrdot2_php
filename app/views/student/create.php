<?php
ob_start();
?>
<h1>Thêm Sinh Viên Mới</h1>
<form method="POST" action="index.php?controller=student&action=create" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="MaSV" class="form-label">Mã Sinh Viên</label>
        <input type="text" class="form-control" id="MaSV" name="MaSV" required>
    </div>
    <div class="mb-3">
        <label for="HoTen" class="form-label">Họ Tên</label>
        <input type="text" class="form-control" id="HoTen" name="HoTen" required>
    </div>
    <div class="mb-3">
        <label for="GioiTinh" class="form-label">Giới Tính</label>
        <select class="form-select" id="GioiTinh" name="GioiTinh" required>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="NgaySinh" class="form-label">Ngày Sinh</label>
        <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" required>
    </div>
    <div class="mb-3">
        <label for="Hinh" class="form-label">Hình Ảnh</label>
        <input type="file" class="form-control" id="Hinh" name="Hinh">
    </div>
    <div class="mb-3">
        <label for="MaNganh" class="form-label">Ngành Học</label>
        <select class="form-select" id="MaNganh" name="MaNganh" required>
            <option value="CNTT">Công nghệ thông tin</option>
            <option value="QTKD">Quản trị kinh doanh</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
    <a href="index.php?controller=student&action=index" class="btn btn-secondary">Hủy</a>
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>