<?php
// Set waktu
date_default_timezone_set('Asia/Jakarta');
$tgl = date('Y-m-d H:i:s');

//Koneksi Database
$HOSTNAME = "localhost";
$DATABASE = "db_sisfolab";
$USERNAME = "root";
$PASSWORD = "";

$KONEKSI = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if (!$KONEKSI) {
    die("Koneksi database error mas Bro...!!!" . mysqli_connect_error($KONEKSI));
}


// Autonumber \\
// ========== \\

function autonumber($tabel, $kolom, $lebar = 0, $awalan)
{
    global $KONEKSI;

    //proses auto number



    $auto = mysqli_query($KONEKSI, "select $kolom from $tabel order by $kolom desc limit 1") or die(mysqli_error($KONEKSI));

    $jumlah_record = mysqli_num_rows($auto);
    if ($jumlah_record == 0)
        $nomor = 1;

    else {
        $row = mysqli_fetch_array($auto);
        $nomor = intval(substr($row[0], strlen($awalan))) + 1;
    }
    if ($lebar > 0)
        $angka = $awalan . str_pad($nomor, $lebar, "0", STR_PAD_LEFT);
    else
        $angka = $awalan . $nomor;
    return $angka;
}
// echo autonumber("tbl_dokter","kode_dokter",3,"DOK");




// Fungsi Register user Admin \\
// ========================== \\
function registrasi($data)
{
    global $KONEKSI;
    global $tgl;

    $id_user = stripslashes($data["id_user"]);  // untuk cek form register dari input id_user
    $nama = stripslashes($data["nama"]);  // untuk cek form register dari input nama
    $email = strtolower(stripslashes($data["email"])); // memastikan form register mengirim input email berupa huruf kecil semua
    $password = mysqli_real_escape_string($KONEKSI, $data["password"]);
    $password2 = mysqli_real_escape_string($KONEKSI, $data["password2"]);

    // echo $email . "|" . $password . "|" . $password;

    //Cek email yang di input ada belum di database
    $result = mysqli_query($KONEKSI, "SELECT email from tbl_users WHERE email='$email'");
    // var_dump($result);

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('Email yang di input sudah ada di database!!!');
        </script>";
        return false;
    }


    // Cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert('Konfirmasi Password tidak sesuai!!!');
        document.location.href='register.php';
        </script>";
        return false;
    }

    // Enkripsi password yang akan kita masukan kedatabase
    $password_hash = password_hash($password, PASSWORD_DEFAULT); // menggunakan algoritma default dari hash
    // var_dump($password_hash);

    // Ambil id tipe user Admin
    $tipe_user = "SELECT * FROM tbl_tipe_user WHERE tipe_user='Admin' ";
    $hasil = mysqli_query($KONEKSI, $tipe_user);
    $row = mysqli_fetch_assoc($hasil);
    $id = $row['id_tipe_user'];


    // Tambah user baru ke tbl_users
    $sql_user = "INSERT INTO tbl_users SET 
    id_user = '$id_user',
    role = '$id',
    email = '$email',
    password = '$password_hash',
    create_at = '$tgl' ";

    mysqli_query($KONEKSI, $sql_user) or die("Gagal Menambahkan User" . mysqli_error($KONEKSI));


    // Tambah user baru ke tbl_admin
    $sql_admin = "INSERT INTO tbl_admin SET 
    nama_admin = '$nama',
    id_user = '$id_user',
    create_at = '$tgl' ";

    mysqli_query($KONEKSI, $sql_admin) or die("Gagal Menambahkan User" . mysqli_error($KONEKSI));

    echo "<script>
    document.location.href='login.php';
    </script>";

    return mysqli_affected_rows($KONEKSI);
}






?>