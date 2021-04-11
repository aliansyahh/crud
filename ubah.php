<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location:login.php");
}
require_once "logic/function.php";

$id = $_GET['id'];
$mhs = tampil("SELECT * FROM mahasiswa WHERE id=$id")[0];

if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
        echo "<script>alert('Data Berhasil Diubah');document.location.href='index.php'</script>";
    } else {
        echo mysqli_error($conn);
    }
}

require_once "template/header.php";
require_once "template/sidebar.php";
require_once "template/navbar.php";



?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">Ubah Data Mahasiswa</div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="id" name="id" value="<?= $mhs['id']; ?>">

                        <input type="hidden" id="gambarlama" name="gambarlama" value="<?= $mhs['gambar']; ?>">
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" autofocus
                                value="<?= $mhs['nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="npm" class="form-label">Npm</label>
                            <input type="number" class="form-control" name="npm" id="npm" value="<?= $mhs['npm']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                value="<?= $mhs['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" name="jurusan" id="jurusan"
                                value="<?= $mhs['jurusan']; ?>">
                        </div>

                        <img src="assets/img/<?= $mhs['gambar']; ?>" width="180" alt="">
                        <div class="custom-file">

                            <input type="file" class="custom-file-input" id="gambar" name="gambar">
                            <label class="custom-file-label" for="inputGroupFile01">Ubah Gambar</label>
                        </div>
                        <button type="submit" name="ubah" class="btn btn-primary my-3 float-right">Ubah
                            Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php require_once "template/footer.php"; ?>