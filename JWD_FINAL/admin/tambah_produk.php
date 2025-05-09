<?php
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
    <title>Tambah Produk</title>

    <link rel="stylesheet" href="assets/bootstrap-5.3.6/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="head-title d-flex mt-4 mb-3 justify-content-between align-items-center">
            <h1 class="text-left fs-4">TAMBAH PRODUK</h1>
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
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="stok" placeholder="Stok" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-primary">Kembali</a>
                        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>