<?php
include '../../config.php';

// Check if required POST data exists
if (!isset($_POST['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak ditemukan']);
    exit;
}

$id = mysqli_real_escape_string($server, $_POST['id']);
$nama = isset($_POST['nama_lengkap']) ? mysqli_real_escape_string($server, $_POST['nama_lengkap']) : '';
$no_wa = isset($_POST['no_wa']) ? mysqli_real_escape_string($server, $_POST['no_wa']) : '';

// File upload configuration
$ekstensi_diperbolehkan = ['png', 'jpg', 'jpeg', 'gif', 'jfif'];
$max_ukuran = 1024 * 1024; // 1MB
$folder_upload = '../../assets/image/profile/';

$update_foto = false;
$nama_foto_baru = '';

// Check if file is uploaded
if (isset($_FILES['cfile_img_pro']) && $_FILES['cfile_img_pro']['error'] === 0) {
    $foto = $_FILES['cfile_img_pro'];
    $filename = $foto['name'];
    $tmp_name = $foto['tmp_name'];
    $ukuran = $foto['size'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // Validate file extension
    if (!in_array($ext, $ekstensi_diperbolehkan)) {
        echo json_encode([
            'status' => 'error',
            'title' => 'Format Tidak Didukung',
            'message' => "Format file tidak diperbolehkan ($ext). Hanya: png, jpg, jpeg, gif, jfif."
        ]);
        exit;
    }

    // Validate file size
    if ($ukuran > $max_ukuran) {
        echo json_encode([
            'status' => 'error',
            'title' => 'Ukuran Terlalu Besar',
            'message' => 'Ukuran file terlalu besar. Maksimal 1MB.'
        ]);
        exit;
    }

    // Generate unique filename
    $nama_foto_baru = uniqid() . '.' . ($ext == 'jfif' ? 'jpg' : $ext);
    $upload_path = $folder_upload . $nama_foto_baru;

    // Try to upload file
    if (move_uploaded_file($tmp_name, $upload_path)) {
        $update_foto = true;
    } else {
        echo json_encode([
            'status' => 'error',
            'title' => 'Upload Gagal',
            'message' => 'Gagal mengupload file. Periksa permission folder.'
        ]);
        exit;
    }
}

// Prepare update query
$update_fields = [];
$update_values = [];

if (!empty($nama)) {
    $update_fields[] = "nama_lengkap = ?";
    $update_values[] = $nama;
}

if (!empty($no_wa)) {
    $update_fields[] = "no_whatsapp = ?";
    $update_values[] = $no_wa;
}

if ($update_foto) {
    $update_fields[] = "foto = ?";
    $update_values[] = $nama_foto_baru;
}

// Check if there's anything to update
if (empty($update_fields)) {
    echo json_encode([
        'status' => 'error',
        'title' => 'Tidak Ada Perubahan',
        'message' => 'Tidak ada data yang diubah.'
    ]);
    exit;
}

// Add ID to values array
$update_values[] = $id;

// Build and execute query
$sql = "UPDATE akun SET " . implode(', ', $update_fields) . " WHERE id = ?";
$stmt = $server->prepare($sql);

if ($stmt) {
    // Create type string for bind_param
    $types = str_repeat('s', count($update_values));
    $stmt->bind_param($types, ...$update_values);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'title' => 'Berhasil',
            'message' => 'Profile berhasil diupdate.',
            'redirect' => '../profile/user.php'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'title' => 'Database Error',
            'message' => 'Gagal update database: ' . $stmt->error
        ]);
    }
    $stmt->close();
} else {
    echo json_encode([
        'status' => 'error',
        'title' => 'Database Error',
        'message' => 'Gagal prepare statement: ' . $server->error
    ]);
}

$server->close();
