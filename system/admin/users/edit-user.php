<?php
include '../../../config.php';

$nama_lengkap_edt = mysqli_real_escape_string($server, $_POST['nama_lengkap_edt']);
$email_edt = mysqli_real_escape_string($server, $_POST['email_edt']);
$no_wa_edt = mysqli_real_escape_string($server, $_POST['no_wa_edt']);
$tipe_akun_edt = mysqli_real_escape_string($server, $_POST['tipe_akun_edt']);
$id_user_edit_akun = mysqli_real_escape_string($server, $_POST['id_user_edit_akun']);

$update_query = "UPDATE `akun` SET 
    `nama_lengkap`='$nama_lengkap_edt',
    `email`='$email_edt',
    `no_whatsapp`='$no_wa_edt',
    `tipe_akun`='$tipe_akun_edt'";

if (!empty($_POST['password_edit'])) {
    $password_hash = password_hash($_POST['password_edit'], PASSWORD_DEFAULT);
    $update_query .= ", `password` = '$password_hash'";
}

// Handle upload foto profil jika ada
if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] == 0) {
    $target_dir = "../../../assets/image/profile/";
    $file_name = "profile" . time() . "_" . basename($_FILES["foto_profil"]["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed = ['jpg', 'jpeg', 'png', 'webp'];
    if (in_array($imageFileType, $allowed)) {
        if (move_uploaded_file($_FILES["foto_profil"]["tmp_name"], $target_file)) {
            $relative_path = str_replace('../../../', '', $target_file);
            $update_query .= ", `foto` = '$file_name'";
        }
    }
}

$update_query .= " WHERE `id`='$id_user_edit_akun'";
$edit_akun = $server->query($update_query);

if ($edit_akun) {
?>
    <script>
        box_edit_akun.style.display = 'none';
        window.location.href = 'index.php';
    </script>
<?php
} else {
    echo "<p style='color:red;'>Gagal mengupdate akun</p>";
}
?>