<?php
//include '../..//conexion.php';
//include '../../core/core.php';
//include '../../core/dao.php';

require_once("../../claseBD.php");
$c = new basededatos();
if(isset($_POST['config_auto'])){
	$dia = $_POST['dia']; 
	$hora = $_POST['hora']; 
	$c->conexion();
	$c->ConfigAuto($dia, $hora);
    $c->desconexion();
}

//UPDATE backup SET dia='domingo' WHERE manual='0000-00-00'

//$backup = new backup();
//$backup = $backup->instanceClass($_REQUEST);

$sentencia="UPDATE backup SET dia='$backup->dia',hora='$backup->hora' WHERE manual='0000-00-00'";
$id_ejecucion = mysql_query($sentencia, $id_con);

//$res = mysql_query($sql,$connection);



?>
		
<p align="center">Configuracion Guardada</p>
<p align="center"><a href="javascript:loadDivAjax('body','modules/Administracion/main.admin.php');closeModal();">Continuar</a></p>

<?php mysql_close($id_con); ?>