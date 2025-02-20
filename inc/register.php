<?php
@session_start();
require_once 'functions.php';


// Cek apakah sudah login sebagai admin
// if (@$_SESSION['email']) {
//     if (@!$_SESSION['level'] == "Admin") {
//         header("location:../inc/register.php");
//     } else {
//         if (@$_SESSION['level'] == "Koordinator") {
//             header("location:../koordinator/index.php");
//         } elseif (@$_SESSION['level'] == "Laboran") {
//             header("location:../laboran/index.php");
//         } elseif (@$_SESSION['level'] == "Siswa") {
//             header("location:../siswa/index.php");
//         } elseif (@$_SESSION['level'] == "Other") {
//             header("location:../other/index.php");
//         }
//     }
// } else {
//     header("location:../inc/login.php");
// }


// Registrasi
if (isset($_POST["registrasi"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('User baru berhasil ditambahkan!');
        document.location.href ='register.php';
        </script>";
    } else {
        echo mysqli_error($KONEKSI);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/preview-equation/default/user_register_3.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Mar 2022 16:43:56 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Register | Maintenance Lab Komputer</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/store11.ico" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="../assets/css/loader.css" rel="stylesheet" type="text/css" />
    <link href='../https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/users/register-3.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

</head>

<body class="login">
    <div id="eq-loader">
        <div class="eq-loader-div">
            <div class="eq-loading dual-loader mx-auto mb-5"></div>
        </div>
    </div>
    <form class="form-login" method="post">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <img alt="logo" src="../assets/img/logo-3.png" width="100px" class="theme-logo">
            </div>
            <div class="col-md-12">
                <input type="hidden" name="id_user" value="<?php echo autonumber("tbl_users", "id_user", 7, "ADM"); ?>">
                <label for="inputName" class="">NAMA</label>
                <input type="text" id="inputName" class="form-control mb-4" name="nama" placeholder="Login" required>
                <label for="inputEmail" class="">EMAIL</label>
                <input type="email" id="inputEmail" class="form-control mb-4" name="email" placeholder="Login" required>
                <label for="inputPassword" class="">PASSWORD</label>
                <input type="password" id="inputPassword" class="form-control mb-4" name="password" placeholder="Password" required>
                <label for="inputRepeatPassword" class="">REPEAT PASSWORD</label>
                <input type="password" id="inputRepeatPassword" class="form-control mb-5" name="password2" placeholder="Password" required>

                <button type="submit" class="btn btn-gradient-dark btn-rounded btn-block" name="registrasi">Register</button>
                <div class="forgot-pass text-center mt-4">
                    <a href="login.php">Back</a>
                </div>
            </div>
        </div>
    </form>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="../assets/js/loader.js"></script>
    <script src="../bootstrap/js/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
</body>

<!-- Mirrored from designreset.com/preview-equation/default/user_register_3.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Mar 2022 16:43:56 GMT -->

</html>