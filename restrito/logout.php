<?php
    session_start();

    unset($_SESSION['id']);
    unset($_SESSION['email']);
    unset($_SESSION['nome']);
    unset($_SESSION['timeout']);

    $conexao = null;
    session_destroy();
    header("location:index.php");
?>