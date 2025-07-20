<?php
include '../config.php';

if (!isset($_COOKIE['login'])) {
    header('location: ../login/');
    exit;
} elseif (!empty($profile['tipe_daftar'])) {
    // If user registered via social media, redirect to main edit page
    header('location: edit');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Password</title>
    <link rel="icon" href="../assets/icons/<?php echo $logo; ?>" type="image/svg">
    <link rel="stylesheet" href="../assets/css/profile/edit.css">
</head>

<body>
    <!-- HEADER -->
    <?php include '../partials/header.php' ?>
    <!-- HEADER -->

    <!-- CONTENT -->
    <div class="edit_profile">
        <div id="edit_password">
            <h1>Edit Password</h1>
            <div class="box_input_pro">
                <div class="isi_box_input_pro">
                    <p id="p_password_lama">Password Lama</p>
                    <input type="password" class="input" id="password_lama" placeholder="Masukan Password Lama" autocomplete="current-password">
                </div>
                <div class="isi_box_input_pro">
                    <p id="p_password_baru">Password Baru</p>
                    <input type="password" class="input" id="password_baru" placeholder="Masukan Password Baru" autocomplete="new-password">
                </div>
            </div>

            <!-- Buttons Container -->
            <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px;">
                <div class="button" id="bu_e_pro" onclick="simpan_edit_password()" style="background-color: #ec407a; cursor: pointer;">
                    <p>Simpan</p>
                </div>

                <div class="button" id="loading_e_pro" style="display: none; background-color: #ec407a;">
                    <img src="../assets/icons/loading-w.svg" alt="Loading...">
                </div>

                <div class="button" onclick="window.location.href='edit'" style="background-color: rgb(64, 138, 235); cursor: pointer;">
                    <p>Kembali</p>
                </div>
            </div>
        </div>

        <div class="edit_password_berhasil" id="edit_password_berhasil" style="display: none;">
            <i class="ri-shield-check-fill"></i>
            <h1>Berhasil Mengubah Password</h1>
            <div class="button" onclick="kembali_ke_edit()">
                <p>Kembali</p>
            </div>
        </div>
    </div>
    <div id="res"></div>
    <!-- CONTENT -->

    <!-- FOOTER -->
    <?php include '../partials/footer.php' ?>
    <!-- FOOTER -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function simpan_edit_password() {
            const oldPassInput = document.getElementById('password_lama');
            const newPassInput = document.getElementById('password_baru');
            const oldPassLabel = document.getElementById('p_password_lama');
            const newPassLabel = document.getElementById('p_password_baru');

            const oldPass = oldPassInput.value.trim();
            const newPass = newPassInput.value.trim();

            let valid = true;

            // Reset styles
            resetFieldStyle(oldPassInput, oldPassLabel, 'Password Lama');
            resetFieldStyle(newPassInput, newPassLabel, 'Password Baru');

            // Validate old password
            if (oldPass === '') {
                setFieldError(oldPassInput, oldPassLabel, 'Password Lama wajib diisi');
                valid = false;
            }

            // Validate new password
            if (newPass === '') {
                setFieldError(newPassInput, newPassLabel, 'Password Baru wajib diisi');
                valid = false;
            } else if (newPass.length < 6) {
                setFieldError(newPassInput, newPassLabel, 'Password minimal 6 karakter');
                valid = false;
            } else if (newPass === oldPass) {
                setFieldError(newPassInput, newPassLabel, 'Password baru harus berbeda');
                valid = false;
            }

            // Submit if valid
            if (valid) {
                // Show loading
                const saveBtn = document.getElementById('bu_e_pro');
                const loadingBtn = document.getElementById('loading_e_pro');

                saveBtn.style.display = 'none';
                loadingBtn.style.display = 'flex';

                // Prepare data
                const formData = new FormData();
                formData.append('password_lama', oldPass);
                formData.append('password_baru', newPass);

                // Send request
                const xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function() {
                    if (this.readyState === 4) {
                        // Hide loading
                        saveBtn.style.display = 'flex';
                        loadingBtn.style.display = 'none';

                        if (this.status === 200) {
                            try {
                                const response = JSON.parse(this.responseText);

                                if (response.success) {
                                    // Success - show success message
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.title || 'Berhasil!',
                                        text: response.message,
                                        showConfirmButton: true,
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            if (response.redirect) {
                                                window.location.href = response.redirect;
                                            } else {
                                                // Clear form
                                                oldPassInput.value = '';
                                                newPassInput.value = '';
                                                showSuccessMessage();
                                            }
                                        }
                                    });
                                } else {
                                    // Error from server
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.title || 'Gagal',
                                        text: response.message
                                    });

                                    // Highlight specific field if mentioned
                                    if (response.field) {
                                        const fieldInput = document.getElementById(response.field);
                                        const fieldLabel = document.getElementById('p_' + response.field);
                                        if (fieldInput && fieldLabel) {
                                            setFieldError(fieldInput, fieldLabel, response.message);
                                        }
                                    }
                                }
                            } catch (e) {
                                console.error('JSON Parse Error:', e);
                                console.error('Response:', this.responseText);

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Terjadi kesalahan saat memproses response'
                                });

                                // Show raw response for debugging
                                document.getElementById('res').innerHTML = this.responseText;
                            }
                        } else {
                            // Network error
                            Swal.fire({
                                icon: 'error',
                                title: 'Network Error',
                                text: 'Terjadi kesalahan jaringan: ' + this.status
                            });
                        }
                    }
                };

                xhr.open('POST', '../system/profile/edit-password.php', true);
                xhr.send(formData);
            }
        }

        function resetFieldStyle(input, label, defaultText) {
            label.style.color = '#959595';
            label.innerHTML = defaultText;
            input.style.border = '1px solid #e2e2e2';
        }

        function setFieldError(input, label, errorText) {
            label.style.color = '#EA2027';
            label.innerHTML = errorText;
            input.style.border = '1px solid #EA2027';
        }

        function showSuccessMessage() {
            const editForm = document.getElementById('edit_password');
            const successDiv = document.getElementById('edit_password_berhasil');

            if (editForm && successDiv) {
                editForm.style.display = 'none';
                successDiv.style.display = 'block';
            }
        }

        function kembali_ke_edit() {
            window.location.href = 'edit';
        }

        // Add Enter key support
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInputs = ['password_lama', 'password_baru'];

            passwordInputs.forEach(function(inputId) {
                const input = document.getElementById(inputId);
                if (input) {
                    input.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            simpan_edit_password();
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>