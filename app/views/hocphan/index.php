<?php
ob_start();
?>
<h1>Danh sách học phần</h1>
<a href="index.php?controller=hocphan&action=register" class="btn btn-primary mb-3">Đăng ký học phần</a>
<table class="table">
    <thead>
        <tr>
            <th>Mã HP</th>
            <th>Tên HP</th>
            <th>Số Tín Chỉ</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $hocPhans->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['MaHP']); ?></td>
            <td><?php echo htmlspecialchars($row['TenHP']); ?></td>
            <td><?php echo htmlspecialchars($row['SoTinChi']); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Phân trang -->
<div class="pagination mt-3">
    <?php if ($page > 1): ?>
        <a href="index.php?controller=hocphan&action=index&page=<?php echo $page - 1; ?>" class="btn btn-secondary">Trang trước</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="index.php?controller=hocphan&action=index&page=<?php echo $i; ?>" 
           class="btn btn-<?php echo $i === $page ? 'primary' : 'light'; ?> mx-1">
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="index.php?controller=hocphan&action=index&page=<?php echo $page + 1; ?>" class="btn btn-secondary">Trang sau</a>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>