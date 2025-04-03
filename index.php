<?php
try {
    // Require các file cần thiết
    require_once 'config/database.php';
    require_once 'app/models/Product.php';
    require_once 'app/models/EmployeeModel.php';
    require_once 'app/controllers/EmployeeController.php';

    // Kết nối database
    $db = new Database();
    $conn = $db->getConnection();

    // Lấy tham số từ GET
    $controllerName = isset($_GET['controller']) 
        ? ucfirst(strtolower($_GET['controller'])) . 'Controller' 
        : 'EmployeeController';
    $action = isset($_GET['action']) 
        ? strtolower($_GET['action']) 
        : 'index';
    $id = $_GET['id'] ?? null;

    // Kiểm tra và load controller
    $controllerPath = 'app/controllers/' . $controllerName . '.php';
    if (!file_exists($controllerPath)) {
        throw new Exception("Error 404: Controller '$controllerName' not found", 404);
    }
    require_once $controllerPath;

    // Kiểm tra class controller có tồn tại không
    if (!class_exists($controllerName)) {
        throw new Exception("Error 500: Controller class '$controllerName' not found", 500);
    }

    // Khởi tạo controller với kết nối database
    $controller = new $controllerName($conn);

    // Kiểm tra method có tồn tại không
    if (!method_exists($controller, $action)) {
        throw new Exception("Error 404: Action '$action' not found in '$controllerName'", 404);
    }

    // Gọi action
    if ($id !== null) {
        $controller->$action($id);
    } else {
        $controller->$action();
    }

} catch (Exception $e) {
    // Xử lý lỗi
    $errorCode = $e->getCode() ?: 500;
    http_response_code($errorCode);
    echo "<h1>Lỗi: " . $e->getMessage() . "</h1>";
    // Có thể thêm logging lỗi ở đây
    // error_log($e->getMessage());
}
?>