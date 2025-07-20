<?php
session_start();
session_unset();
session_destroy();

// Hapus cookie login_admin
setcookie('login_admin', '', time() - 3600, '/');

// Redirect ke halaman login admin
header("Location: http://localhost/thriftnew/admin/login/");
exit;
?>
