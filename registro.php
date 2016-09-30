<?php
$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="bas_registro_academico";
$db_table_name_registro_academico="registro_academico";
$db_connection = mysql_connect($db_host, $db_user, $db_password);
$bd_seleccionada = mysql_select_db($db_name, $db_connection);

if (!$db_connection) {
	die('No se ha podido conectar a la base de datos');
}


$subs_sede = utf8_decode($_POST['sede']);
$subs_programa = utf8_decode($_POST['programa']);
$subs_semestre = utf8_decode($_POST['semestre']);
$subs_materia = utf8_decode($_POST['materia']);
$subs_fecha = utf8_decode($_POST['fecha']);
$subs_hora_ini = utf8_decode($_POST['hora_ini']);
$subs_hora_fin = utf8_decode($_POST['hora_fin']);

$consulta = "SELECT * FROM ".$db_table_name_registro_academico." WHERE sede
 = '".$subs_sede."'", $db_connection;

$resultado=mysql_query($consulta);
 
 if (!$resultado) {
	$mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
    $mensaje .= 'Consulta completa: ' . $consulta;
    die($mensaje);
}

if (mysql_num_rows($resultado)==0)
{

header('Location: Fail.html');

} else {
	
	$insert_value = 'INSERT INTO `' . $db_name . '`.`'.$db_table_name_registro_academico.'` (`sede` , `programa_academico` , `semestre` , `materia` , `fecha` , `hora_inicial` , `hora_final`  ) VALUES ("' . $subs_sede . '", "' . $subs_programa . '", "' . $subs_semestre . '", "' . $subs_materia . '", "' . $subs_fecha . '", "' . $subs_hora_ini . '", "' . $subs_hora_fin . '")';

mysql_select_db($db_name, $db_connection);
$retry_value = mysql_query($insert_value, $db_connection);

if (!$retry_value) {
   die('Error: ' . mysql_error());
}
	
header('Location: Success.html');

}

mysql_close($db_connection);

		
?>