<?php
session_start();

$currentTime = time() + 25200;
$expired = 3600;

if ($currentTime > $_SESSION['timeout']) {
    session_destroy();
    header("location:../index.php");
}

unset($_SESSION['timeout']);
$_SESSION['timeout'] = $currentTime + $expired;
?>