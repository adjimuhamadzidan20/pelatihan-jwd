<?php
require 'config.php';
session_start();

// validasi
if (!isset($_SESSION['user_id']) or empty($_POST['alamat'])) {
    header('Location: ../checkout.php');
    exit;
}

// cek upload bukti transfer
$upload_dir = '../bukti_transfer/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

$buktiTf = $_FILES['bukti_transfer'];
$ext = pathinfo($buktiTf['name'], PATHINFO_EXTENSION);
$fileName = 'TRF' . $_SESSION['user_id'] . '-' . time() . '.' . $ext;
$lokasiFile = $upload_dir . $fileName;

// memeriksa format file
$ext_file = ['jpg', 'jpeg', 'png'];
if (!in_array(strtolower($ext), $ext_file)) {
    die('Hanya format file JPG/JPEG/PNG yang dibolehkan!');
}

// proses upload bukti TF
$fileBukti = $buktiTF['tmp_name'];
if (move_uploaded_file($fileBukti, $lokasiFile)) {
    // hitung total keranjang
    $total = 0;
    $id_user = $_SESSION['user_id'];
    $alamat = mysqli_escape_string($conn, $_POST['alamat']);

    // get data keranjang
    $sqlKeranjang = "SELECT produk.harga, keranjang,jumlah FROM keranjang JOIN produk ON 
    keranjang.id_produk = produk.id_produk WHERE keranjang.id_user = $id_user";

    $dtKeranjang = mysqli_query($conn, $sqlKeranjang);
    while ($baris = mysqli_fetch_assoc($dtKeranjang)) {
        $total += $row['harga'] = $row['jumlah'];
    }

    // 1. Simpan ke tabel pesanan (DENGAN bukti transfer)
    $sqlInsert = "INSERT INTO pesanan VALUES ($id_user, '$alamat', 'transfer_bank', '$filename', $total, 'pending')";

    mysqli_query($conn, $sqlInsert);
    $id_pesanan = mysqli_insert_id($conn);

    // 2. Pindahkan item keranjang ke detail_pesanan
    $sqlInsertDetail = "INSERT INTO detail_pesanan (id_pesanan, id_produk, jumlah, harga) SELECT $id_pesanan, id_produk, jumlah, 
    (SELECT harga FROM produk WHERE id_produk = keranjang.id_produk) FROM keranjang WHERE id_user = $id_user";
    mysqli_query($conn, $sqlInsertDetail);

    // 3. Kosongkan keranjang
    $sqlDel = "DELETE FROM keranjang WHERE id_user = $id_user";
    mysqli_query($conn, $sqlDel);

    // 4. Redirect ke halaman konfirmasi
    header("Location: konfirmasi.php?id_pesanan=$id_pesanan");
    exit;
} else {
    die("Gagal upload bukti transfer!");
}
