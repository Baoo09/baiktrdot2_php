<?php
class Product {
    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllProducts() {
        $query = "SELECT p.*, c.name AS category_name 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN categories c ON p.category_id = c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $query = "SELECT p.*, c.name AS category_name 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addProduct($name, $price, $description, $image = null, $category_id = null) {
        $query = "INSERT INTO " . $this->table_name . " (name, price, description, image, category_id) 
                  VALUES (:name, :price, :description, :image, :category_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateProduct($id, $name, $price, $description, $image = null, $category_id = null) {
        $query = "UPDATE " . $this->table_name . " 
                  SET name = :name, price = :price, description = :description, image = :image, category_id = :category_id 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteProduct($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>