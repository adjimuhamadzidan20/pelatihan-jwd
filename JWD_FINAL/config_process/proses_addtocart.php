<?php
require 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'silahkan login dahulu!'
    ]);
    exit;
}

$id_produk = $_POST['id_produk'];
$id_user = $_SESSION['user_id'];

$sql = "SELECT * FROM keranjang WHERE id_user = '$id_user' AND id_produk = '$id_produk'";
$result = mysqli_query($conn, $sql);
$dataKeranjang = mysqli_num_rows($result);

// cek produk apakah sudah masuk keranjang
if ($dataKeranjang > 0) {
    $updateSql = "UPDATE keranjang SET jumlah = jumlah + 1 WHERE id_user = $id_user AND id_produk = $id_produk";
    mysqli_query($conn, $updateSql);
} else {
    $insertSql = "INSERT INTO keranjang VALUES ('', '$id_user', '$id_produk', 1)";
    mysqli_query($conn, $insertSql);
}

echo json_encode([
    'status' => 'success',
    'message' => 'produk ditambahkan ke keranjang!'
]);
