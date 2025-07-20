<?php
include '../config.php';
include '../assets/composer/google-api-client-php-7.4/config.php';

// CEK LOGIN GOOGLE
if (isset($_GET['code'])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        // DATA LOGIN GOOGLE
        $email_google = $data['email'];
        $nama_depan_google = $data['given_name'];
        $nama_belakang_google = $data['family_name'];
        $nama_lengkap_google = "$nama_depan_google $nama_belakang_google";
        $time = date("Y-m-d H:i:s");
        $jenis_daftar = "Google";
        // CEK AKUN
        $akun_user = $server->query("SELECT * FROM `akun` WHERE `email`='$email_google'");
        $akun_user_data = mysqli_fetch_assoc($akun_user);
        // HASIL CEK AKUN
        if ($akun_user_data) {
            $idakun = $akun_user_data['id'] . "hcCTZvFLD7XIchiaMqEka0TLzGgdpsXB";
            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            $encryption_iv = '1234567891011121';
            $encryption_key = "ecommerce";
            $encryption = openssl_encrypt($idakun, $ciphering, $encryption_key, $options, $encryption_iv);
            $buat_cookie = setcookie("login", $encryption, time() + (86400 * 30), "/");
            if ($buat_cookie) {
                echo '<script>window.location.href="' . $url . '";</script>';
            }
        } else {
            $insert_akun = $server->query("INSERT INTO `akun`(`foto`, `nama_lengkap`, `email`, `waktu`, `tipe_daftar`) VALUES ('user.png', '$nama_lengkap_google', '$email_google', '$time', '$jenis_daftar')");
            if ($insert_akun) {
                $select_akun = $server->query("SELECT * FROM `akun` WHERE `email`='$email_google'");
                $select_akun_data = mysqli_fetch_assoc($select_akun);
                // ENSKRIPSI ID
                $idakun = $select_akun_data['id'] . "hcCTZvFLD7XIchiaMqEka0TLzGgdpsXB";
                $ciphering = "AES-128-CTR";
                $iv_length = openssl_cipher_iv_length($ciphering);
                $options = 0;
                $encryption_iv = '1234567891011121';
                $encryption_key = "ecommerce";
                $encryption = openssl_encrypt($idakun, $ciphering, $encryption_key, $options, $encryption_iv);
                $buat_cookie = setcookie("login", $encryption, time() + (86400 * 30), "/");
                if ($buat_cookie) {
                    echo '<script>window.location.href="' . $url . '";</script>';
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
    <title>Login</title>
    <link rel="icon" href="../assets/icons/<?php echo $logo; ?>" type="image/svg">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login-register/index.css">
</head>

<body>
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #ffc0cb; 
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .log_reg {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 20px; 
        box-sizing: border-box; 
    }

    .box_log_reg {
        background: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        width: 100%;
        max-width: 400px;
        transition: all 0.3s ease-in-out;
    }

    .box_log_reg h1 {
        text-align: center;
        color: #3a3a3a;
        margin-top: 20px;
        margin-bottom: 25px;
        font-weight: bold;
    }

    .input {
        width: 100%;
        padding: 12px 15px;
        margin-top: 5px;
        margin-bottom: 8px;
        border: 1px solid #ddd; 
        border-radius: 8px;
        outline: none;
        transition: border-color 0.3s, box-shadow 0.2s ease-in-out;
        font-size: 14px;
        box-sizing: border-box; 
    }

    .input:focus {
        border-color: #ec407a;
        box-shadow: 0 0 0 3px rgba(236, 64, 122, 0.15);
    }

    .input-wrapper {
        position: relative;
        margin-bottom: 15px; /* Add space below password input */
    }

    .button {
        background-color: #ec407a;
        color: white;
        text-align: center;
        padding: 12px 0; 
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        border: none; 
        width: 100%; 
        font-size: 16px; 
        margin-top: 10px; }

    .button:hover {
        background-color: #ff6b81;
        transform: translateY(-2px);
    }

    #masuk_loading .button {
        background-color: #ccc;
        cursor: not-allowed;
    }

    #res {
        margin-top: 20px;
        text-align: center;
        color: red;
        font-size: 14px;
    }

    a {
        color: #ec407a;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .google-login {
        margin-top: 15px;
        background: #ffffff;
        color: #333;
        border: 1px solid #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 10px;
        border-radius: 10px;
        font-size: 14px;
        transition: 0.3s;
        cursor: pointer;
    }

    .google-login:hover {
        background: #f7f7f7;
        border-color: #999;
    }

    .google-login img {
        width: 20px;
        height: 20px;
    }

    #togglePassword {
        position: absolute;
        right: 15px;
        top: 50%; /* Center vertically */
        transform: translateY(-50%); /* Adjust for vertical centering */
        cursor: pointer;
        color: #888;
        font-size: 18px;
    }

    .error {
        color: red;
        text-align: center;
        margin-top: 10px;
        font-size: 14px;
    }

    h4 {
        text-align: center;
        margin-top: 20px;
        font-weight: normal;
        color: #555;
        font-size: 14px;
    }

</style>

    <div class="log_reg">
        
        <div class="box_log_reg">
            <center>
                <a href="<?php echo $url; ?>">
                    <img
                        src="../assets/icons/<?php echo $logo; ?>"
                        alt="Logo"
                        style="height: 100px; width: 100px; border-radius: 50%; object-fit: cover; border: 2px solid #eee; padding: 5px;"
                    >
                </a>
            </center>
            <h1 style="text-align: center;">Masuk</h1>
            
            <div class="box">
                <form action="../system/login/login.php" method="POST">
                    <input type="text" class="input" name="email" placeholder="Email" required>
                    <div class="input-wrapper">
                        <input type="password" class="input" name="password" id="password" placeholder="Password" required>
                        <i class="ri-eye-off-line" id="togglePassword"></i>
                    </div>
                    <button type="submit" class="button">Masuk</button>
                </form>

                <div class="error">
                    <?php if (isset($_GET['error'])) {
                        if ($_GET['error'] == 'email') echo "Email Tidak Ditemukan";
                        if ($_GET['error'] == 'password') echo "Password Salah";
                    } ?>
                </div>

                <a href="<?php echo $google_client->createAuthUrl(); ?>" class="google-login">
                    <img src="https://www.google.com/favicon.ico" alt="Google icon">
                    Lanjutkan dengan Google
                </a>
            </div>
            
            <h4>Belum punya akun? <a href="<?php echo $url; ?>register/">Daftar Sekarang</a></h4>
        </div>
        <div id="masuk_loading">
            <div class="button">
                <img src="../assets/icons/loading-w.svg" id="loading_masuk">
            </div>
        </div>
    </div>
    <div class="res" id="res"></div>
    <script src="../assets/js/login/index.js"></script>
    <script>
        // Toggle show/hide password
        function bindTogglePassword() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function () {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    this.classList.toggle('ri-eye-line');
                    this.classList.toggle('ri-eye-off-line');
                });
            }
        }

        document.addEventListener("DOMContentLoaded", bindTogglePassword);
    </script>

    </body>

</html>