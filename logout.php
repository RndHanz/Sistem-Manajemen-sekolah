<?php
session_start();
session_unset();
session_destroy();

// Mengarahkan ke halaman utama dengan pesan status sukses logout
header("Location: index.php?status=logout_success");
exit();
?>