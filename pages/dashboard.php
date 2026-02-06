<?php
include "../config/db.php";

// Total omzet
$q1 = mysqli_query($conn, "SELECT SUM(total) AS total_omzet FROM penjualan");
$omzet = mysqli_fetch_assoc($q1)['total_omzet'] ?? 0;

// Total transaksi
$q2 = mysqli_query($conn, "SELECT COUNT(*) AS total_transaksi FROM penjualan");
$transaksi = mysqli_fetch_assoc($q2)['total_transaksi'] ?? 0;

// Produk terlaris
$q3 = mysqli_query($conn, "
  SELECT produk.nama_produk, SUM(penjualan.qty) AS total_jual
  FROM penjualan
  JOIN produk ON penjualan.produk_id = produk.id
  GROUP BY produk.id
  ORDER BY total_jual DESC
  LIMIT 5
");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard Penjualan</title>
</head>
<body>
  <h1>Dashboard</h1>

  <p><b>Total Omzet:</b> Rp <?= number_format($omzet) ?></p>
  <p><b>Total Transaksi:</b> <?= $transaksi ?></p>

  <h3>Produk Terlaris</h3>
  <ul>
    <?php while($row = mysqli_fetch_assoc($q3)) { ?>
      <li><?= $row['nama_produk'] ?> - <?= $row['total_jual'] ?> pcs</li>
    <?php } ?>
  </ul>

  <a href="penjualan.php">Lihat Data Penjualan</a> |
  <a href="tambah_penjualan.php">Tambah Penjualan</a>
</body>
</html>
