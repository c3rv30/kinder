//Archivo para configuracion de conexion al servidor y validacion de usuario
<?php

class basededatos{
		private $usuario;
		private $clave;
		private $base;
		private $servidor;
		public 	$id_con;
		public	$id_bd;


		/*Declaracion de Variables con datos para la conexion*/
		function basededatos(){
			$this->usuario = "root";
			$this->clave = "";
			$this->base = "jardin2";
			$this->servidor = "localhost";
		}

		
		/*La siguiente funcion permite establecer conexion con el motor de base de datos MySQL*/
		public function conexion(){
			$this->id_con = mysql_connect($this->servidor, $this->usuario, $this->clave);
			if(!$this->id_con){ 
				die("Error en la conexion al motor de BD MySQL");
			}
			
			/*Selecciona la Base de datos especificada*/
			$this->id_bd = mysql_select_db($this->base, $this->id_con);
			if(!$this->id_bd){
				/*Envia mensaje si la seleccion de la base de datos es erronea*/
				die("Error al Seleccionar la BD  del Motor");
			}			
		}
		
		/*Funcion desconexion() que permite cerrar la conexion a la Base de Datos*/		
		function desconexion(){
			mysql_close($this->id_con);
		}


		/*Funcion validarusuario($log, $pas), permite verificar y validar 
		el usuario y contraseña en la base de datos para ingresar al sistema*/
		function validarusuario($log, $pas){
			//Sentencia SQL para la consulta del usuario ala base de datos
			$sentencia = "select * from usuarios where rut_usu='$log' and pass_usu='$pas'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			if($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){	//recorre el $rs 
				/*si encontro un usuario se creara la sesion y 
				se redirecciona a la pagina segun el rol del usuario*/
				session_start();
				$_SESSION['login'] = $rs['rut_usu'];
				$_SESSION['rol'] = $rs['rol_usu'];
				if($_SESSION["rol"] == "Administrador"){
					?>
               		  <script type="text/javascript">
    				  	location.href = "dashboard.php";
					  </script>
               		<?php
				} elseif($_SESSION["rol"] == "Educadora"){
					?>
               		  <script type="text/javascript">
    				  	location.href = "edu.php";
					  </script>
               		<?php
					
				}else{
					?>
               		  <script type="text/javascript">
    				  	location.href = "apo.php";
					  </script>
               		<?php
				}
			}else{
				/*se enviara a la pagina de logeo nuevamente*/				
				?>
               		<script type="text/javascript">
    				  location.href = "index.php?error=1";
					</script>
               	<?php
			}		
		}


?>