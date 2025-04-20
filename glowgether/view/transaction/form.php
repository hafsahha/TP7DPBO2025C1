<?php
if (!isset($transaction)) {
    require_once 'class/Transaction.php';
    require_once 'class/Product.php';
    $transaction = new Transaction();
    $product = new Product();
}

$isEdit = isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id']);
$data = $isEdit ? $transaction->getById($_GET['id']) : [
    'product_id' => '', 'buyer_name' => '', 'qty' => '', 'date' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $buyer_name = $_POST['buyer_name'];
    $qty = $_POST['qty'];
    $date = $_POST['date'];

    if ($isEdit) {
        $transaction->update($_GET['id'], $product_id, $buyer_name, $qty, $date);
    } else {
        $transaction->create($product_id, $buyer_name, $qty, $date);
    }

    echo "<script>window.location.href='?page=transactions';</script>";
    exit;
}
?>

<h2><?= $isEdit ? 'Edit Transaction' : 'Add New Transaction' ?></h2>

<form method="POST">
    <table>
        <tr>
            <td>Product</td>
            <td>
                <select name="product_id" required>
                    <option value="">-- Select Product --</option>
                    <?php foreach ($product->getAllWithCategory() as $p): ?>
                        <option value="<?= $p['id'] ?>" <?= $p['id'] == $data['product_id'] ? 'selected' : '' ?>>
                            <?= $p['name'] ?> (<?= $p['brand'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Buyer Name</td>
            <td><input type="text" name="buyer_name" required value="<?= $data['buyer_name'] ?>"></td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td><input type="number" name="qty" required value="<?= $data['qty'] ?>"></td>
        </tr>
        <tr>
            <td>Date</td>
            <td><input type="date" name="date" required value="<?= $data['date'] ?>"></td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit"><?= $isEdit ? 'Update' : 'Add' ?> Transaction</button></td>
        </tr>
    </table>
</form>
