<h2>Transaction List</h2>

<!-- Tombol Tambah -->
<div style="text-align: right; margin: 10px 0;">
  <a href="?page=transactions&action=add" class="btn-add">+ Add Transaction</a>
</div>

<!-- Tabel Transaksi -->
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr><th>No</th><th>Product</th><th>Buyer</th><th>Qty</th><th>Date</th><th>Action</th></tr>
    </thead>
    <tbody>
        <?php
        $transactions = $transaction->getAllWithProduct();
        $i = 1;
        foreach ($transactions as $t):
        ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $t['product_name'] ?></td>
            <td><?= $t['buyer_name'] ?></td>
            <td><?= $t['qty'] ?></td>
            <td><?= $t['date'] ?></td>
            <td>
                <a href="?page=transactions&action=edit&id=<?= $t['id'] ?>">Edit</a> |
                <a href="?page=transactions&action=delete&id=<?= $t['id'] ?>" onclick="return confirm('Delete this transaction?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
