<?php 
include('mpdf60/mpdf.php');
include ('../conect.php');

$id = $_POST['id'];

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

 $html = "<html>
				<head>
					<title>
						4x4
					</title>	
				</head>

				<body>
					<div class='topo'>
						<h1>OFICINA 4X4 MONOBLOCO</h1>
						<h3 style='color: red;'>LEVE SEU CARRO A QUEM ENTENDE</h3>
						<h4 style='color: blue;'>ALINHAMENTO E BALANCEAMENTO, CASTER.<br>
						EIXOS DIANTEIROS, TRASEIROS, SUSPENSÃO.</h4>
						<h4 style='color: red;margin-top: 3pt;'>Seu carro esta gastando pneus? Procure-nos</h4>
						<h6 style='color: blue;'>É NA RUA IRIA LOUREIRO, 206 - Fone: 3324-8418 - Centro - Campo Grande - MS<br>
						Facebook: quatroxquatromonobloco - e-mail: 4x4monobloco@uol.com.br</h6>
					</div>
					
					<div class='cabecalho'>

						<table border='0' width='100%' height='100%'>
							<tbody>
								<tr>
									<td style=\"text-align:right;\"><input type='radio' checked='true'><b> "; echo $tipo; $html.=" </b></td>
									<td style=\"text-align:right;\"></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td colspan='6' align=''>Data "; echo $dia ; $html.=" de "; echo $mes; $html.=" Campo Grande de "; echo $ano; $html.=".</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan='8'>Nome: "; echo $nome; $html.=" </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan='8'>Endereço: "; echo $rua; $html.=" </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>	
								<tr>
									<td colspan='4'>Bairro: "; echo $bairro; $html.=" </td>
									<td></td>
									<td colspan='6'>Fone: "; echo $telefone; $html.=" </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>	
								<tr>
									<td colspan='4'>Cidade: "; echo $cidade; $html.=" </td>
									<td></td>
									<td colspan='6'>Estado: "; echo $estado; $html.=" </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan='4'>CNPJ/CPF: "; echo $cpf_cpnj; $html.=" </td>
									<td></td>
									<td colspan='6'>Insc. Est.: "; echo $insc_estadual; $html.=" </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan='4'>Marca: "; echo $marca; $html.=" </td>
									<td></td>
									<td colspan='6'>Placa: "; echo $placa; $html.=" </td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>																	
							</tbody>
						</table>
					</div>
					
					<div class='corpo'>
						<table border='1' width='100%' height='100%'>
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
						<td height='20px'> "; echo $qtd; $html.=" </td>
						<td height='20px'> "; echo $descricao; $html.=" </td>
						<td height='20px'> "; echo $vlr_unitario; $html.=" </td>
						<td height='20px'> "; echo $vlr_total; $html.=" </td>
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
												<tr>
						<td height='20px'></td>
						<td height='20px'></td>
						<td height='20px'></td>
						<td height='20px'></td>
						</tr>
						</tbody>
						</table>
					</div>
					
					<div class='rodape'>
                      <table width='100%' height='100%'>
                          <tr>
                            <td height='25px' style=\"text-align:right;\">Condição de Pagto:</td>
                            <td colspan=\"2\" height='25px' style=\"text-align:left;\">_____________________________________</td>
                            <td colspan=\"3\" rowspan=\"2\" style=\"text-align:right;\">
                            <b>TOTAL GERAL</b>
                            <table width='40%' height='100%' border='1'>
                                <tr>
                                    <td height='25px' style=\"text-align:right; font-size:16px\"><b> "; echo $total_geral['total_geral']; $html.=" </b></td>
                                </tr>
                            </table>
                            </td>
                          </tr>
                          <tr>
                            <td height='25px' style=\"text-align:right;\">Prazo de Entrega:</td>
                            <td colspan=\"2\" height='25px' style=\"text-align:left;\">_____________________________________</td>
                          </tr>
                          <tr>
                            <td colspan=\"6\"></td>
                          </tr>
                          <tr>
                            <td height='20px' style=\"text-align:right;\">Ass. do Cliente:</td>
                            <td colspan=\"2\" height='20px' style=\"text-align:left;\">_____________________________________</td>
                            <td height='20px' style=\"text-align:right;\">Ass. do Responsável:</td>
                            <td colspan=\"2\" height='20px' style=\"text-align:left;\">_____________________________________</td>
                          </tr>
                        </table>
					</div>
				</body>
			</html>";

     $res['print'] = 'http://localhost:90/OFICINA-4X4/api/relatorio/impressao.php';

     $conn->close();
     header("Content-type: application/json");
     echo json_encode($res);

	 $mpdf=new mPDF();
	 $mpdf->SetDisplayMode('fullpage');
	 $css = file_get_contents('css/estilo.css');
	 $mpdf->WriteHTML($css,1);
	 $mpdf->WriteHTML($html);
	 $mpdf->Output('orcamento_recibo.pdf');

	 exit;
?>