<?php
session_start();

// Hapus cookie login
if (isset($_COOKIE['login'])) {
    setcookie('login', '', time() - 3600, '/'); // waktu negatif untuk hapus
}

// Hapus session jika ada
session_unset();
session_destroy();

// Redirect ke halaman utama
header("Location: ../index.php");
exit;
?>
