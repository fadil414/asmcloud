<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['msg']);
    header('Location: index.php');
} else {
    unset($_SESSION['msg']);
    header('Location: index.php');
}
?>
