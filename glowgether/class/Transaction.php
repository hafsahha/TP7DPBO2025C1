<?php
require_once 'config/db.php';

class Transaction {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllWithProduct() {
        $stmt = $this->db->query("SELECT transaction.*, product.name AS product_name FROM transaction JOIN product ON transaction.product_id = product.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM transaction WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($product_id, $buyer_name, $qty, $date) {
        $stmt = $this->db->prepare("INSERT INTO transaction (product_id, buyer_name, qty, date) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$product_id, $buyer_name, $qty, $date]);
    }

    public function update($id, $product_id, $buyer_name, $qty, $date) {
        $stmt = $this->db->prepare("UPDATE transaction SET product_id = ?, buyer_name = ?, qty = ?, date = ? WHERE id = ?");
        return $stmt->execute([$product_id, $buyer_name, $qty, $date, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM transaction WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
