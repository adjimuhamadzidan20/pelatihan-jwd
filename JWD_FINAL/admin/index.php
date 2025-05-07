<?php
require '../config.php';

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// proses form ketika submit
if (isset($_POST['submit'])) {
    $nama_produk = $_POST['nama_produk'];
    $kategori_produk = $_POST['kategori_produk'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];

    // fungsi upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $upload_dir = 'uploads/';

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $gambar_path = $upload_dir . basename($gambar);

    if (move_uploaded_file($tmp_name, $gambar_path)) {
        $query = "INSERT INTO produk VALUES ('', '$nama_produk', '$kategori_produk', '$gambar', '$harga', '$deskripsi', '$stok')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo 'Produk berhasil ditambahkan!';
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo 'Error :' . mysqli_error($conn);
        }
    } else {
        echo 'Gambar gagal diupload!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="head-title d-flex my-3 justify-content-between align-items-center">
            <h1 class="text-left fs-3">HALAMAN ADMIN</h1>
            <div>
                <a href="logout.php" class="btn btn-primary btn-sm">Logout</a>
            </div>
        </div>

        <div class="row border border-1 p-3 rounded">
            <div class="col">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama_produk" placeholder="Nama Produk" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kategori Produk</label>
                        <select class="form-select" aria-label="Default select example" name="kategori_produk" required>
                            <option value="" selected>-- Pilih Kategori --</option>
                            <option value="Elektronik">Elektronik</option>
                            <option value="Pakaian">Pakaian</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Gambar</label>
                        <input class="form-control" type="file" id="formFile" name="gambar" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="harga" placeholder="Harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="floatingTextarea">Deskripsi</label>
                        <textarea class="form-control" placeholder="Deskripsi" id="floatingTextarea" name="deskripsi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="stok" placeholder="Stok" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Tambah Produk</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row border border-1 p-3 rounded">
            <div class="col">
                <h3>Data Produk</h3>

                <table class="table mt-4">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Stok</th>
                        <th>Aksi</th>
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
                                <td>
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
    </div>

    <br><br><br><br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>