<?php
require 'config.php';

// untuk nampilin produk
$query = "SELECT * FROM produk";
$result = mysqli_query($conn, $query);


// untuk search produk
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
if (!empty($keyword)) {
    // mencari berdasarkan nama_produk atau kategori_produk
    $query .= " WHERE nama_produk LIKE '%$keyword%' OR kategori_produk LIKE '%$keyword%'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>

    <style>
        .title,
        .sub-title {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif
        }

        .title {
            font-size: 25px;
        }

        .sub-title {
            font-size: 20px;
        }

        .container {
            display: flex;
            justify-content: start;
            gap: 10px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 10px;
        }

        .container .card {
            margin-bottom: 30px;
            border: 1px solid lightgray;
            width: 250px;
            position: relative;
            border-radius: 5px;
        }

        .container .card .info-produk {
            padding: 10px;
            margin-bottom: 60px;
        }

        .container .card .info-produk h3 {
            margin-top: 0;
        }

        .container .card .info-produk p {
            margin: 5px 0;
        }

        .container .card img {
            width: 250px;
            height: 150px;
            object-fit: cover;
        }

        .container .card .wrap-btn {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .container .card .wrap-btn .btn-cart {
            width: 100%;
            padding: 10px;
            border-style: none;
            background-color: dodgerblue;
            border: 1px solid dodgerblue;
            cursor: pointer;
            bottom: 0;
            border-radius: 5px;
            color: white;
        }

        .container .card .wrap-btn .btn-cart:hover {
            background-color: blue;
            border: 1px solid blue;
            color: white;
            transition: 0.2s;
        }

        .cari-input {
            padding: 10px;
            width: 300px;
            border-radius: 5px;
        }

        .btn-cari {
            padding: 10px;
            border-style: none;
            background-color: dodgerblue;
            border: 1px solid dodgerblue;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-cari:hover {
            background-color: blue;
            border: 1px solid blue;
            color: white;
            transition: 0.2s;
        }
    </style>
</head>

<body>
    <h1 class="title">HALAMAN CUSTOMER</h1>

    <h2 class="sub-title">Daftar Produk</h2>
    <form method="GET" action="">
        <input type="text" name="keyword" placeholder="Cari produk atau kategori..." value="<?php echo htmlspecialchars($keyword); ?>" class="cari-input">
        <button type="submit" class="btn-cari">Cari</button>
    </form>

    <br>

    <div class="container">
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="card">
                    <img src="admin/uploads/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_produk']; ?>">
                    <div class="info-produk">
                        <h3><?php echo $row['nama_produk']; ?></h3>
                        <p>Kategori: <?php echo $row['kategori_produk']; ?></p>
                        <p>Harga: Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                        <p><?php echo $row['deskripsi']; ?></p>
                        <p>Stok: <?php echo $row['stok']; ?></p>
                    </div>
                    <div class="wrap-btn">
                        <button class="btn-cart">Add to cart</button>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>Tidak ada produk tersedia.</p>
        <?php } ?>
    </div>

</body>

</html>