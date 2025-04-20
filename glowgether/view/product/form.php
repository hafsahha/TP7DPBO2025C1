<?php
if (!isset($product)) {
    require_once 'class/Product.php';
    require_once 'class/Category.php';
    $product = new Product();
    $category = new Category();
}

$isEdit = isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id']);
$data = $isEdit ? $product->getById($_GET['id']) : [
    'name' => '',
    'brand' => '',
    'price' => '',
    'description' => '',
    'image_url' => '',
    'category_id' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    $category_id = $_POST['category_id'];

    if ($isEdit) {
        $product->update($_GET['id'], $name, $brand, $price, $description, $image_url, $category_id);
    } else {
        $product->create($name, $brand, $price, $description, $image_url, $category_id);
    }

    echo "<script>window.location.href = '?page=products';</script>";
    exit;
}
?>

<h2><?= $isEdit ? 'Edit Product' : 'Add New Product' ?></h2>

<form method="POST">
    <table>
        <tr>
            <td>Product Name</td>
            <td><input type="text" name="name" required value="<?= $data['name'] ?>"></td>
        </tr>
        <tr>
            <td>Brand</td>
            <td><input type="text" name="brand" required value="<?= $data['brand'] ?>"></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type="number" name="price" required value="<?= $data['price'] ?>"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name="description"><?= $data['description'] ?></textarea></td>
        </tr>
        <tr>
            <td>Image URL</td>
            <td><input type="text" name="image_url" value="<?= $data['image_url'] ?>"></td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <select name="category_id" required>
                    <option value="">-- Select --</option>
                    <?php foreach ($category->getAll() as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $data['category_id'] ? 'selected' : '' ?>>
                            <?= $cat['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit"><?= $isEdit ? 'Update' : 'Add' ?> Product</button>
            </td>
        </tr>
    </table>
</form>
