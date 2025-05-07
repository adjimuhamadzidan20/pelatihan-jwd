<?php
include "../config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM produk WHERE id_produk = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>
                    alert('Data telah dihapus!');
                    window.location.href = 'index.php';
                </script>";
        exit;
    } else {
        echo "Gagal menghapus produk.";
    }
} else {
    echo "ID tidak ditemukan.";
}
