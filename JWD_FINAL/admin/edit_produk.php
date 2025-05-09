<?php
include "../config_process/config.php";

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM produk WHERE id_produk = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Cek jika data tidak ditemukan
if (!$data) {
    echo "Produk tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>

    <link rel="stylesheet" href="assets/bootstrap-5.3.6/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="head-title d-flex mt-4 mb-3 justify-content-between align-items-center">
            <h1 class="text-left fs-4">EDIT PRODUK</h1>
        </div>

        <div class="row border border-1 p-3 rounded">
            <div class="col">
                <form action="proses_edit.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_produk" value="<?php echo $data['id_produk']; ?>">
                    <input type="hidden" name="gambar_lama" value="<?php echo $data['gambar']; ?>">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama_produk" value="<?php echo $data['nama_produk']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kategori Produk</label>
                        <select class="form-select" aria-label="Default select example" name="kategori_produk" required>
                            <option value="" selected>-- Pilih Kategori --</option>
                            <option value="Elektronik" <?php echo ($data['kategori_produk'] == 'Elektronik') ? 'selected' : ''; ?>>Elektronik</option>
                            <option value="Pakaian" <?php echo ($data['kategori_produk'] == 'Pakaian') ? 'selected' : ''; ?>>Pakaian</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex flex-column">
                            <label for="formFile" class="form-label">Gambar</label>
                            <img src="uploads/<?php echo $data['gambar']; ?>" alt="Gambar Produk" width="200" class="mb-3 img-thumbnail">
                        </div>
                        <input class="form-control" type="file" id="formFile" name="gambar" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="harga" value="<?php echo $data['harga']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="floatingTextarea">Deskripsi</label>
                        <textarea class="form-control" placeholder="Deskripsi" id="floatingTextarea" name="deskripsi" required><?php echo $data['deskripsi']; ?></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="stok" value="<?php echo $data['stok']; ?>" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-primary">Kembali</a>
                        <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>