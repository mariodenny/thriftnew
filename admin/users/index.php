<?php
include '../../config.php';

$page_admin = 'user'; // This will likely be 'user_admin' or 'user_user' based on your menu.php,
                      // but 'user' as a general page_admin for this script is fine.

if (isset($_COOKIE['login_admin'])) {
    if ($akun_adm == 'false') {
        header("location: " . $url . "system/admin/logout");
    }
} else {
    header("location: " . $url . "admin/login/");
}

$tipe = isset($_GET['role']) ? $_GET['role'] : '';

// Adjust $page_admin based on the 'role' to ensure correct menu highlighting
if ($tipe === 'admin') {
    $page_admin = 'user_admin';
} elseif ($tipe === 'user') {
    $page_admin = 'user_user';
} else {
    // If no role is specified, or an unknown role, you might default to 'user_user' or a general 'user' page.
    // For this context, let's assume it should default to 'user_user' if no role is set.
    $page_admin = 'user_user';
}


$filter_query = ($tipe !== '') ? "WHERE tipe_akun = '$tipe'" : "";

$select_user_all_admin = $server->query("SELECT * FROM `akun` $filter_query ORDER BY `akun`.`id` DESC");
$total_user_all_admin = mysqli_num_rows($select_user_all_admin);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Akun User</title>
    <link rel="icon" href="../../assets/icons/<?php echo $logo; ?>" type="image/svg">
    <link rel="stylesheet" href="../../assets/css/admin/users/index.css">
</head>

<body>
    <div class="back_popup_confirm" id="confirm_hapus">
        <div class="popup_confirm">
            <div class="head_popup_confirm">
                <i class="ri-delete-bin-line"></i>
                <p>Hapus akun user</p>
            </div>
            <h5>Akun user yang sudah di hapus tidak dapat dipulihkan kembali, apakah anda yakin ingin manghapus akun user ini?</h5>
            <div class="box_button_popup_confirm">
                <div class="button_cancel_popup_confirm" id="hide_confirm_hapus" onclick="batal_hapus_akun()">
                    <p>Batal</p>
                </div>
                <div class="button_confirm_popup_confirm" onclick="hapus_akun()">
                    <p id="text_ha">Hapus</p>
                    <img src="../../assets/icons/loading-w.svg" id="loading_ha">
                </div>
            </div>
        </div>
        <input type="hidden" id="val_id_user">
    </div>
    <div class="box_edit_akun" id="box_edit_akun">
        <div class="edit_akun">
            <h1>Edit Akun User</h1>
            <div class="form_edit_akun">
                <div class="isi_form_edit_akun">
                    <p>Nama Lengkap</p>
                    <input type="text" class="input" id="nama_lengkap_edt" placeholder="nama lengkap...">
                </div>
                <div class="isi_form_edit_akun">
                    <p>Email</p>
                    <input type="text" class="input" id="email_edt" placeholder="email...">
                </div>
                <div class="isi_form_edit_akun">
                    <p>Nomor Whatsapp</p>
                    <input type="text" class="input" id="no_wa_edt" placeholder="nomor whatsapp...">
                </div>
                <div class="isi_form_edit_akun">
                    <p>Tipe Akun</p>
                    <select class="input" id="tipe_akun_edt">
                        <option value="user">User</option>
                        <option value="admin">Admin</option> </select>
                </div>
                <div class="isi_form_edit_akun">
                    <p>Password</p>
                    <input type="password" class="input" id="password_edit" placeholder="password baru">
                </div>
                <div class="isi_form_edit_akun">
                    <p>Foto Profil</p>
                    <input type="file" name="foto_profil" accept="image/*" class="input">
                    <small style="font-size: 12px; color: #666;">Hanya JPG, PNG. Maksimal 2MB.</small>
                </div>
            </div>
            <div class="box_button_edit_akun">
                <div class="button_cancel_edit_akun" onclick="batal_edit_iklan()">
                    <p>Batal</p>
                </div>
                <div class="button_confirm_edit_akun" onclick="simpan_edit_iklan()">
                    <p id="text_ea">Simpan</p>
                    <img src="../../assets/icons/loading-w.svg" id="loading_ea">
                </div>
            </div>
        </div>
        <input type="hidden" id="id_user_edit_akun">
    </div>
    <div class="admin">
        <?php include '../partials/menu.php'; ?>
        <div class="content_admin">
            <h1 class="title_content_admin">Akun
                <?php
                // Display "Admin" or "User" based on the 'role' GET parameter
                echo ($tipe === 'admin') ? 'Admin' : 'User';
                ?>
            </h1>
            <div class="isi_content_admin">
                <div class="jumlah_users_admin">
                    <h1>Jumlah
                        <?php
                        // Display "Admin" or "User" based on the 'role' GET parameter
                        echo ($tipe === 'admin') ? 'Admin' : 'User';
                        ?>
                    </h1>
                    <h1><?php echo $total_user_all_admin; ?>
                        <?php
                        // Display "User" always here, as it's a count of total filtered accounts
                        echo ($tipe === 'admin') ? 'Admin' : 'User';
                        ?>
                    </h1>
                </div>
                <div class="all_users_admin">
                    <?php while ($data_all_user_admin = mysqli_fetch_assoc($select_user_all_admin)) { ?>
                        <div class="isi_all_users_admin" id="isi_all_users_admin<?php echo $data_all_user_admin['id']; ?>">
                            <div class="box_left_aua">
                                <img src="../../assets/image/profile/<?php echo $data_all_user_admin['foto']; ?>">
                                <div class="isi_box_left_aua">
                                    <h5><?php echo $data_all_user_admin['nama_lengkap']; ?></h5>
                                    <p><?php echo $data_all_user_admin['email']; ?></p>
                                </div>
                            </div>
                            <div class="box_right_aua">
                                <div class="isi_box_right_aua">
                                    <h3>Nomor WA</h3>
                                    <p><?php echo $data_all_user_admin['no_whatsapp']; ?></p>
                                </div>
                                <div class="isi_box_right_aua">
                                    <h3>Tipe Daftar</h3>
                                    <p><?php echo $data_all_user_admin['tipe_daftar'] == '' ? 'Website' : $data_all_user_admin['tipe_daftar']; ?></p>
                                </div>
                                <div class="isi_box_right_aua">
                                    <h3>Tipe Akun</h3>
                                    <p><?php echo $data_all_user_admin['tipe_akun'] == '' ? 'User' : $data_all_user_admin['tipe_akun']; ?></p>
                                </div>
                                <div class="isi_box_right_aua">
                                    <h3>Waktu Daftar</h3>
                                    <p><?php echo $data_all_user_admin['waktu']; ?></p>
                                </div>
                            </div>
                            <div class="bu_edit_aua" onclick="show_edit_akun('<?php echo $data_all_user_admin['id']; ?>', '<?php echo $data_all_user_admin['nama_lengkap']; ?>', '<?php echo $data_all_user_admin['email']; ?>', '<?php echo $data_all_user_admin['no_whatsapp']; ?>', '<?php echo $data_all_user_admin['tipe_akun']; ?>')">
                                <i class="ri-pencil-line"></i>
                            </div>
                            <div class="bu_delete_aua" onclick="show_confirm_hapus('<?php echo $data_all_user_admin['id']; ?>')">
                                <i class="ri-delete-bin-line"></i>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                </div>
        </div>
    </div>
    <div id="res"></div>

    <script src="../../assets/js/admin/users/index.js"></script>
</body>

</html>