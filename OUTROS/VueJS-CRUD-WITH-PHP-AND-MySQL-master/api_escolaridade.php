<?php 

include('conect.php');

$res = array('error' => false);
$action = 'read';


if (isset($_GET['action'])) {
	$action = $_GET['action'];
}


if ($action == 'read') {
	$result = $conn->query("SELECT id, escolaridade FROM `tab_escolaridade`");
    $escolaridades = array();
	while ($row = $result->fetch_assoc()){
		array_push($escolaridades, $row);
	}
	$res['escolaridades'] = $escolaridades;
}

if ($action == 'count-escolaridade') {
    $escolaridade = $_POST['escolaridade'];
    if (!empty($escolaridade)) {
        $result = $conn->query("SELECT id FROM `tab_escolaridade` WHERE `escolaridade` = '$escolaridade'");
        $row = $result->fetch_row();

        if ($row >= 1) {
            $res['error'] = true;
            $res['message'] = "Já existe esta escolaridade cadastrada no banco!";
        } else {
            $res['error'] = false;
            $res['message'] = "";
        }
    }
}

if ($action == 'create') {
    $escolaridade = $_POST['escolaridade'];
    if (!empty($escolaridade) ) {
        $result = $conn->query("INSERT INTO `tab_escolaridade` (`escolaridade`) VALUES ('$escolaridade') ");
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
    $escolaridade = $_POST['escolaridade'];
    if (!empty($escolaridade) && !empty($id)) {
        $result = $conn->query("UPDATE `tab_escolaridade` SET `escolaridade` = '$escolaridade' WHERE `id` = '$id'");
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
        $result = $conn->query("DELETE FROM `tab_escolaridade` WHERE `id` = '$id'");
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