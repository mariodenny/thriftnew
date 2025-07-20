<?php
include '../../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
    <title>Login</title>
    <link rel="icon" href="../../assets/icons/<?php echo $logo; ?>" type="image/svg">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/login-register/index.css">
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

  .login-container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    width: 100%;
    max-width: 400px;
    margin: 80px auto;
    box-shadow: none; 
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
        margin-bottom: 25px;
        font-weight: bold;
    }

    .input {
        width: 100%;
        padding: 12px 15px;
        margin-top: 5px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        outline: none;
        transition: border-color 0.3s;
    }

    .input:focus {
        border-color: #ec407a;
    }

    .button {
        background-color: #ec407a;
        color: white;
        text-align: center;
        padding: 2px 0; 
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .button p {
    margin: 10px 0;
    font-size: 16px;
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

    .form_log_reg {
        position: relative;
    }

    #togglePassword {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 20px;
        color: #888;
    }
</style>

<!-- CONTENT -->
<div class="log_reg">
    <div class="box_log_reg">
        <center>
            <a href="<?php echo $url; ?>">
                <img src="../../assets/icons/<?php echo $logo; ?>" alt=""
                     style="height: 100px; width: 100px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc; padding: 5px;">
            </a>
        </center>
        <h1>Masuk Admin</h1>
        <div class="box_form_log_reg">
            <div class="form_log_reg">
                <p id="p_email"></p>
                <input type="text" placeholder="Email" class="input" id="email">
            </div>
            <div class="form_log_reg">
                <p id="p_password"></p>
                <input type="password" placeholder="Password" class="input" id="password" style="padding-right: 40px;">
                <i class="ri-eye-off-line" id="togglePassword"></i>
            </div>
        </div>
        <div id="masuk_button">
            <div class="button" id="masuk">
                <p>Masuk Sekarang</p>
            </div>
        </div>
        <div id="masuk_loading" style="display:none;">
            <div class="button">
                <img src="../../assets/icons/loading-w.svg" id="loading_masuk">
            </div>
        </div>
    </div>
</div>
<div class="res" id="res"></div>
<!-- CONTENT -->

<!-- JS -->
<script src="../../assets/js/admin/login/index.js"></script>
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    // Toggle icon mata
    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('ri-eye-line');
        this.classList.toggle('ri-eye-off-line');
    });

    // Enter key untuk login
    document.addEventListener('keydown', function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            document.getElementById("masuk").click();
        }
    });
</script>
<!-- JS -->

</body>
</html>
