<?php
include "../config/db.php";

// Ambil produk
$produk = mysqli_query($conn, "SELECT * FROM produk");

if (isset($_POST['simpan'])) {
  $tanggal = $_POST['tanggal'];
  $produk_id = $_POST['produk_id'];
  $qty = $_POST['qty'];

  // Ambil harga produk
  $p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM produk WHERE id=$produk_id"));
  $total = $p['harga'] * $qty;

  mysqli_query($conn, "INSERT INTO penjualan (tanggal, produk_id, qty, total)
                       VALUES ('$tanggal', '$produk_id', '$qty', '$total')");

  header("Location: penjualan.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tambah Penjualan</title>
</head>
<body>
  <h1>Tambah Penjualan</h1>

  <form method="post">
    <label>Tanggal:</label><br>
    <input type="date" name="tanggal" required><br><br>

    <label>Produk:</label><br>
    <select name="produk_id">
      <?php while($row = mysqli_fetch_assoc($produk)) { ?>
        <option value="<?= $row['id'] ?>"><?= $row['nama_produk'] ?></option>
      <?php } ?>
    </select><br><br>

    <label>Qty:</label><br>
    <input type="number" name="qty" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
  </form>

  <a href="dashboard.php">Kembali</a>
</body>
</html>
