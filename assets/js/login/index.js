masuk.onclick = function () {
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let p_email = document.getElementById("p_email");
    let p_password = document.getElementById("p_password");
    let masuk_button = document.getElementById("masuk_button");
    let masuk_loading = document.getElementById("masuk_loading");
    let res = document.getElementById("res");

    // Validasi input
    let cek_email = true;
    let cek_password = true;

    if (email.value.trim() === '') {
        email.style.borderColor = '#EA2027';
        p_email.style.display = 'block';
        p_email.innerText = 'Email masih kosong';
        cek_email = false;
    } else {
        email.style.borderColor = '#e2e2e2';
        p_email.style.display = 'none';
        p_email.innerText = '';
    }

    if (password.value.trim() === '') {
        password.style.borderColor = '#EA2027';
        p_password.style.display = 'block';
        p_password.innerText = 'Password masih kosong';
        cek_password = false;
    } else {
        password.style.borderColor = '#e2e2e2';
        p_password.style.display = 'none';
        p_password.innerText = '';
    }

    // Jika valid, kirim form
    if (cek_email && cek_password) {
        let data_login = new FormData();
        data_login.append("email", email.value);
        data_login.append("password", password.value);

        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 1) {
                masuk_button.style.display = 'none';
                masuk_loading.style.display = 'block';
            }

            if (this.readyState === 4 && this.status === 200) {
                masuk_button.style.display = 'block';
                masuk_loading.style.display = 'none';

                try {
                    let response = JSON.parse(this.responseText);

                    if (response.status === 'success') {
                        window.location.href = response.redirect;
                    } else if (response.status === 'error') {
                        if (response.field === 'email') {
                            email.style.borderColor = '#EA2027';
                            p_email.style.display = 'block';
                            p_email.innerText = response.message;
                        } else if (response.field === 'password') {
                            password.style.borderColor = '#EA2027';
                            p_password.style.display = 'block';
                            p_password.innerText = response.message;
                        }
                    }
                } catch (e) {
                    res.innerHTML = '<p style="color:red;">Terjadi kesalahan. Silakan coba lagi.</p>';
                    console.error("Parsing response error:", e);
                }
            }
        };

        xhttp.open("POST", "../system/login/login.php", true);
        xhttp.send(data_login);
    }
};
