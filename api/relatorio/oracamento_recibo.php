<?php
include('mpdf60/mpdf.php');
include('../conect.php');

$id = $_POST['id'];
$id=98;
if (!empty($id)) {
    $objs = array();
    $result = $conn->query("SELECT tc.id AS id_comanda, tc.tipo, tc.obs, DATE_FORMAT(tc.data, '%d/%m/%Y') AS data, tc.situacao, tc.id_carro, cl.id AS id_cliente, cl.nome, cl.cpf_cnpj, cl.insc_estadual, cl.cel, cl.tel, cl.email FROM tab_comanda tc JOIN tab_carro ca ON ca.id = tc.id_carro JOIN tab_cliente cl ON cl.id = ca.id_cliente WHERE tc.id = '$id' ");
    while ($row = $result->fetch_assoc()) {
        array_push($objs, $row);
    }
    $res['dados'] = $objs;

    $objs2 = array();
    $result2 = $conn->query("SELECT SUM((ic.qtd*ic.vlr_unt)) as total_geral FROM tab_itens_comanda ic WHERE ic.id_comanda = '$id'");
    while ($row2 = $result2->fetch_assoc()) {
        array_push($objs2, $row2);
    }
    $total_geral['total_geral'] = $objs2;

    $objs3 = array();
    $result = $conn->query("SELECT ca.marca, ca.placa, ca.modelo, ca.obs FROM tab_comanda tc JOIN tab_carro ca on tc.id_carro = ca.id WHERE tc.id = '$id' ");
    while ($row = $result->fetch_assoc()) {
        array_push($objs3, $row);
    }
    $res['carros'] = $objs3;

    $objs4 = array();
    $result = $conn->query("SELECT en.cep, en.rua, en.numero, en.bairro, en.cidade, en.estado, en.tipo_endereco FROM tab_comanda tc JOIN tab_carro ca ON ca.id = tc.id_carro JOIN tab_cliente cl ON cl.id = ca.id_cliente JOIN tab_endereco en on en.id_cliente = cl.id WHERE tc.id = '$id' ");
    while ($row = $result->fetch_assoc()) {
        array_push($objs4, $row);
    }
    $res['enderecos'] = $objs4;

    $conexao = conexao::getInstance();
    $result = "SELECT ic.id, ic.qtd, ic.descricao_servico, ic.vlr_unt, (ic.qtd*ic.vlr_unt) as vlr_total, ic.id_comanda FROM tab_itens_comanda ic where ic.id_comanda = :id ";
    $stm = $conexao->prepare($result);
    $stm->bindValue(':id', $id);
    $stm->execute();
    $itemComandas = $stm->fetchAll(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        4x4
    </title>
    <link href="css/estilo.css" rel="stylesheet">
</head>

<body>
<div class='topo'>
    <h1>OFICINA 4X4 MONOBLOCO</h1>
    <h3 style='color: red;'>LEVE SEU CARRO A QUEM ENTENDE</h3>
    <h4 style='color: blue;'>ALINHAMENTO E BALANCEAMENTO, CASTER.<br>
        EIXOS DIANTEIROS, TRASEIROS, SUSPENSÃO.</h4>
    <h4 style='color: red;margin-top: 3pt;'>Seu carro está gastando pneus? Procure-nos</h4>
    <h6 style='color: blue;'>É NA RUA IRIA LOUREIRO, 206 - Fone: 3324-8418 - Centro - Campo Grande - MS<br>
        Facebook: quatroxquatromonobloco - e-mail: 4x4monobloco@gmail.com.br</h6>
</div>

<div class='cabecalho'>

    <table border='0' width='100%'>
        <tbody>
        <tr>
            <td style="text-align:left;"><input type='radio' checked='true'><b>  <?php echo $res['dados'][0]['tipo']; ?>  </b></td>
            <td style=\"text-align:right;\"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan='6' style="text-align:right;">Data de geração:
                <b><?php echo $res['dados'][0]['data']; ?></b> </td>
        </tr>
        <tr height='20px'>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan='4' style="text-align:left;">Nome: <b><?php echo $res['dados'][0]['nome']; ?></b> </td>
            <td></td>
            <td colspan='4' style="text-align:left;">Endereço: <b><?php echo $res['enderecos'][0]['rua']; ?></b> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan='4' style="text-align:left;">Fone: <b><?php echo $res['dados'][0]['tel'] ." / ". $res['dados'][0]['cel']; ?></b> </td>
            <td></td>
            <td colspan='6' style="text-align:left;">Bairro: <b><?php echo $res['enderecos'][0]['bairro']; ?></b> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan='4' style="text-align:left;">Cidade: <b><?php echo $res['enderecos'][0]['cidade']; ?></b> </td>
            <td></td>
            <td colspan='6' style="text-align:left;">Estado: <b><?php echo $res['enderecos'][0]['estado']; ?></b> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan='4' style="text-align:left;">CNPJ/CPF: <b><?php echo $res['dados'][0]['cpf_cnpj']; ?></b> </td>
            <td></td>
            <td colspan='6' style="text-align:left;">Insc. Est.: <b><?php echo $res['dados'][0]['insc_estadual']; ?></b> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan='4' style="text-align:left;">Marca: <b><?php echo $res['carros'][0]['marca']; ?></b> </td>
            <td></td>
            <td colspan='6' style="text-align:left;">Placa: <b><?php echo $res['carros'][0]['placa']; ?></b> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>

<div class='corpo'>
    <table border='1' width='100%'>
        <thead>
        <tr>
            <th>Qtd.</th>
            <th>Descrição dos Serviços</th>
            <th>P. Unitário</th>
            <th>PREÇO TOTAL POR ITEM</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
        </tr>
        </tfoot>
        <tbody>
        <?php foreach ($itemComandas as $item): ?>
        <tr>
            <td height='20px' style="vertical-align: bottom; font-size:16px"> <?php echo $item->qtd; ?> </td>
            <td height='20px' style="vertical-align: bottom; font-size:16px"> <?php echo $item->descricao_servico; ?> </td>
            <td height='20px' style="vertical-align: bottom; font-size:16px"> <?php echo 'R$ '. formataReal($item->vlr_unt); ?> </td>
            <td height='20px' style="vertical-align: bottom; font-size:16px"> <?php echo 'R$ '. formataReal($item->vlr_total); ?> </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
        </tr>
        <tr>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
        </tr>
        <tr>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
        </tr>
        <tr>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
        </tr>
        <tr>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
        </tr>
        <tr>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
        </tr>
        <tr>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
        </tr>
        <tr>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
        </tr>
        <tr>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
        </tr>
        <tr>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
            <td height='20px'></td>
        </tr>
        </tbody>
    </table>
</div>

<?php if($res['carros'][0]['obs'] != null){ ?>
    <div class='obs'>
        <table border='0' width='100%'>
            <tbody>
            <tr>
                <td width="10px" style="text-align:left;"><b>Obs:</b></td>
                <td style="text-align:left;"> <?php echo $res['carros'][0]['obs']; ?> </td>
            </tr>
            </tbody>
        </table>
    </div>
<?php } ?>

<div class='rodape'>
    <table border="0" width='100%'>
        <tr>
            <td height='25px' style="text-align:left; vertical-align: middle;">Condição de Pagto:</td>
            <td colspan=\"2\" height='25px' style="text-align:left; vertical-align: middle;">
                _____________________________________
            </td>
            <td></td>
            <td colspan=\"3\" rowspan=\"2\" style="text-align:left; text-align:center;">
                <b>TOTAL GERAL</b>
                <table width='100%' height='60%' border='1'>
                    <tr>
                        <td height='25px' style="text-align:right; vertical-align: bottom; font-size:26px
                        "><b> R$ <?php print(formataReal($total_geral['total_geral'][0]['total_geral'])) ?>  </b></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td height='25px' style="text-align:left;">Prazo de Entrega:</td>
            <td colspan=\"2\" height='25px' style="text-align:left;">_____________________________________</td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td height='20px' style="text-align:left; vertical-align: bottom;">Ass. do Cliente:</td>
            <td colspan=\"2\" height='20px' style="text-align:left; vertical-align: bottom;">
                _____________________________________
            </td>
            <td height='20px' style="text-align:left; vertical-align: bottom;">Ass. do Responsável:</td>
            <td colspan=\"2\" height='20px' style="text-align:left; vertical-align: bottom;">
                _____________________________________
            </td>
        </tr>
    </table>
</div>
</body>
</html>

<?php
function formataReal($vlr){
    return number_format($vlr, 2, ',', '.');
}
?>