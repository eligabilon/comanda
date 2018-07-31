<?php

include('conect.php');
include('class/class-valida-cpf-cnpj.php');

$res = array('error' => false);
$action = 'read';


if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

$objs = array();

if ($action == 'read') {
    $result = $conn->query("SELECT cli.id as id_cliente, cli.nome, cli.tel, cli.cel, cli.cpf_cnpj, com.id, DATE_FORMAT(com.data,'%d/%m/%Y') as data, car.placa FROM tab_cliente AS cli LEFT JOIN tab_carro AS car ON cli.id = car.id_cliente LEFT JOIN tab_comanda AS com ON car.id = com.id_carro ORDER BY cli.id DESC limit 5 ");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['clientes'] = $objs;
}

if ($action == 'read') {

    $result1 = $conn->query("SELECT COUNT(id) FROM `tab_cliente`");
    $row1 = $result1->fetch_row();
    array_push($objs, $row1);
    $res['countsCi'] = $row1;

    $result2 = $conn->query("SELECT COUNT(id) FROM `tab_carro`");
    $row2 = $result2->fetch_row();
    array_push($objs, $row2);
    $res['countsCa'] = $row2;

    $result3 = $conn->query("SELECT COUNT(id) FROM `tab_comanda` where tipo = 'ORÇAMENTO'");
    $row3 = $result3->fetch_row();
    array_push($objs, $row3);
    $res['countsOr'] = $row3;

    $result4 = $conn->query("SELECT COUNT(id) FROM `tab_comanda` where tipo = 'RECIBO'");
    $row4 = $result4->fetch_row();
    array_push($objs, $row4);
    $res['countsRe'] = $row4;
}

if ($action == 'read-carros') {
    $result = $conn->query("SELECT cli.id as id_cliente, cli.nome, cli.cpf_cnpj, car.id as id_carro, car.placa, car.marca, car.modelo, car.obs FROM tab_cliente AS cli LEFT JOIN tab_carro AS car ON cli.id = car.id_cliente limit 5 ");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['carros'] = $objs;
}

if ($action == 'read-comanda') {
    $result = $conn->query("SELECT ci.nome, tc.id, tc.tipo, DATE_FORMAT(tc.data,'%d/%m/%Y') as data, tc.obs, tc.situacao, ic.qtd, ic.descricao_servico, sum(ic.vlr_unt) as vlr_unt, ic.id as id_item_comanda, ca.placa, ca.id as id_carro FROM tab_comanda tc left join tab_carro ca on ca.id = tc.id_carro left join tab_cliente ci on ca.id_cliente = ci.id left join tab_itens_comanda ic on ic.id_comanda = tc.id GROUP BY tc.id ORDER BY tc.id DESC limit 5 ");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['comandas'] = $objs;
}

if ($action == 'read-comanda-todos') {
    $result = $conn->query("SELECT ci.nome, tc.id, tc.tipo, DATE_FORMAT(tc.data,'%d/%m/%Y') as data, tc.obs, tc.situacao, ic.qtd, ic.descricao_servico, sum(ic.vlr_unt) as vlr_unt, ic.id as id_item_comanda, ca.placa, ca.id as id_carro FROM tab_comanda tc left join tab_carro ca on ca.id = tc.id_carro left join tab_cliente ci on ca.id_cliente = ci.id left join tab_itens_comanda ic on ic.id_comanda = tc.id GROUP BY tc.id ORDER BY tc.id DESC");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['comandas'] = $objs;
}

if ($action == 'read-comanda-aberta') {
    $result = $conn->query("SELECT ci.nome, tc.id, tc.tipo, DATE_FORMAT(tc.data,'%d/%m/%Y') as data, tc.obs, tc.situacao, ic.qtd, ic.descricao_servico, sum(ic.vlr_unt) as vlr_unt, ic.id as id_item_comanda, ca.placa, ca.id as id_carro FROM tab_comanda tc left join tab_carro ca on ca.id = tc.id_carro left join tab_cliente ci on ca.id_cliente = ci.id left join tab_itens_comanda ic on ic.id_comanda = tc.id where tc.situacao = 'ABERTA' GROUP BY tc.id ORDER BY tc.id DESC");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['comandas'] = $objs;
}

if ($action == 'read-comanda-fechada') {
    $result = $conn->query("SELECT ci.nome, tc.id, tc.tipo, DATE_FORMAT(tc.data,'%d/%m/%Y') as data, tc.obs, tc.situacao, ic.qtd, ic.descricao_servico, sum(ic.vlr_unt) as vlr_unt, ic.id as id_item_comanda, ca.placa, ca.id as id_carro FROM tab_comanda tc left join tab_carro ca on ca.id = tc.id_carro left join tab_cliente ci on ca.id_cliente = ci.id left join tab_itens_comanda ic on ic.id_comanda = tc.id where tc.situacao = 'FECHADA' GROUP BY tc.id ORDER BY tc.id DESC");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['comandas'] = $objs;
}

if ($action == 'read-cliente') {
    $result = $conn->query("SELECT cli.id as id_cliente, cli.nome, cli.tel, cli.cel, cli.cpf_cnpj, com.id, DATE_FORMAT(com.data,'%d/%m/%Y') as data, car.placa FROM tab_cliente AS cli LEFT JOIN tab_carro AS car ON cli.id = car.id_cliente LEFT JOIN tab_comanda AS com ON car.id = com.id_carro ORDER BY cli.id DESC ");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['clientes'] = $objs;
}

if ($action == 'read-carro-cliente') {
    $result = $conn->query("SELECT cli.id as id_cliente, cli.nome, cli.cpf_cnpj, car.id as id_carro, car.placa, car.marca, car.modelo, car.obs FROM tab_cliente AS cli LEFT JOIN tab_carro AS car ON cli.id = car.id_cliente ");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['carros'] = $objs;
}

if ($action == 'relatorio-comanda-full') {

}

if ($action == 'query-cliente-carro') {
    $termo = $_POST['termo'];

    $result = $conn->query("SELECT cli.id as id_cliente, cli.nome, cli.tel, cli.cel, cli.cpf_cnpj, car.id as id_carro, car.placa FROM tab_cliente AS cli LEFT JOIN tab_carro AS car ON cli.id = car.id_cliente where car.placa = '$termo' limit 1 ");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['clientes'] = $objs;
}

if ($action == 'query-cliente') {
    $termo = $_POST['termo'];

    $result = $conn->query("SELECT cli.id as id_cliente, cli.nome, cli.tel, cli.cel, cli.cpf_cnpj, com.id, DATE_FORMAT(com.data,'%d/%m/%Y') as data, car.placa FROM tab_cliente AS cli LEFT JOIN tab_carro AS car ON cli.id = car.id_cliente LEFT JOIN tab_comanda AS com ON car.id = com.id_carro where cli.id = '$termo' or cli.nome like '%$termo%' or cli.cpf_cnpj = '$termo' or cli.email like '%$termo%' or car.placa = '$termo' or com.id = '$termo' ORDER BY cli.id DESC limit 10 ");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['clientes'] = $objs;
}

if ($action == 'query-endereco') {
    $id = $_POST['id_cliente'];

    $result = $conn->query("SELECT te.id, te.cep, te.tipo_endereco, te.rua, te.numero, te.bairro, te.cidade, te.estado FROM tab_endereco te where te.id_cliente = '$id'");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['enderecos'] = $objs;
}

if ($action == 'query-carro') {
    $id = $_POST['id_cliente'];

    $result = $conn->query("SELECT ca.id, ca.placa, ca.marca, ca.modelo, ca.obs FROM tab_carro ca where ca.id_cliente = '$id'");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['carros'] = $objs;
}

if ($action == 'query-carro-cliente') {
    $termo = $_POST['termo'];

    $result = $conn->query("SELECT cli.id as id_cliente, cli.nome, cli.cpf_cnpj, car.id as id_carro, car.placa, car.marca, car.modelo, car.obs FROM tab_cliente AS cli LEFT JOIN tab_carro AS car ON cli.id = car.id_cliente where car.placa = '$termo' or cli.nome like '%$termo' or car.marca like '%$termo' or cli.cpf_cnpj = '$termo' limit 10 ");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['carros'] = $objs;
}

if ($action == 'query-comanda') {
    $id = $_POST['id_carro'];

    $result = $conn->query("SELECT tc.id, tc.tipo, tc.obs, DATE_FORMAT(tc.data,'%d/%m/%Y') as data, tc.situacao, tc.id_carro, ic.id as id_item_comanda, ic.qtd, ic.descricao_servico, ic.vlr_unt FROM tab_comanda tc join tab_itens_comanda ic on ic.id_comanda = tc.id where tc.id_carro = '$id' and tc.tipo = 'ABERTA'");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['comandas'] = $objs;
}

if ($action == 'query-comanda-item') {
    $id = $_POST['id_comanda'];

    $result = $conn->query("SELECT ic.id, ic.qtd, ic.descricao_servico, ic.vlr_unt, ic.id_comanda FROM tab_itens_comanda ic where ic.id_comanda = '$id'");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['itemComandas'] = $objs;

    $result2 = $conn->query("SELECT SUM((ic.qtd*ic.vlr_unt)) FROM tab_itens_comanda ic WHERE ic.id_comanda = '$id'");
    $row2 = $result2->fetch_row();
    array_push($objs, $row2);
    $res['totalGeral'] = $row2;
}

if ($action == 'query-comanda-todos') {
    $termo = $_POST['termo'];

    $result = $conn->query("SELECT ci.nome, tc.id, tc.tipo, DATE_FORMAT(tc.data,'%d/%m/%Y') as data, tc.obs, tc.situacao, ic.qtd, ic.descricao_servico, sum(ic.vlr_unt) as vlr_unt, ic.id as id_item_comanda, ca.placa FROM tab_comanda tc left join tab_carro ca on ca.id = tc.id_carro left join tab_cliente ci on ca.id_cliente = ci.id left join tab_itens_comanda ic on ic.id_comanda = tc.id where ci.nome like '%$termo' or tc.id = '$termo' or tc.tipo like '%$termo%' or ca.placa = '$termo' or data = '$termo' GROUP BY tc.id ");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['comandas'] = $objs;
}

if ($action == 'validar-cpfcnpj') {
    $cpf_cnpj = $_POST['cpf_cnpj'];

    $cpf_cnpj = new ValidaCPFCNPJ($cpf_cnpj);

    $formatado = $cpf_cnpj->formata();

    if ($formatado) {
        echo $formatado; // 71.569.042/0001-96
        $res['error'] = false;
    } else {
        $res['error'] = true;
        $res['message'] = "CPF ou CNPJ Inválido";
    }
}

if ($action == 'create-cliente') {
    $res['id'] = array();
    $nome = $_POST['nome'];
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $ins_estadual = $_POST['insc_estadual'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $cel = $_POST['cel'];
    if (!empty($nome)) {
        $result = $conn->query("INSERT INTO tab_cliente (nome, cpf_cnpj, insc_estadual, email, tel, cel, data_cadastro) VALUES ('$nome' , '$cpf_cnpj', '$ins_estadual', '$email', '$tel', '$cel', NOW()) ");
        if ($result) {
            array_push($objs, $conn->insert_id);
            $res['id'] = $objs;
            $res['message'] = "Registro inserido com sucesso...";
        } else {
            $res['error'] = true;
            $res['message'] = "Falha ao inserir registro!";
        }
    }
}

if ($action == 'create-carro') {
    $res['id'] = array();
    $marca = $_POST['marca'];
    $placa = $_POST['placa'];
    $modelo = $_POST['modelo'];
    $obs = $_POST['obs'];
    $id_cliente = $_POST['id_cliente'];
    if (!empty($placa) && !empty($id_cliente)) {
        $result = $conn->query("INSERT INTO tab_carro (marca, placa, modelo, obs, id_cliente) VALUES ('$marca' , '$placa', '$modelo', '$obs', '$id_cliente') ");
        array_push($objs, $conn->insert_id);
        $res['id'] = $objs;
        if (!$result) {
            $res['error'] = true;
            $res['message'] = "Falha ao inserir registro!";
        }
    }
}

if ($action == 'create-comanda') {
    $res['id'] = array();
    $tipo = $_POST['tipo'];
    $situacao = $_POST['situacao'];
    $obs = $_POST['obs'];
    $id_carro = $_POST['id_carro'];
    if (!empty($id_carro)) {
        $result = $conn->query("INSERT INTO tab_comanda (tipo, data, obs, situacao, id_carro) VALUES ('$tipo', NOW(), '$obs', '$situacao', '$id_carro') ");
        array_push($objs, $conn->insert_id);
        $res['id'] = $objs;
        if (!$result) {
            $res['error'] = true;
            $res['message'] = "Falha ao inserir registro!";
        }
    }
}

if ($action == 'create-comanda-item') {
    $res['id'] = array();
    $qtd = $_POST['qtd'];
    $descricao_servico = $_POST['descricao_servico'];
    $vlr_unt = $_POST['vlr_unt'];
    $id_comanda = $_POST['id_comanda'];
    if (!empty($qtd) && !empty($descricao_servico) && !empty($vlr_unt) && !empty($id_comanda)) {
        $result = $conn->query("INSERT INTO tab_itens_comanda (qtd, descricao_servico, vlr_unt, id_comanda) VALUES ('$qtd', '$descricao_servico', '$vlr_unt', '$id_comanda') ");
        array_push($objs, $conn->insert_id);
        $res['id'] = $objs;
        if (!$result) {
            $res['error'] = true;
            $res['message'] = "Falha ao inserir registro!";
        }
    }
}

if ($action == 'create-endereco') {
    $res['id'] = array();
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $tipo_endereco = $_POST['tipo_endereco'];
    $id_cliente = $_POST['id_cliente'];
    if (!empty($rua) && !empty($id_cliente)) {
        $result = $conn->query("INSERT INTO tab_endereco (cep, rua, numero, bairro, cidade, estado, tipo_endereco, id_cliente) VALUES ('$cep' , '$rua', '$numero', '$bairro', '$cidade', '$estado', '$tipo_endereco', '$id_cliente') ");
        array_push($objs, $conn->insert_id);
        $res['id'] = $objs;
        if (!$result) {
            $res['error'] = true;
            $res['message'] = "Falha ao inserir registro!";
        }
    }
}

if ($action == 'update-cliente') {
    $id = $_POST['id_cliente'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $ins_estadual = $_POST['insc_estadual'];
    $tel = $_POST['tel'];
    $cel = $_POST['cel'];
    if (!empty($id) && !empty($nome)) {
        $result = $conn->query("UPDATE tab_cliente SET nome = '$nome', cpf_cnpj = '$cpf_cnpj', insc_estadual = '$ins_estadual', email = '$email', tel = '$tel', cel = '$cel' WHERE id = '$id'");
        if ($result) {
            $res['message'] = "Registro alterado com sucesso...";
        } else {
            $res['error'] = true;
            $res['message'] = "Falha ao alterar registro!";
        }
    }
}

if ($action == 'update-carro') {
    $id = $_POST['id'];
    $marca = $_POST['marca'];
    $placa = $_POST['placa'];
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $modelo = $_POST['modelo'];
    $obs = $_POST['obs'];
    if (!empty($id) && !empty($placa)) {
        $result = $conn->query("UPDATE tab_carro SET marca = '$marca', placa = '$placa', modelo = '$modelo', obs = '$obs' WHERE id = '$id'");
        if ($result) {
            $res['message'] = "Registro alterado com sucesso...";
        } else {
            $res['error'] = true;
            $res['message'] = "Falha ao alterar registro!";
        }
    }
}

if ($action == 'update-endereco') {
    $id = $_POST['id'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $tipo_endereco = $_POST['tipo_endereco'];
    if (!empty($id) && !empty($rua)) {
        $result = $conn->query("UPDATE `tab_endereco` SET `cep` = '$cep', `rua` = '$rua', `numero` = '$numero', `bairro` = '$bairro', `cidade` = '$cidade', `estado` = '$estado', `tipo_endereco` = '$tipo_endereco' WHERE `id` = '$id'");
        if ($result) {
            $res['message'] = "Registro alterado com sucesso...";
        } else {
            $res['error'] = true;
            $res['message'] = "Falha ao alterar registro!";
        }
    }
}

if ($action == 'update-comanda') {
    $id = $_POST['id'];
    $tipo = $_POST['tipo'];
    $qtd = $_POST['qtd'];
    $descricao_servico = $_POST['descricao_servico'];
    $vlr_unt = $_POST['vlr_unt'];
    $data = $_POST['data'];
    $obs = $_POST['obs'];
    if (!empty($id) && !empty($qtd)) {
        $result = $conn->query("UPDATE `tab_comanda` SET `tipo` = '$tipo', `qtd` = '$qtd', `descricao_servico` = '$descricao_servico', `vlr_unt` = '$vlr_unt', `data` = '$data', `obs` = '$obs' WHERE `id` = '$id'");
        if ($result) {
            $res['message'] = "Registro alterado com sucesso...";
        } else {
            $res['error'] = true;
            $res['message'] = "Falha ao alterar registro!";
        }
    }
}

if ($action == 'update-comanda-item') {
    $id = $_POST['id'];
    $qtd = $_POST['qtd'];
    $descricao_servico = $_POST['descricao_servico'];
    $vlr_unt = $_POST['vlr_unt'];
    if (!empty($id) && !empty($qtd)) {
        $result = $conn->query("UPDATE `tab_itens_comanda` SET `qtd` = '$qtd', `descricao_servico` = '$descricao_servico', `vlr_unt` = '$vlr_unt' WHERE `id` = '$id'");
        if ($result) {
            $res['message'] = "Registro alterado com sucesso...";
        } else {
            $res['error'] = true;
            $res['message'] = "Falha ao alterar registro!";
        }
    }
}

if ($action == 'delete-comanda') {
    $id = $_POST['id'];
    if (!empty($id)) {
        $result = $conn->query("DELETE FROM `tab_comanda` WHERE `id` = '$id'");
        if ($result) {
            $res['message'] = "Registro foi deletado!";
        } else {
            $res['error'] = true;
            $res['message'] = "Falha ao deletar registro!";
        }
    }
}

if ($action == 'delete-comanda-item') {
    $id = $_POST['id'];
    if (!empty($id)) {
        $result = $conn->query("DELETE FROM `tab_itens_comanda` WHERE `id` = '$id'");
        if ($result) {
            $res['message'] = "Registro foi deletado!";
        } else {
            $res['error'] = true;
            $res['message'] = "Falha ao deletar registro!";
        }
    }
}

if ($action == 'delete-endereco') {
    $id = $_POST['id'];
    if (!empty($id)) {
        $result = $conn->query("DELETE FROM `tab_endereco` WHERE `id` = '$id'");
        if ($result) {
            $res['message'] = "Registro foi deletado!";
        } else {
            $res['error'] = true;
            $res['message'] = "Falha ao deletar registro!";
        }
    }
}

if ($action == 'delete-carro') {
    $id = $_POST['id'];
    if (!empty($id)) {
        $result = $conn->query("DELETE FROM `tab_carro` WHERE `id` = '$id'");
        if ($result) {
            $res['message'] = "Registro foi deletado!";
        } else {
            $res['error'] = true;
            $res['message'] = "Falha ao deletar registro!";
        }
    }
}

$conn->close();
header("Content-type: application/json");
echo json_encode($res);
die();

?>