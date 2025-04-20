<h2>Product List</h2>

<!-- Tombol Tambah -->
<div style="text-align: right; margin: 10px 0;">
    <a href="?page=products&action=add" class="btn-add">+ Add Product</a>
</div>


<!-- Form Search -->
<form method="GET" class="search-bar">
    <input type="hidden" name="page" value="products">
    <input type="text" name="search" class="input" placeholder="Search product..." value="<?= $_GET['search'] ?? '' ?>">
    <button type="submit" class="btn-black">Search</button>
</form>

<!-- Tabel Produk -->
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Category</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $keyword = $_GET['search'] ?? '';
        $products = $keyword ? $product->searchByName($keyword) : $product->getAllWithCategory();
        $i = 1;
        foreach ($products as $p):
        ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $p['name'] ?></td>
            <td><?= $p['brand'] ?></td>
            <td><?= $p['category_name'] ?></td>
            <td>Rp <?= number_format($p['price'], 0, ',', '.') ?></td>
            <td><?= $p['description'] ?></td>
            <td><img src="<?= $p['image_url'] ?>" width="60"></td>
            <td>
                <a href="?page=products&action=edit&id=<?= $p['id'] ?>">Edit</a> |
                <a href="?page=products&action=delete&id=<?= $p['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
