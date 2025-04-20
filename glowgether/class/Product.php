<?php
require_once 'config/db.php';

class Product {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllWithCategory() {
        $stmt = $this->db->query("SELECT product.*, category.name AS category_name FROM product JOIN category ON product.category_id = category.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM product WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $brand, $price, $description, $image_url, $category_id) {
        $stmt = $this->db->prepare("INSERT INTO product (name, brand, price, description, image_url, category_id) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $brand, $price, $description, $image_url, $category_id]);
    }

    public function update($id, $name, $brand, $price, $description, $image_url, $category_id) {
        $stmt = $this->db->prepare("UPDATE product SET name = ?, brand = ?, price = ?, description = ?, image_url = ?, category_id = ? WHERE id = ?");
        return $stmt->execute([$name, $brand, $price, $description, $image_url, $category_id, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM product WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function searchByName($keyword) {
        $stmt = $this->db->prepare("
            SELECT product.*, category.name AS category_name
            FROM product
            JOIN category ON product.category_id = category.id
            WHERE product.name LIKE ?
        ");
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }   
}
?>
