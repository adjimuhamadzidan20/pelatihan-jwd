<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row p-4">
            <h2>Register User</h2>
            <div class="col-5 mt-3">
                <form action="proses_register_user.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Username</label>
                        <input type="username" class="form-control" id="exampleFormControlInput1" placeholder="Username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleFormControlInput2" placeholder="Password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="exampleFormControlInput3" placeholder="Nama Lengkap" name="nama_lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput4" class="form-label">No Telp</label>
                        <input type="text" class="form-control" id="exampleFormControlInput4" placeholder="No Telepon" name="no_telp" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Masukkan Alamat" id="floatingTextarea" name="alamat" required></textarea>
                            <label for="floatingTextarea">Masukkan Alamat</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm mb-2">Register</button>
                    <p>Sudah punya akun? <a href="login_user.php">Login di sini</a></p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>