<?php
include '../config.php';

if (!isset($_COOKIE['login'])) {
    header('location: ../login/');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="icon" href="../assets/icons/<?php echo $logo; ?>" type="image/svg">
    <link rel="stylesheet" href="../assets/css/profile/edit.css">
    <!--add sweet alert for confirm-->
</head>

<body>
    <!-- HEADER -->
    <?php include '../partials/header.php' ?>
    <!-- HEADER -->

    <!-- CONTENT -->
    <div class="edit_profile">
        <form method="post" action="<?= $url ?>system/profile/edit_profile.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $profile['id']; ?>">
            <h1>Edit Profile</h1>
            <div class="box_img_pro">
                <div class="change_img_pro" onclick="click_file_img()">
                    <i class="ri-pencil-fill"></i>
                </div>
                <img src="../assets/image/profile/<?php echo $profile['foto']; ?>" id="img_foto_pro">
                <input type="file" accept="image/*" class="cfile_img_pro" name="cfile_img_pro" id="cfile_img_pro" onchange="change_image(event)">
            </div>
            <p class="err_foto_pro" id="err_foto_pro">Pastikan format foto jpg/png</p>
            <div class="box_input_pro">
                <div class="isi_box_input_pro">
                    <p id="p_nama_lengkap">Nama Lengkap</p>
                    <input type="text" class="input" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $profile['nama_lengkap']; ?>">
                </div>
                <div class="isi_box_input_pro">
                    <p id="p_no_wa">Nomor WhatsApp</p>
                    <input type="text" class="input" id="no_wa" name="no_wa" placeholder="Nomor WhatsApp" value="<?php echo $profile['no_whatsapp']; ?>">
                </div>
            </div>
            <?php
            if ($profile['tipe_daftar'] == '') {
            ?>
                <a href="edit-password" class="tipe_daftar_biasa">Ubah Password</a>
            <?php
            } else {
            ?>
                <p class="tipe_daftar_social">Anda Mendaftar Dengan <?php echo $profile['tipe_daftar']; ?></p>
            <?php
            }
            ?>
            <div class="b_button_ep" style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; margin-right: -10px;">
                <!-- Tombol Simpan -->
                <button type="button" onclick="simpan_edit_profile()" class="button" style="padding: 5px 10px; background-color: #ec407a; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
                    Simpan
                </button>

                <!-- Tombol Kembali -->
                <button type="button" class="button" style="padding: 5px 10px; background-color: rgb(64, 138, 235); color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;" onclick="window.location.href='../profile/user.php';">
                    <i class="ri-arrow-left-line" style="font-size: 16px; margin-right: 5px;"></i>
                    Kembali
                </button>
            </div>
    </div>
    </form>
    </div>
    </div>
    <div id="res"></div>
    <!-- CONTENT -->

    <!-- FOOTER -->
    <?php include '../partials/footer.php' ?>
    <!-- FOOTER -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- JS -->
    <!-- <script src="../assets/js/profile/edit.js"></script> -->
    <!-- <script src="../assets/js/profile/edit.js"></script> -->
    <script>
        function click_file_img() {
            document.getElementById('cfile_img_pro').click();
        }

        function change_image(event) {
            const file = event.target.files[0];

            if (!file) return;

            const fileType = file.type;
            const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            const maxSize = 1024 * 1024; // 1MB

            // Validate file type
            if (!validImageTypes.includes(fileType)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Format Tidak Didukung',
                    text: 'Pastikan format foto JPG, PNG, atau GIF.'
                });
                event.target.value = '';
                return;
            }

            // Validate file size
            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ukuran Terlalu Besar',
                    text: 'Ukuran gambar maksimal 1MB.'
                });
                event.target.value = '';
                return;
            }

            // Preview image
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('img_foto_pro').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        function simpan_edit_profile() {
            const namaInput = document.getElementById('nama_lengkap');
            const waInput = document.getElementById('no_wa');
            const fileInput = document.getElementById('cfile_img_pro');
            const idInput = document.querySelector('input[name="id"]');

            const nama = namaInput.value.trim();
            const wa = waInput.value.trim();
            const file = fileInput.files[0];

            // Check if there are any changes
            if (!nama && !wa && !file) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Ada Perubahan',
                    text: 'Silakan isi minimal satu field atau upload foto.'
                });
                return;
            }

            // Show loading
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Create FormData
            const formData = new FormData();
            formData.append('id', idInput.value);

            if (nama) formData.append('nama_lengkap', nama);
            if (wa) formData.append('no_wa', wa);
            if (file) formData.append('cfile_img_pro', file);

            // Debug: Log FormData contents
            console.log('FormData contents:');
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            // Send request
            const xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (this.readyState === 4) {
                    Swal.close(); // Close loading dialog

                    if (this.status === 200) {
                        try {
                            const response = JSON.parse(this.responseText);

                            Swal.fire({
                                icon: response.status === 'success' ? 'success' : 'error',
                                title: response.title || 'Pemberitahuan',
                                text: response.message || 'Terjadi kesalahan'
                            }).then(() => {
                                if (response.status === 'success' && response.redirect) {
                                    window.location.href = response.redirect;
                                }
                            });
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
                        Swal.fire({
                            icon: 'error',
                            title: 'Network Error',
                            text: 'Terjadi kesalahan jaringan: ' + this.status
                        });
                    }
                }
            };

            xhr.open('POST', '../system/profile/edit_profile.php', true);
            xhr.send(formData);
        }

        function cek() {

            if (nama_lengkap.value == '') {
                p_nama_lengkap.style.color = '#EA2027';
                nama_lengkap.style.border = '1px solid #EA2027';
            } else {
                p_nama_lengkap.style.color = '#959595';
                nama_lengkap.style.border = '1px solid #e2e2e2';
            }
            if (no_wa.value == '') {
                p_no_wa.style.color = '#EA2027';
                no_wa.style.border = '1px solid #EA2027';
            } else {
                p_no_wa.style.color = '#959595';
                no_wa.style.border = '1px solid #e2e2e2';
            }

            if (nama_lengkap.value && no_wa.value) {

                var data_edit_profile = new FormData();
                data_edit_profile.append('cfile_img_pro', document.getElementById('cfile_img_pro').files[0]);
                data_edit_profile.append('nama_lengkap', document.getElementById('nama_lengkap').value);
                data_edit_profile.append('no_wa', document.getElementById('no_wa').value);
                alert(nama_lengkap.value)
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 1) {
                        bu_e_pro.style.display = 'none';
                        loading_e_pro.style.display = 'flex';
                    }
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById('res').innerHTML = this.responseText;
                        bu_e_pro.style.display = 'flex';
                        loading_e_pro.style.display = 'none';
                        var getscriptres = document.getElementsByTagName('script');
                        for (var i = 0; i < getscriptres.length - 0; i++) {
                            if (getscriptres[i + 0].text != null) eval(getscriptres[i + 0].text);
                        }
                    }
                }
                xhttp.open('POST', '../system/profile/edit.php', true);
                xhttp.send(data_edit_profile);
            }
        }
    </script>
    <!-- JS -->
</body>

</html>