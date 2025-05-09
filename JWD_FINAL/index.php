<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beyourself Product</title>

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
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><span><?php echo htmlspecialchars($_SESSION['nama']); ?></span></li>
                    <li><a href="keranjang.php" class="opsi">Keranjang</a></li>
                    <li><a href="logout_user.php" class="opsi">Logout</a></li>
                <?php else: ?>
                    <li><a href="login_user.php" class="opsi">Keranjang</a></li>
                    <li><a href="login_user.php" class="opsi">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <main>
        <?php
        require 'config_page/config_page.php';
        ?>
    </main>

    <!-- Riwayat Pemesanan -->
    <?php if (isset($_SESSION['user_id']) && !empty($riwayat_pesanan)): ?>
        <div class="riwayat-pesanan">
            <h2>Riwayat Pemesanan Anda</h2>
            <table border="1" cellpadding="10" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($riwayat_pesanan as $pesanan): ?>
                        <tr>
                            <td><?php echo $pesanan['id_pesanan']; ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($pesanan['created_at'])); ?></td>
                            <td>Rp <?php echo number_format($pesanan['total'], 0, ',', '.'); ?></td>
                            <td class="status-<?php echo str_replace('_', '-', $pesanan['status']); ?>">
                                <?php
                                $status = [
                                    'pending' => 'pending',
                                    'diproses' => 'Diproses',
                                    'dikirim' => 'Dikirim',
                                    'selesai' => 'Selesai'
                                ];
                                echo $status[$pesanan['status']] ?? $pesanan['status'];
                                ?>
                            </td>
                            <td>
                                <a href="detail_pesanan_user.php?id=<?php echo $pesanan['id_pesanan']; ?>">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <script>
        function addToCart(productId) {
            <?php if (!isset($_SESSION['user_id'])): ?>
                alert("Silakan login terlebih dahulu!");
                window.location.href = "login_user.php";
            <?php else: ?>
                fetch("config_process/proses_addtocart.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "id_produk=" + productId
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        if (data.status === "success") {
                            window.location.reload();
                        }
                    });
            <?php endif; ?>
        }
    </script>

</body>

</html>