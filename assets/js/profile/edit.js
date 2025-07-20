function click_file_img() {
    document.getElementById('cfile_img_pro').click();
}

function change_image(event) {
    const file = event.target.files[0];
    const fileType = file?.type;
    const validImageTypes = ['image/jpeg', 'image/png'];
    const maxSize = 1024 * 1024; // 1MB

    if (!file) return;

    if (!validImageTypes.includes(fileType)) {
        Swal.fire({
            icon: 'error',
            title: 'Format Tidak Didukung',
            text: 'Pastikan format foto JPG atau PNG.'
        });
        event.target.value = '';
        return;
    }

    if (file.size > maxSize) {
        Swal.fire({
            icon: 'error',
            title: 'Ukuran Terlalu Besar',
            text: 'Ukuran gambar maksimal 1MB.'
        });
        event.target.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('img_foto_pro').src = reader.result;
    };
    reader.readAsDataURL(file);
}

function simpan_edit_profile() {
    const namaInput = document.getElementById('nama_lengkap');
    const waInput = document.getElementById('no_wa');
    const fileInput = document.getElementById('cfile_img_pro');

    const nama = namaInput.value.trim();
    const wa = waInput.value.trim();
    const file = fileInput.files[0];
    const maxSize = 1024 * 1024;

    // Tidak ada perubahan
    if (nama === '' && wa === '' && !file) {
        Swal.fire({
            icon: 'warning',
            title: 'Tidak Ada Perubahan',
            text: 'Silakan isi minimal satu field atau upload foto.'
        });
        return;
    }

    // Validasi file ulang
    if (file && file.size > maxSize) {
        Swal.fire({
            icon: 'error',
            title: 'Ukuran Gambar Terlalu Besar',
            text: 'Ukuran gambar maksimal 1MB.'
        });
        return;
    }

    const data_edit_profile = new FormData();
    if (file) data_edit_profile.append('cfile_img_pro', file);
    if (nama) data_edit_profile.append('nama_lengkap', nama);
    if (wa) data_edit_profile.append('no_wa', wa);
    data_edit_profile.append('id', document.querySelector('input[name="id"]').value);

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            try {
                const response = JSON.parse(this.responseText);
                Swal.fire({
                    icon: response.status === 'success' ? 'success' : 'error',
                    title: response.title || 'Pemberitahuan',
                    text: response.message || ''
                }).then(() => {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                });
            } catch (e) {
                document.getElementById('res').innerHTML = this.responseText;
            }
        }
    };

    xhttp.open('POST', '../system/profile/edit.php', true);
    xhttp.send(data_edit_profile);
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
        xhttp.onreadystatechange = function () {
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