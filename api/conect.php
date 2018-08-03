<?php
/**
 * Created by PhpStorm.
 * User: gabilon
 * Date: 18/05/18
 * Time: 16:42
 */

$host="localhost";
$user="root";
$pass="root";
$db="bd_oficina_4x4";


$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8");
if ($conn->connect_error) {
    die("Falha ao estabelecer conexão");
}