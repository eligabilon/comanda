<?php 

include('conect.php');

$res = array('error' => false);
$action = 'read';


if (isset($_GET['action'])) {
	$action = $_GET['action'];
}


if ($action == 'read') {
	$result = $conn->query("SELECT * FROM `users`");
	$users = array();
	while ($row = $result->fetch_assoc()){
		array_push($users, $row);
	}
	$res['users'] = $users;
}

if ($action == 'count-email') {
    $email = $_POST['email'];
    if (!empty($email)) {
        $result = $conn->query("SELECT id FROM `users` WHERE `email` = '$email'");
        $row = $result->fetch_row();

        if ($row >= 1) {
            $res['error'] = true;
            $res['message'] = "Já existe este email cadastrado no banco!";
        } else {
            $res['error'] = false;
            $res['message'] = "";
        }
    }
}

if ($action == 'create') {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
    if (!empty($username) && !empty($email)) {
        $result = $conn->query("INSERT INTO `users` (`username`, `email`, `mobile`) VALUES ('$username', '$email', '$mobile') ");
        if ($result) {
            $res['message'] = "Registro inserido com sucesso...";
        } else {
            $res['error'] = true;
            $res['message'] = "Falha ao inserir registro!";
        }
    }
}

if ($action == 'update') {
	$id = $_POST['id'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
    if (!empty($username) && !empty($email)) {
        $result = $conn->query("UPDATE `users` SET `username` = '$username', `email` = '$email', `mobile` = '$mobile'WHERE `id` = '$id'");
        if ($result) {
            $res['message'] = "Registro alterado com sucesso...";
        } else {
            $res['error'] = true;
            $res['message'] = "Falha ao alterar registro!";
        }
    }
}


if ($action == 'delete') {
	$id = $_POST['id'];
    if (!empty($id)) {
        $result = $conn->query("DELETE FROM `users` WHERE `id` = '$id'");
        if ($result) {
            $res['message'] = "Registro foi deletado!";
        } else {
            $res['error'] = true;
            $res['message'] = "Falha ao deletar registro!";
        }
    }
}

$conn -> close();
header("Content-type: application/json");
echo json_encode($res);
die();

 ?>