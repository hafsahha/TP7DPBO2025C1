<?php
require_once 'class/Product.php';
require_once 'class/Category.php';
require_once 'class/Transaction.php';

$product = new Product();
$category = new Category();
$transaction = new Transaction();

// Routing CRUD produk
if (isset($_GET['page']) && $_GET['page'] == 'products' && isset($_GET['action'])) {
    if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
        $product->delete($_GET['id']);
        echo "<script>window.location.href='?page=products';</script>";
        exit;
    } elseif ($_GET['action'] == 'add' || $_GET['action'] == 'edit') {
        $customPage = 'view/product/form.php';
    }
}

// Routing CRUD kategori
if (isset($_GET['page']) && $_GET['page'] == 'categories' && isset($_GET['action'])) {
    if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
        $category->delete($_GET['id']);
        echo "<script>window.location.href = '?page=categories';</script>";
        exit;
    }
    if ($_GET['action'] == 'add' || $_GET['action'] == 'edit') {
        $customPage = 'view/category/form.php';
    }
}

// Routing CRUD transaksi
if (isset($_GET['page']) && $_GET['page'] == 'transactions' && isset($_GET['action'])) {
    if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
        $transaction->delete($_GET['id']);
        echo "<script>window.location.href = '?page=transactions';</script>";
        exit;
    }
    if ($_GET['action'] == 'add' || $_GET['action'] == 'edit') {
        $customPage = 'view/transaction/form.php';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Glowgether</title>
    <link rel="stylesheet" href="assets/style.css">

</head>
<body>

<?php include 'view/header.php'; ?>

<nav>
    <a href="?page=products">Products</a> |
    <a href="?page=categories">Categories</a> |
    <a href="?page=transactions">Transactions</a>
</nav>

<hr>

<main>
<?php
if (isset($customPage)) {
    include $customPage;
} elseif (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page == 'products') {
        include 'view/product/index.php';
    } elseif ($page == 'categories') {
        include 'view/category/index.php';
    } elseif ($page == 'transactions') {
        include 'view/transaction/index.php';
    } else {
        echo "<p>Page not found.</p>";
    }
} else {
    echo "<p>Welcome to Glowgether. Select a menu above.</p>";
}
?>
</main>

<?php include 'view/footer.php'; ?>

</body>
</html>
