<?php
$to = $email;
$subject = "Senha para acesso ao sistema 4x4 Monobloco";

$htmlContent = "
                                <html>
                                <head>
                                    <meta charset=\"utf-8\">
                                    <title>4x4</title>
                                </head>
                                <body>
                                    <h1>Sua senha é de uso pessoal, não repasse a ninguém!</h1>
                                    <table cellspacing='0' style='border: 2px dashed #FB4314; width: 300px; height: 200px;'>
                                        <tr style='background-color: #e0e0e0;'>
                                            <th>EMAIL:</th><td>";
$htmlContent .=                  $to;
$htmlContent .= "            </td>
                                        </tr>
                                        <tr>
                                            <th>SENHA:</th><td><b>";
$htmlContent .=                 $password;
$htmlContent .= "           </b></td>
                                        </tr>
                                    </table>";
$htmlContent .= "                    <br><br>";
$htmlContent .= "https://4x4monobloco.com.br/";
$htmlContent .= "                    <br><br>                                   
                                   <h3>E-mail automático. Não responda.</h3>
                                   <center><a href='https://4x4monobloco.com.br/'></a></center>
                                </body>
                                </html>";

// Seta o content-type no header para enviar HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Add header
$headers .= 'From: A-UCE<sender@4x4monobloco.com>' . "\r\n";

// echo "mail=$to - subject=$subject - password=$password - header=$headers";
//echo "<br><br><br> $htmlContent <br><br><br>";
// envio de email
if (mail($to, $subject, $htmlContent, $headers)):
    $error['reset_result'] = "<span class='label label-success'>*Uma nova senha foi enviada para o seu e-mail.</span>";
else:
    $error['reset_result'] = "<span class='label label-rose'>*Falha ao enviar nova senha. Tente mais tarde.</span>";
endif;

?>