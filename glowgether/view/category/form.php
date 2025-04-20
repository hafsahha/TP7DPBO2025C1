<?php
if (!isset($category)) {
    require_once 'class/Category.php';
    $category = new Category();
}

$isEdit = isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id']);
$data = $isEdit ? $category->getById($_GET['id']) : ['name' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    if ($isEdit) {
        $category->update($_GET['id'], $name);
    } else {
        $category->create($name);
    }

    echo "<script>window.location.href='?page=categories';</script>";
    exit;
}
?>

<h2><?= $isEdit ? 'Edit Category' : 'Add New Category' ?></h2>

<form method="POST">
    <table>
        <tr>
            <td>Category Name</td>
            <td><input type="text" name="name" required value="<?= $data['name'] ?>"></td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit"><?= $isEdit ? 'Update' : 'Add' ?> Category</button></td>
        </tr>
    </table>
</form>
