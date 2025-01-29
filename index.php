<?php
session_start();
if (isset($_SESSION['role'])) {
    header('Location: dashboard.php');
    exit;
}
header('Location: login.php');
exit;
?>