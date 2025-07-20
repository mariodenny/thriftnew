<?php
include '../../config.php';

// Disable error display and set JSON header
ini_set('display_errors', 0);
header('Content-Type: application/json');

try {
    // Since you already have $profile from config.php, use that
    if (!isset($profile) || !isset($profile['id'])) {
        echo json_encode([
            'success' => false,
            'title' => 'Authentication Error',
            'message' => 'User tidak terautentikasi. Silakan login ulang.'
        ]);
        exit;
    }

    $iduser = $profile['id'];

    // Validate input
    $password_lama = isset($_POST['password_lama']) ? trim($_POST['password_lama']) : '';
    $password_baru = isset($_POST['password_baru']) ? trim($_POST['password_baru']) : '';

    if (empty($password_lama)) {
        echo json_encode([
            'success' => false,
            'title' => 'Validasi Error',
            'message' => 'Password lama wajib diisi.',
            'field' => 'password_lama'
        ]);
        exit;
    }

    if (empty($password_baru)) {
        echo json_encode([
            'success' => false,
            'title' => 'Validasi Error',
            'message' => 'Password baru wajib diisi.',
            'field' => 'password_baru'
        ]);
        exit;
    }

    if (strlen($password_baru) < 6) {
        echo json_encode([
            'success' => false,
            'title' => 'Validasi Error',
            'message' => 'Password baru minimal 6 karakter.',
            'field' => 'password_baru'
        ]);
        exit;
    }

    // Get current password using mysqli_query (simpler approach)
    $iduser = mysqli_real_escape_string($server, $iduser);
    $query = "SELECT password FROM akun WHERE id = '$iduser'";
    $result = mysqli_query($server, $query);

    if (!$result) {
        throw new Exception("Query failed: " . mysqli_error($server));
    }

    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        echo json_encode([
            'success' => false,
            'title' => 'Database Error',
            'message' => 'Akun tidak ditemukan.'
        ]);
        exit;
    }

    // Verify old password
    if (!password_verify($password_lama, $user['password'])) {
        echo json_encode([
            'success' => false,
            'title' => 'Password Salah',
            'message' => 'Password lama yang Anda masukkan salah.',
            'field' => 'password_lama'
        ]);
        exit;
    }

    // Check if new password is same as old password
    if (password_verify($password_baru, $user['password'])) {
        echo json_encode([
            'success' => false,
            'title' => 'Password Sama',
            'message' => 'Password baru tidak boleh sama dengan password lama.',
            'field' => 'password_baru'
        ]);
        exit;
    }

    // Hash new password and update
    $password_baru_hash = password_hash($password_baru, PASSWORD_DEFAULT);
    $password_baru_hash = mysqli_real_escape_string($server, $password_baru_hash);

    $update_query = "UPDATE akun SET password = '$password_baru_hash' WHERE id = '$iduser'";
    $update_result = mysqli_query($server, $update_query);

    if ($update_result && mysqli_affected_rows($server) > 0) {
        echo json_encode([
            'success' => true,
            'title' => 'Berhasil!',
            'message' => 'Password berhasil diubah.',
            'redirect' => 'edit'
        ]);
    } else {
        throw new Exception("Update failed: " . mysqli_error($server));
    }
} catch (Exception $e) {
    // Log error for debugging
    error_log("Password change error: " . $e->getMessage());

    echo json_encode([
        'success' => false,
        'title' => 'System Error',
        'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.',
        'debug_info' => $e->getMessage() // Remove this line in production
    ]);
} finally {
    if (isset($server)) {
        mysqli_close($server);
    }
}
