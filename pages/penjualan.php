<?php
include "../config/db.php";
$data = mysqli_query($conn, "
  SELECT penjualan.*, produk.nama_produk
  FROM penjualan
  JOIN produk ON penjualan.produk_id = produk.id
  ORDER BY tanggal DESC
");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Data Penjualan</title>
</head>
<body>
  <h1>Data Penjualan</h1>
  <table border="1" cellpadding="5">
    <tr>
      <th>Tanggal</th>
      <th>Produk</th>
      <th>Qty</th>
      <th>Total</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($data)) { ?>
    <tr>
      <td><?= $row['tanggal'] ?></td>
      <td><?= $row['nama_produk'] ?></td>
      <td><?= $row['qty'] ?></td>
      <td>Rp <?= number_format($row['total']) ?></td>
    </tr>
    <?php } ?>
  </table>

  <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
