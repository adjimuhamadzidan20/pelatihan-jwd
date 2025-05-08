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