<?php
	session_start();
    $_SESSION = array(); 
    session_unset(); //vacia el contenido de las sesiones (todas).
	session_destroy(); //Destruye las sesiones (todas).    
	header("location:index.php");	
?>