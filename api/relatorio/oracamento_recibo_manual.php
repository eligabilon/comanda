<?php
include('mpdf60/mpdf.php');
include('../conect.php');

$id = $_POST['id'];
$id=85;
if (!empty($id)) {
    $objs = array();
    $result = $conn->query("SELECT tc.id AS id_comanda, tc.tipo, tc.obs, DATE_FORMAT(tc.data, '%d/%m/%Y') AS data, tc.situacao, tc.id_carro, ic.id AS id_item_comanda, ic.qtd, ic.descricao_servico, ic.vlr_unt, (ic.qtd*ic.vlr_unt) AS vlr_total, cl.id AS id_cliente, cl.nome, cl.cpf_cnpj, cl.insc_estadual, cl.cel, cl.tel, cl.email FROM tab_comanda tc JOIN tab_itens_comanda ic ON ic.id_comanda = tc.id JOIN tab_carro ca ON ca.id = tc.id_carro JOIN tab_cliente cl ON cl.id = ca.id_cliente WHERE ic.id_comanda = '$id' ");
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
            <td style="text-align:left;"><input type='radio' name="tipo" checked='true'><b>  ORÇAMENTO  </b></td>
            <td style=\"text-align:right;\"><input type='radio' name="tipo"><b>  RECIBO  </b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan='6' style="text-align:right;">Campo
                Grande <?php echo strftime('%d de %B de %Y', strtotime('today')); ?> </td>
        </tr>
        <tr>
            <td colspan='4' style="text-align:left;">Nome: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"> </td>
            <td></td>
            <td colspan='4' style="text-align:left;">Endereço: <input type="text"> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan='4' style="text-align:left;">Fone: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"> </td>
            <td></td>
            <td colspan='6' style="text-align:left;">Bairro: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan='4' style="text-align:left;">Cidade:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"> </td>
            <td></td>
            <td colspan='6' style="text-align:left;">Estado: &nbsp;&nbsp;&nbsp;&nbsp;<input type="text"> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan='4' style="text-align:left;">CNPJ/CPF: <input type="text"> </td>
            <td></td>
            <td colspan='6' style="text-align:left;">Insc. Est.: <input type="text"> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan='4' style="text-align:left;">Marca: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"> </td>
            <td></td>
            <td colspan='6' style="text-align:left;">Placa: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"> </td>
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
        <tr>
            <td height='20px'> <input type="text" size="2"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
        </tr>
        <tr>
            <td height='20px'> <input type="text" size="2"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
        </tr>
        <tr>
            <td height='20px'> <input type="text" size="2"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
        </tr>
        <tr>
            <td height='20px'> <input type="text" size="2"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
        </tr>
        <tr>
            <td height='20px'> <input type="text" size="2"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
        </tr>
        <tr>
            <td height='20px'> <input type="text" size="2"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
        </tr>
        <tr>
            <td height='20px'> <input type="text" size="2"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
        </tr>
        <tr>
            <td height='20px'> <input type="text" size="2"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
        </tr>
        <tr>
            <td height='20px'> <input type="text" size="2"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
        </tr>
        <tr>
            <td height='20px'> <input type="text" size="2"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
        </tr>
        <tr>
            <td height='20px'> <input type="text" size="2"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
        </tr>
        <tr>
            <td height='20px'> <input type="text" size="2"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
        </tr>
        <tr>
            <td height='20px'> <input type="text" size="2"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
        </tr>
        <tr>
            <td height='20px'> <input type="text" size="2"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
            <td height='20px'> <input type="text"> </td>
        </tr>
        </tbody>
    </table>
</div>

<div class='obs'>
    <table border='0' width='100%'>
        <tbody>
        <tr>
            <td style="text-align:left;"><b>Obs:</b></td>
            <td style="text-align:left;"> <textarea rows="3" cols="10" style="width: 681px; height: 36px;"></textarea> </td>
        </tr>
        </tbody>
    </table>
</div>

<div class='rodape'>
    <table border="0" width='100%'>
        <tr>
            <td height='25px' style="text-align:left; vertical-align: middle;">Condição de Pagto:</td>
            <td colspan=\"2\" height='25px' style="text-align:left; vertical-align: middle;">
                <input type="text">
            </td>
            <td></td>
            <td colspan=\"3\" rowspan=\"2\" style="text-align:left; text-align:center;">
                <b>TOTAL GERAL</b>
                <table width='100%' height='60%' border='1'>
                    <tr>
                        <td height='25px' style="text-align:right; vertical-align: bottom; font-size:26px
                        "><b> R$  </b></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td height='25px' style="text-align:left;">Prazo de Entrega:</td>
            <td colspan=\"2\" height='25px' style="text-align:left;"><input type="text"></td>
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