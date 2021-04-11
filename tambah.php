<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location:login.php");
}

require_once "logic/function.php";


if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        echo "<script>alert('Data Berhasil Ditambhakan');document.location.href='index.php'</script>";
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
                <div class="card-header text-center bg-primary text-white">Tambah Data Mahasiswa</div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="npm" class="form-label">Npm</label>
                            <input type="number" class="form-control" name="npm" id="npm">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" name="jurusan" id="jurusan">
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="gambar" name="gambar">
                            <label class="custom-file-label" for="inputGroupFile01">Upload Gambar</label>
                        </div>
                        <button type="submit" name="tambah" class="btn btn-primary my-3 float-right">Tambah
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