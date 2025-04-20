<h2>Category List</h2>

<!-- Tombol Tambah -->
<div style="text-align: right; margin: 10px 0;">
    <a href="?page=categories&action=add" class="btn-add">+ Add Category</a>
</div>

<!-- Tabel Kategori -->
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr><th>No</th><th>Name</th><th>Action</th></tr>
    </thead>
    <tbody>
        <?php
        $categories = $category->getAll();
        $i = 1;
        foreach ($categories as $c):
        ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $c['name'] ?></td>
            <td>
                <a href="?page=categories&action=edit&id=<?= $c['id'] ?>">Edit</a> |
                <a href="?page=categories&action=delete&id=<?= $c['id'] ?>" onclick="return confirm('Delete this category?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
