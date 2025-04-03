<?php
class Database {
    private $host = "localhost";
    private $db_name = "php_mvc";
    private $username = "root";
    private $password = "";
    private $conn;

    public function getConnection() {
        $this->conn = null; // Khởi tạo $conn là null
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            // Thay vì die(), ném exception để xử lý ở tầng cao hơn
            throw new Exception("Lỗi kết nối cơ sở dữ liệu: " . $exception->getMessage());
        }
        return $this->conn;
    }
}
?>