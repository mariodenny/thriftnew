function simpan_edit_password() {
    const oldPass = password_lama.value.trim();
    const newPass = password_baru.value.trim();

    let valid = true;

    if (oldPass === '') {
        p_password_lama.style.color = '#EA2027';
        password_lama.style.border = '1px solid #EA2027';
        valid = false;
    } else {
        p_password_lama.style.color = '#959595';
        password_lama.style.border = '1px solid #e2e2e2';
    }

    if (newPass === '') {
        p_password_baru.style.color = '#EA2027';
        password_baru.style.border = '1px solid #EA2027';
        p_password_baru.innerHTML = 'Password Baru';
        valid = false;
    } else if (newPass.length < 6) {
        p_password_baru.style.color = '#EA2027';
        password_baru.style.border = '1px solid #EA2027';
        p_password_baru.innerHTML = 'Password Terlalu Pendek';
        valid = false;
    } else {
        p_password_baru.style.color = '#959595';
        password_baru.style.border = '1px solid #e2e2e2';
        p_password_baru.innerHTML = 'Password Baru';
    }

    // Submit jika valid
    if (valid) {
        const data = new FormData();
        data.append('password_lama', oldPass);
        data.append('password_baru', newPass);

        const xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.readyState === 1) {
                bu_e_pro.style.display = 'none';
                loading_e_pro.style.display = 'flex';
            }

            if (this.readyState === 4 && this.status === 200) {
                document.getElementById('res').innerHTML = this.responseText;
                bu_e_pro.style.display = 'flex';
                loading_e_pro.style.display = 'none';

                // Eksekusi skrip JS dari response (jika ada)
                const scripts = document.querySelectorAll('#res script');
                scripts.forEach(script => {
                    eval(script.textContent);
                });
            }
        };

        xhttp.open('POST', '../system/profile/edit-password.php', true);
        xhttp.send(data);
    }
}

function kembali_ke_edit() {
    window.location.href = 'edit';
}
