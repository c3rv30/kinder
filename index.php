<?php
	/*El IF permite verificar si se presiono el boton para ingresar al sistema,
	Se crea una nueva conexion a la base de datos, y se envia los datos de ingreso 
	con la funcion validarusuario($_POST['txtlog'], $_POST['txtpas']); que permite 
	validar el usuario que ingresa al sistema, y por ultimo cierra la conexion a la BD*/
	if(isset($_POST['btning'])){
		require("claseBD.php");
		$c = new basededatos();
		$c->conexion();
		$c->validarusuario($_POST['txtlog'], $_POST['txtpas']);
		$c->desconexion();
	}
?>

<html>
	<head>
		<title>Pagina Login</title>
        <link href="css/style-login.css" type="text/css" rel="stylesheet">
        <link rel="icon" type="image/png" href="images/icon.png">
		<style>
			body{
				background:url(images/background.jpg);
			}
		</style>
	</head>
	<body>
    	<header>
    		<div id="cont_logo">
        		<div class="divlogo">
					<a href="index.php"><img src="images/logo.png" alt="Logo Jardin" class="logojardin"></a>
            	</div>
            </div>
		</header>		
		<section>        	            
			<div id="cont_form">
				<div id="cent-form">
					<form class="form-usu" action="index.php" method="post">
						<p>	<!--<label>Usuario</label></br>-->
                    		<input type="text" class="casilla" name="txtlog" placeholder="User" required>
                		</p>
                		<p>	<!--<label>Password</label></br>-->
                    		<input type="password" class="casilla" name="txtpas" placeholder="Password" required>
                		</p>
                		                			
                			
                			<div style="width:400px; margin-left:50px; height:20px; ">
                				<a href="rec_pass">Forgot Password?</a>
                				<input type="submit" class="boton" name="btning" value="Login">
                				
                			</div>
                		
					</form>
            		<?php
					/*IF que permite recibir la variable error mediante el metodo GET, verifica su valor y muestra el error 		correspondiente, error que corresponde al inicio de sesion erroneo*/
					if(isset($_GET['error'])){
						if($_GET['error']==1){
							echo  "<br/><div class='clean-red'><b>Ingresar Usuario y Clave correctos</b></div>" ;
						}
						if($_GET['error']==2){
							echo "<br/><div class='clean-red'><b>Iniciar Sesion para acceder al Sistema</b></div>" ;
						}
					}
					?>	
				</div>					
			</div>			
		</section>
        <footer>
			<label style="color:white;"><strong>POWERED </strong>by Kinder</label>
        </footer>
	</body>
</html>