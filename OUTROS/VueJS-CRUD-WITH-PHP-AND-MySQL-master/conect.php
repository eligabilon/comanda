<?php
/**
 * Created by PhpStorm.
 * User: gabilon
 * Date: 18/05/18
 * Time: 16:42
 */

//$host="localhost";
//$user="root";
//$pass="root";
//$db="db_careinhas_uce";

$host="localhost";
$user="root";
$pass="";
$db="db_careinhas_uce";

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8");
if ($conn->connect_error) {
    die("Falha ao estabelecer conexão");
}