<?php
ob_start();
?>
<h1>Đăng ký học phần</h1>
<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<form method="POST" action="index.php?controller=hocphan&action=register">
    <div class="mb-3">
        <label for="MaSV" class="form-label">Mã Sinh Viên</label>
        <input type="text" class="form-control" id="MaSV" name="MaSV" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Chọn Học Phần</label>
        <?php while ($row = $hocPhans->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="MaHP[]" 
                       value="<?php echo htmlspecialchars($row['MaHP']); ?>" 
                       id="hp_<?php echo htmlspecialchars($row['MaHP']); ?>">
                <label class="form-check-label" for="hp_<?php echo htmlspecialchars($row['MaHP']); ?>">
                    <?php echo htmlspecialchars($row['TenHP']) . " (" . $row['SoTinChi'] . " tín chỉ)"; ?>
                </label>
            </div>
        <?php endwhile; ?>
    </div>
    <button type="submit" class="btn btn-primary">Đăng ký</button>
    <a href="index.php?controller=hocphan&action=index" class="btn btn-secondary">Hủy</a>
</form>
<?php
$content = ob_get_clean();
include 'app/views/layout.php';
?>