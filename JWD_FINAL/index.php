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

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <div class="nav-elemen">
            <a href="index.php" class="logo-title">Beyourself Product</a>
            <ul>
                <li><a href="index.php?page=produk">Product</a></li>
                <li><a href="index.php?page=about">About Us</a></li>
                <li><a href="index.php?page=contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <?php
        require 'config_page/config_page.php';
        ?>
    </main>

</body>

</html>