<?php 
	include('mpdf60/mpdf.php');

 $html = "
			<html>

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

						<table border='0px' width='100%' height='100%'>
							<tbody>
								<tr>
									<td></td>
									<td>ORÇAMENTO</td>
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
									<td></td>
									<td></td>
									<td colspan='6' align=''>Data______de______________________de 20_____.</td>
								</tr>
								<tr>
									<td colspan='6'>Nome:</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan='6'>Endereço:</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>	
								<tr>
									<td colspan='2'>Bairro:</td>
									<td colspan='2'>Fone:</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>	
								<tr>
									<td colspan='2'>Cidade:</td>
									<td colspan='2'>Estado:</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan='2'>CNPJ/CPF:</td>
									<td colspan='2'>Insc. Est.:</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan='2'>Marca:</td>
									<td colspan='2'>Placa:</td>
									<td></td>
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
                            <td colspan=\"3\" rowspan=\"2\"></td>
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

			</html>
		";

	 $mpdf=new mPDF(); 
	 $mpdf->SetDisplayMode('fullpage');
	 $css = file_get_contents('css/estilo.css');
	 $mpdf->WriteHTML($css,1);
	 $mpdf->WriteHTML($html);
	 $mpdf->Output();

	 exit;
?>