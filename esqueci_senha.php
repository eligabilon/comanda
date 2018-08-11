<?php
ob_start();
session_start();

include_once('api/conect.php');
include_once('api/functions.php');

if (isset($_POST['btnReset'])) {

    @$username = $_POST['email'];
    @$senha = $_POST['senha'];
    @$conf_senha = $_POST['conf_senha'];

    $function = new functions;

    $error = array();

    $data = array();

    $password = "";

    if (empty($username)) {
        $error['email'] = "<span class='label label-rose'>*Digite seu email.</span>";
    } else {
        $conexao = conexao::getInstance();
        $sql_queryS = "SELECT senha, email FROM tab_user4x4 WHERE email = :usuarioL";
        $stmtS = $conexao->prepare($sql_queryS);

        if ($stmtS) {
            $stmtS->bindValue(':usuarioL', $username);
            $stmtS->execute();
            $result = $stmtS->fetch(PDO::FETCH_OBJ);;
            @$data['senha'] = $result->password;
            @$data['email'] = $result->email;

            $num = $stmtS->rowCount();
        }

        if ($num == 1) {
            $email = $data['email'];
            $string = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $password = $function->get_random_string($string, 6);
            $encrypt_password = hash('sha256', $username . $password);

            $sql_query = "UPDATE tab_user4x4 SET senha = :passwordS WHERE email = :usuarioL";

            $conexao = conexao::getInstance();
            $stmt = $conexao->prepare($sql_query);

            if ($stmt) {
                $stmt->bindValue(':usuarioL', $username);
                $stmt->bindValue(':passwordS', $encrypt_password);

                $stmt->execute();
                $reset_result = $stmt;
            }
//            if ($reset_result) {
//                include("api/email-senha.php");
//            }
        } else {
            $error['reset_result'] = "*Email não encontrado na base de dados.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - 4x4</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/pages/signin.css" rel="stylesheet" type="text/css">

</head>

<body>

<div class="navbar navbar-fixed-top">

    <div class="navbar-inner">

        <div class="container">

            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <a class="brand" href="index.php">
                Sistema 4x4 Monobloco
            </a>

        </div> <!-- /container -->

    </div> <!-- /navbar-inner -->

</div> <!-- /navbar -->

<div class="account-container">
    <div class="content clearfix">

        <?php if (isset($error['reset_result'])) { ?>
            <div class="alert-error">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php echo isset($error['reset_result']) ? $error['reset_result'] : ''; ?></strong>
            </div>
        <?php } ?>

        <?php if (@$password != "") { ?>
            <div class='alert-success'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong><h2>Sua senha: <b><font color="red"><?php echo $password; ?></font></b> </h2></strong>
            </div>
        <?php } ?>

        <form method="post">

            <h1>Esqueci a senha</h1>

            <div class="login-fields">
                <p></p>

                <div class="field">
                    <label for="username">Email</label>
                    <input type="email" id="username" name="email" value="" placeholder="Email do Usuário"
                           class="login username-field" required/>
                </div> <!-- /field -->

            </div> <!-- /login-fields -->

            <div class="login-actions">
                <span class="login-checkbox">
                    <a href="index.php"><label class="choice" for="Field">Voltar</label></a>
				</span>
                <button class="button btn btn-success btn-large" name="btnReset">Enviar Senha</button>
            </div> <!-- .actions -->
        </form>
    </div> <!-- /content -->
</div> <!-- /account-container -->


<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>

<script src="js/signin.js"></script>

</body>

</html>
