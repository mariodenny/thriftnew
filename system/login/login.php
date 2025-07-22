<?php
session_start(); // WAJIB di paling atas

include '../../config.php';

$email = mysqli_real_escape_string($server, $_POST['email']);
$password = $_POST['password'];

// Cek akun berdasarkan email
$cek_akun = $server->query("SELECT * FROM `akun` WHERE `email`='$email'");
$cek_akun_data = mysqli_fetch_assoc($cek_akun);

if ($cek_akun_data) {
    $pass_akun = $cek_akun_data['password'];

    if (password_verify($password, $pass_akun)) {
        // Ambil ID dan Role user
        $idakun_plain = $cek_akun_data['id'] . "hcCTZvFLD7XIchiaMqEka0TLzGgdpsXB";
        $role = $cek_akun_data['tipe_akun']; // Misal: 'admin' atau 'customer'

        // Enkripsi ID
        $ciphering = "AES-128-CTR";
        $options = 0;
        $encryption_iv = '1234567891011121';
        $encryption_key = "ecommerce";
        $encryption = openssl_encrypt($idakun_plain, $ciphering, $encryption_key, $options, $encryption_iv);

        setcookie("login", $encryption, time() + (86400 * 30), "/");

        $_SESSION['user_id'] = $cek_akun_data['id'];
        $_SESSION['email'] = $cek_akun_data['email'];
        $_SESSION['tipe_akun'] = $cek_akun_data['tipe_akun'];
        $_SESSION['whatsapp'] = $cek_akun_data['no_whatsapp'];
        $_SESSION['nama_lengkap'] = $cek_akun_data['nama_lengkap'];


        // Redirect berdasarkan role
        if ($role == 'Admin') {
            header("Location: $url/admin/");
        } else {
            header("Location: $url/");
        }
        exit;
    } else {
        header("Location: ../../login/?error=password");
        exit;
    }
} else {
    header("Location: ../../login/?error=email");
    exit;
}
