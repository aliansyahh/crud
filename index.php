<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location:login.php");
}

require_once "template/header.php";
require_once "template/sidebar.php";
require_once "template/navbar.php";

require_once "logic/function.php";

$mahasiswa = tampil("SELECT * FROM mahasiswa");

if (isset($_POST['cari'])) {
    $mahasiswa = cari($_POST['keyword']);
}

?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-10 ">
            <div class="card">
                <div class="card-body">

                    <a href="tambah.php" class="btn btn-primary mb-2">Tambah Data Mahasiswa</a>

                    <form action="" method="post">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="Cari Mahasiswa" name="keyword">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" name="cari" type="submit">Button</button>
                            </div>
                        </div>

                    </form>
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 1px;">No</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Npm</th>
                                <th>Email</th>
                                <th>jurusan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($mahasiswa as $mhs) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $mhs['nama']; ?></td>
                                <td><?= $mhs['npm']; ?></td>
                                <td><?= $mhs['email']; ?></td>
                                <td><?= $mhs['jurusan']; ?></td>
                                <td><img src="assets/img/<?= $mhs['gambar']; ?>" alt="" width="80px"></td>
                                <td>
                                    <a href="hapus.php?id=<?= $mhs['id']; ?>" class="btn btn-danger btn-circle btn-sm"
                                        onclick="return confirm('yakin....?')">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <a href="ubah.php?id=<?= $mhs['id']; ?>" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php require_once "template/footer.php"; ?>