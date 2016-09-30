<?php 
$db_host="127.0.0.1";
$db_user="root";
$db_password="";
$db_name="bas_registro_academico";
$db_table_usuarios="usuarios";
$db_connection = mysql_connect($db_host, $db_user, $db_password);
$bd_seleccionada = mysql_select_db($db_name, $db_connection);

if (!$db_connection) {
	die('No se ha podido conectar a la base de datos');
}

$subs_usuario_name = utf8_decode($_POST['usuario']);
$subs_usuario_password = utf8_decode($_POST['password']);

$consulta = "SELECT * FROM ".$db_table_usuarios." WHERE usuario = '".$subs_usuario_name."' AND password = '".$subs_usuario_password."'";
$resultado=mysql_query($consulta, $db_connection);

if (!$resultado) {
	$mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
    $mensaje .= 'Consulta completa: ' . $consulta;
    die($mensaje);
}

if (mysql_num_rows($resultado)==0)
{
header('Location: Fail.html');
} else {	
header('Location: formularioRegistro.html');
}

mysql_close($db_connection);

		
?>