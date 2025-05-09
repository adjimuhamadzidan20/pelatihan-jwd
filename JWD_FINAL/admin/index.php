<?php
require "../config_process/config.php";

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="stylesheet" href="assets/bootstrap-5.3.6/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="head-title d-flex mt-4 mb-3 justify-content-between align-items-center">
            <h1 class="text-left fs-4">DASHBOARD ADMIN</h1>
            <div>
                <a href="logout.php" class="btn btn-primary btn-sm" onclick="return confirm('Anda yakin?')">Logout</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row border border-1 p-3 rounded mb-4">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <h3>Data Produk</h3>
                    <div>
                        <a href="tambah_produk.php" class="btn btn-primary btn-sm">Tambah Produk</a>
                    </div>
                </div>

                <table class="table mt-4">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>

                    <?php
                    $no = 1;
                    $query = "SELECT * FROM produk";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) :
                        while ($row = mysqli_fetch_assoc($result)) :
                    ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nama_produk']; ?></td>
                                <td><?php echo $row['kategori_produk']; ?></td>
                                <td><img src="uploads/<?php echo $row['gambar']; ?>" width="50"></td>
                                <td><?php echo $row['harga']; ?></td>
                                <td><?php echo $row['deskripsi']; ?></td>
                                <td><?php echo $row['stok']; ?></td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="edit_produk.php?id=<?php echo $row['id_produk']; ?>">Edit</a>
                                    <a class="btn btn-primary btn-sm" href="hapus_produk.php?id=<?php echo $row['id_produk']; ?>" onclick="return confirm('Yakin ingin hapus produk ini?');">Delete</a>
                                </td>
                            </tr>
                    <?php
                        endwhile;
                    else :
                        echo "<tr><td colspan='8'>Tidak ada data produk.</td></tr>";
                    endif;
                    ?>
                </table>
            </div>
        </div>

        <div class="row border border-1 p-3 rounded mb-4">
            <div class="col">
                <h3>Data User</h3>
                <table class="table mt-4">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama lengkap</th>
                        <th>No telp</th>
                        <th>Alamat</th>
                        <th>Waktu Pembuatan</th>
                    </tr>

                    <?php
                    $no = 1;
                    $query_user = "SELECT * FROM user";
                    $result_user = mysqli_query($conn, $query_user);

                    if (mysqli_num_rows($result_user) > 0) :
                        while ($row_user = mysqli_fetch_assoc($result_user)) :
                    ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row_user['username']; ?></td>
                                <td><?php echo $row_user['nama_lengkap']; ?></td>
                                <td><?php echo $row_user['no_telepon']; ?></td>
                                <td><?php echo $row_user['alamat']; ?></td>
                                <td><?php echo $row_user['created_at']; ?></td>

                            </tr>
                    <?php
                        endwhile;
                    else :
                        echo "<tr><td colspan='8'>Tidak ada data produk.</td></tr>";
                    endif;
                    ?>
                </table>
            </div>
        </div>

        <div class="row border border-1 p-3 rounded mb-4">
            <div class="col">
                <h3>Data Pesanan</h3>

                <table class="table mt-4">
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $query_pesanan = "SELECT pesanan.*, user.username 
                    FROM pesanan JOIN user ON pesanan.id_user = user.id_user
                    ORDER BY pesanan.created_at DESC";
                    $result_pesanan = mysqli_query($conn, $query_pesanan);

                    if (mysqli_num_rows($result_pesanan) > 0) :
                        while ($row = mysqli_fetch_assoc($result_pesanan)) :
                    ?>
                            <tr>
                                <td><?= $row['id_pesanan'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                                <td>
                                    <form action="update_status.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id_pesanan" value="<?= $row['id_pesanan'] ?>">
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="pending" <?= ($row['status'] == 'pending') ? 'selected' : '' ?>>pending</option>
                                            <option value="diproses" <?= ($row['status'] == 'diproses') ? 'selected' : '' ?>>Diproses</option>
                                            <option value="dikirim" <?= ($row['status'] == 'dikirim') ? 'selected' : '' ?>>Dikirim</option>
                                            <option value="selesai" <?= ($row['status'] == 'selesai') ? 'selected' : '' ?>>Selesai</option>
                                        </select>
                                    </form>
                                </td>
                                <td><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                                <td>
                                    <a href="detail_pesanan.php?id=<?= $row['id_pesanan'] ?>">Detail</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">Tidak ada pesanan.</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <br><br><br><br>

    <script src="assets/bootstrap-5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>