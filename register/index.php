<?php
include '../config.php';
include '../assets/composer/google-api-client-php-7.4/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
    <title>Register</title>
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
    }

    .box_log_reg {
        background: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
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
        padding: 10px 12px;
        margin-top: 5px;
        margin-bottom: 8px;
        border: 1px solid #ccc;
        border-radius: 8px;
        outline: none;
        transition: border-color 0.3s;
    }

    .input:focus {
        border-color: #ec407a;
        box-shadow: 0 0 0 3px rgba(236, 64, 122, 0.15);
    }

    .button {
        background-color: #ec407a;
        color: white;
        text-align: center;
        padding: 1px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
        padding-right: 0px;
    }

    .button:hover {
        background-color: #ff6b81;
    }

    #masuk_loading .button {
        background-color: #ccc;
    }

    #res {
        margin-top: 20px;
        text-align: center;
        color: red;
    }

    .box_log_reg h4 {
        text-align: center;
        font-weight: normal;
    }

    .log_reg_social {
        margin-top: 20px;
    }

    .isi_log_reg_social {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .isi_log_reg_social:hover {
        background-color: #f2f2f2;
    }

    .isi_log_reg_social img {
        height: 24px;
    }

    .line_log_reg {
        height: 1px;
        background-color: #ccc;
        margin: 20px 0;
    }

    .text_line_log_reg {
        margin: 0;
        color: #888;
        font-size: 14px;
    }
</style>

<!-- CONTENT -->
<div class="log_reg">
    <div class="box_log_reg">
        <center>
            <a href="<?php echo $url; ?>">
                <img src="../assets/icons/<?php echo $logo; ?>" alt=""
                     style="height: 100px; width: 100px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc; padding: 5px;">
            </a>
        </center>
        <h1>Daftar</h1>
        <h4>Sudah punya akun? <a href="<?php echo $url; ?>login/">Masuk Sekarang</a></h4>

        <div class="log_reg_social">
            <a href="<?php echo $google_client->createAuthUrl(); ?>">
                <div class="isi_log_reg_social">
                    <img src="../assets/icons/sosmed/google.svg" alt="">
                    <p>Daftar Dengan Google</p>
                </div>
            </a>
        </div>

        <div class="line_log_reg"></div>
        <center><p class="text_line_log_reg">Atau Daftar dengan</p></center>

        <div class="box_form_log_reg">
            <div class="form_log_reg">
                <p id="p_nama_lengkap"></p>
                <input type="text" placeholder="Nama Lengkap" class="input" id="nama_lengkap">
            </div>
            <div class="form_log_reg">
                <p id="p_email"></p>
                <input type="text" placeholder="Email" class="input" id="email">
            </div>
            <div class="form_log_reg">
                <p id="p_no_whatsapp"></p>
                <input type="text" placeholder="Nomor Whatsapp" class="input" id="no_whatsapp">
            </div>
            <div class="form_log_reg">
                <p id="p_password"></p>
                <input type="password" placeholder="Password" class="input" id="password">
            </div>
        </div>

        <div id="daftar_button">
            <div class="button" id="daftar">
                <p>Daftar Sekarang</p>
            </div>
        </div>
        <div id="daftar_loading" style="display: none;">
            <div class="button">
                <img src="../assets/icons/loading-w.svg" id="loading_daftar">
            </div>
        </div>
    </div>
</div>
<div class="res" id="res"></div>
<!-- CONTENT -->

<!-- JS -->
<script src="../assets/js/register/index.js"></script>
<!-- JS -->
</body>

</html>
