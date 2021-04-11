<?php

$conn = mysqli_connect("localhost", "root", "", "crud");

function tampil($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function upload()
{
    $filename = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $size = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];

    if ($error === 4) {
        echo "<script>alert('Upload Gambar terlebih Dahulu')</script>";
        return false;
    }

    if ($size > 100000) {
        echo "<script>alert('Ukuran Gambar Terlalu Besar')</script>";
        return false;
    }

    $ekstensivalid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensigambar = explode('.', $filename);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensivalid)) {
        echo "<script>alert('yang anda Upload Bukan Gambar')</script>";
        return false;
    }

    $newname = uniqid();
    $newname .= ".";
    $newname .= $ekstensigambar;
    move_uploaded_file($tmp, "assets/img/" . $newname);
    return $newname;
}

function tambah($post)
{
    global $conn;
    $nama = htmlspecialchars($post['nama']);
    $npm = htmlspecialchars($post['npm']);
    $email = htmlspecialchars($post['email']);
    $jurusan = htmlspecialchars($post['jurusan']);
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO mahasiswa VALUES (NULL,'$nama','$npm','$email','$jurusan','$gambar')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function ubah($post)
{
    global $conn;
    $id = htmlspecialchars($post['id']);
    $gambarlama = htmlspecialchars($post['gambarlama']);
    $nama = htmlspecialchars($post['nama']);
    $npm = htmlspecialchars($post['npm']);
    $email = htmlspecialchars($post['email']);
    $jurusan = htmlspecialchars($post['jurusan']);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarlama;
    } else {
        $gambar = upload();
    }

    if (!$gambar) {
        return false;
    }

    $query = "UPDATE mahasiswa SET
     nama='$nama',
     npm='$npm',
     email='$email',
     jurusan='$jurusan',
     gambar='$gambar' WHERE id =$id";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");
    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    return  tampil("SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%'");
}

function register($post)
{
    global $conn;

    $username = stripslashes(strtolower($post['username']));
    $password = mysqli_real_escape_string($conn, $post['password']);
    $password2 = mysqli_real_escape_string($conn, $post['password2']);

    $result = mysqli_query($conn, "SELECT username FROM user WHERE username ='$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Username Sudah Ada')</script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>alert('Confirmasi Password Tidak Sesuai')</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO user VALUES(null,'$username','$password')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}