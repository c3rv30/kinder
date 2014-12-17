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
			
		
							/*-------------------------
								Funciones Insertar
							--------------------------*/
							
							
							
		function insertarSede($nomsede, $dirsede, $fonosede){
			$estado = 1;
			$sentencia = "insert into sede values('','$nomsede','$dirsede','$fonosede',$estado,'')";
			mysql_query($sentencia, $this->id_con);
		}

		
		function insertarNivel($nom){
			$sentencia = "insert into nivel values('','$nom')";
			mysql_query($sentencia, $this->id_con);
		}


		function consultarUsuario($rut, $nom, $fec, $dir, $fono, $rol, $pas, $sede, $nivel){
			$sentencia = "select * from usuarios where rut_usu='$rut'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);           
            if($sede == 'nulo' || $nivel == 'nulo'){
                $sede = 'NULL';
                $nivel = 'NULL';
                //echo "<br/><h3><b>PASO POR AQUI!!</h3></b>" ;               
            }
            if($nivel == 'nulo2'){
                $nivel = 'NULL';
                //echo "<br/>PASO POR AQUI!!<br/><br/>";
            }
			if($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
				echo "<br/><b class='php'>Usuario Ya Existe</b>" ;		
			}else{
				$estado = 1;
				$sentencia = "insert into usuarios values('$rut','$nom','$fec','$dir','$fono','$rol','$pas',$estado,$sede,$nivel)";
				mysql_query($sentencia, $this->id_con)or die('Error #10');
				echo "<div class='clean-green'><b>Usuario Registrado Con Exito</b></div>" ;
			}			
		}

		
		function consultarPago($rut , $jornada){
			$estado = 1;
			$sentencia = "select * from pagos where rut_nino='$rut'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			if($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
				echo "<br/><b class='php'>Pago Ya Existe</b>" ;		
			}else{
				$estado = 1;
				$nopag = "No Pagado";
				$sentencia = "insert into pagos values('','$rut','$jornada', '$nopag', '$nopag', '$nopag', '$nopag', $estado)";
				mysql_query($sentencia, $this->id_con);
				echo "<br/><b class='php2'>Pago Registrado Con Exito</b>" ;
			}			
		}

		function ConsultarEmpleado($rut, $fecing, $primnom, $secnom, $ape, $email, $genero, $fecnac, $sede, $posicion, $expcom){
			$estado = 1;
			$sentencia = "select * from emple_generales where rut_empleado='$rut'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			if($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
					echo "<br/><div class='advertencia'><b>Ya Existe Este Empleado</b></div>" ;
			}else{
				$sentencia = "insert into emple_generales values('$rut','$fecing','$primnom','$secnom','$ape','$email','$genero','$fecnac','$sede','$posicion','$expcom','$estado')";
				mysql_query($sentencia, $this->id_con);
				//echo "<br/><div class='exito'><b>Empleado Registrado Correctamente</b></div>" ;
			}
		}
		
		
		
							/*-------------------------
								Funciones Listar
							--------------------------*/
							
							

		function listarActivos($val){
			if($val == 'nofilter'){
				$sentencia = "select * from usuarios where est_usu='1' order by rut_usu asc";
			}else{
				$sentencia = "select * from usuarios where est_usu='1' and rol_usu='$val' order by rut_usu asc";
			}
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo '<table width="500" border="1" bgcolor="white" bordercolor	="black" style=" margin-left:180px;">';
				echo'</br>';
				echo '<caption><b><h2>Listado de Usuarios Activos</h2></b></caption>';
				echo '<tr>';
					echo '<th>Rut</th>';
					echo '<th>Nombre</th>';
					echo '<th>Rol</th>';
					echo '<th>Estado</th>';
					echo '<th>Sede</th>';
					echo '<th>Nivel</th>';
					//echo '<th>Eliminar</th>';
				echo '</tr>';
				$i = 0;
				while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
							if($rs['cod_sede'] == null && $rs['cod_nivel'] == null ) {
								$sede = 'No Aplica';
								$nivel = 'No Aplica';
							}elseif ($rs['cod_nivel'] == null && $rs['cod_sede'] != null) {
								$rs2 = mysql_query('select * from sede where cod_sede='.$rs['cod_sede'].'');
								$rw = mysql_fetch_array($rs2);
								$sede = $rw['nom_sede'];
								$nivel = 'No Aplica';
							}else{
								$rs2 = mysql_query('select * from sede where cod_sede='.$rs['cod_sede'].'');
								$rw = mysql_fetch_array($rs2);							
								$rs3 = mysql_query('select * from nivel where cod_nivel='.$rs['cod_nivel'].'');
								$rw2 = mysql_fetch_array($rs3);
								$sede = $rw['nom_sede'];
								$nivel = $rw2['nom_nivel'];
							}
?>																
					<tr class="fila_<?php echo $i%2 ;?> ">
<?php
						$rut = $rs['rut_usu'];
						echo "<td><a href='usuarios.php?rutedi=".$rut."'>".$rs['rut_usu']."</a></td>";
						echo '<td>' .$rs['nom_usu']. '</td>';
						echo '<td>' .$rs['rol_usu']. '</td>';
						$estado = "";
						if($rs["est_usu"] == 1){
							$estado = "Activo";
						}else{
							$estado = "Inactivo";
						}
						echo "<td> <a href='usuarios.php?rutina=".$rs['rut_usu']."'>".$estado."</a></td>";
						echo '<td>' .$sede. '</td>';
						echo '<td>' .$nivel. '</td>';
						//echo "<td> <a href='usuarios.php?rut=".$rs['rut_usu']."'>Pinche Aqui</a></td>";
					echo '</tr>';
					$i ++;					
				}
			echo '</table>';
			echo "$rut";
		}
		
		
		function listarInactivos($val){			
			if($val == 'nofilter'){
				$sentencia = "select * from usuarios where est_usu='0' order by rut_usu asc";
			}else{
				$sentencia = "select * from usuarios where est_usu='0' and rol_usu='$val' order by rut_usu asc";
			}		
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo '<table width="500" border="1" bgcolor="white" bordercolor	="black" style=" margin-left:180px; ">';
			echo'</br>';
				echo '<caption><b><h2>Listado de Usuarios Inactivos</h2></b></caption>';
				echo '<tr>';
					echo '<th>Rut</th>';
					echo '<th>Nombre</th>';
					echo '<th>Rol</th>';
					echo '<th>Estado</th>';
					echo '<th>Sede</th>';
					echo '<th>Nivel</th>';
					//echo '<th>Eliminar</th>';
				echo '</tr>';
				while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
							if ($rs['cod_sede'] == null && $rs['cod_nivel'] == null ) {
								$sede = 'No Aplica';
								$nivel = 'No Aplica';
							}elseif ($rs['cod_nivel'] == null && $rs['cod_sede'] != null) {
								$rs2 = mysql_query('select * from sede where cod_sede='.$rs['cod_sede'].'');
								$rw = mysql_fetch_array($rs2);
								$sede = $rw['nom_sede'];
								$nivel = 'No Aplica';
							}else{
								$rs2 = mysql_query('select * from sede where cod_sede='.$rs['cod_sede'].'');
								$rw = mysql_fetch_array($rs2);							
								$rs3 = mysql_query('select * from nivel where cod_nivel='.$rs['cod_nivel'].'');
								$rw2 = mysql_fetch_array($rs3);
								$sede = $rw['nom_sede'];
								$nivel = $rw2['nom_nivel'];
							}							
					echo '<tr>';
						echo "<td><a href='usuarios.php?rutedi=".$rs['rut_usu']."'>".$rs['rut_usu']."</a></td>";
						echo '<td>' .$rs['nom_usu']. '</td>';
						echo '<td>' .$rs['rol_usu']. '</td>';
						$estado = "";
						if($rs["est_usu"] == 1){
							$estado = "Activo";
						}else{
							$estado = "Inactivo";
						}
						echo "<td> <a href='usuarios.php?rutact=".$rs['rut_usu']."'>".$estado."</a></td>";
						echo '<td>' .$sede. '</td>';
						echo '<td>' .$nivel. '</td>';
						//echo "<td> <a href='usuarios.php?rut=".$rs['rut_usu']."'>Pinche Aqui</a></td>";
					echo '</tr>';					
				}//Cierre While
			echo '</table>';
		}//Cierre Funcion Listar


		function listarSedeActiva(){
			$sentencia = "select * from sede where estado='1'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo '<table id="gradient-style">';
				echo '<caption><b><h2>Sedes</h2></b></caption>';
				echo '<tr>';
					echo '<th scope="col">Codigo</th>';
					echo '<th scope="col">Nombre</th>';
					//echo '<th scope="col">Direccion</th>';
					//echo '<th scope="col">Telefono</th>';
					//echo '<th scope="col">Estado</th>';
					echo '<th scope="col">Directora</th>';
					echo '<th scope="col">Editar</th>';
					echo '<th scope="col">Inactivar</th>';
					//echo '<th scope="col">Eliminar</th>';					
				echo '</tr>';
				
				while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
					if($rs){
						echo '<tbody>';
						echo '<tr class="odd">';
						echo '<td>' .$rs['cod_sede']. '</td>';
						echo '<td>' .$rs['nom_sede']. '</td>';
						//echo '<td>' .$rs['dir_sede']. '</td>';
						//echo '<td>' .$rs['tel_sede']. '</td>';						
						/*$estado = "";
						if($rs["estado"] == 1){
							$estado = "Activo";
						}else{
							$estado = "Inactivo";
						}*/
						//echo "<td> <a href='jardin.php?anusede=".$rs['cod_sede']."'>".$estado."</a></td>";
						echo '<td>' .$rs['rut_empleado']. '</td>';
						//echo "<td><button id='btnEdi' value= class='boton'>Editar</button>";						
						echo "<td><a href='ediSede.php?edisede=".$rs['cod_sede']."'>Editar</a></td>";
						echo "<td><a href='sedeIna.php?inasede=".$rs['cod_sede']."'>Inactivar</a></td>";
						//echo "<td><a href='javascript:confirmacion(".$rs['cod_sede'].")'>Eliminar</a></td>";
						echo '</tr>';	
						echo '</tbody>';						
					}else{
						echo '<td>No hay Registros en la Base de Datos</td>';
					}									
				}
			echo '</table>';	
		}

		function listarSedeInactiva(){
			$sentencia = "select * from sede where estado='0'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo '<table id="gradient-style">';
				echo '<caption><b><h2>Sedes Inactivas</h2></b></caption>';
				echo '<tr>';
					echo '<th scope="col">Codigo</th>';
					echo '<th scope="col">Nombre</th>';
					//echo '<th scope="col">Direccion</th>';
					//echo '<th scope="col">Telefono</th>';
					//echo '<th scope="col">Estado</th>';
					echo '<th scope="col">Directora</th>';
					echo '<th scope="col">Editar</th>';
					echo '<th scope="col">Activar</th>';
					//echo '<th scope="col">Eliminar</th>';
				echo '</tr>';
				
				while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
					if($rs){
						echo '<tbody>';
						echo '<tr class="odd">';
						echo '<td>' .$rs['cod_sede']. '</td>';
						echo '<td>' .$rs['nom_sede']. '</td>';
						//echo '<td>' .$rs['dir_sede']. '</td>';
						//echo '<td>' .$rs['tel_sede']. '</td>';						
						/*$estado = "";
						if($rs["estado"] == 1){
							$estado = "Activo";
						}else{
							$estado = "Inactivo";
						}*/
						//echo "<td> <a href='jardin.php?anusede=".$rs['cod_sede']."'>".$estado."</a></td>";
						echo '<td>' .$rs['rut_empleado']. '</td>';
						//echo "<td><button id='btnEdi' value= class='boton'>Editar</button>";
						//echo "<td><button id='btnEli' class='boton'>Eliminar</button>";
						echo "<td><a href='ediSede.php?edisede=".$rs['cod_sede']."'>Editar</a></td>";						
						echo "<td><a href='sede.php?actsede=".$rs['cod_sede']."'>Activar</a></td>";
						//echo "<td><a href='javascript:confirmacion(".$rs['cod_sede'].")'>Eliminar</a></td>";
						echo '</tr>';	
						echo '</tbody>';						
					}else{
						echo '<td>No hay Registros en la Base de Datos</td>';
					}									
				}
			echo '</table>';	
		}
		

		
		function listarNiveles(){
			$sentencia = "select * from nivel where estado='1'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo '<table id="gradient-style">';
				echo '<caption><h2><b>Niveles Activos</b></h2></caption>';
				echo '<tr>';
					echo '<th scope="col">Codigo</th>';
					echo '<th scope="col">Nombre</th>';
					echo '<th scope="col">Editar</th>';
					echo '<th scope="col">Inactivar</th>';
					//echo '<th scope="col">Eliminar</th>';
					//echo '<th>Eliminar</th>';
				echo '</tr>';
				while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
					echo '<tr>';
						echo '<td>' .$rs['cod_nivel']. '</td>';
						echo '<td>' .$rs['nom_nivel']. '</td>';
						echo "<td><a href='edilevel.php?edilevel=".$rs['cod_nivel']."'>Editar</a></td>";
						echo "<td><a href='levelIna.php?inalevel=".$rs['cod_nivel']."'>Inactivar</a></td>";
						//echo "<td><a href='javascript:confirmacion(".$rs['cod_nivel'].")'>Eliminar</a></td>";
						//echo "<td> <a href='jardin.php?elinivel=".$rs['cod_nivel']."'>Pinche Aqui</a></td>";
					echo '</tr>';					
				}
			echo '</table>';	
		}


		function listarNivelesIna(){
			$sentencia = "select * from nivel where estado='0'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo '<table id="gradient-style">';
				echo '<caption><h2><b>Niveles Inactivos</b></h2></caption>';
				echo '<tr>';
					echo '<th scope="col">Codigo</th>';
					echo '<th scope="col">Nombre</th>';
					echo '<th scope="col">Editar</th>';
					echo '<th scope="col">Inactivar</th>';
					//echo '<th scope="col">Eliminar</th>';
					//echo '<th>Eliminar</th>';
				echo '</tr>';
				while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
					echo '<tr>';
						echo '<td>' .$rs['cod_nivel']. '</td>';
						echo '<td>' .$rs['nom_nivel']. '</td>';
						echo "<td><a href='edilevel.php?edilevel=".$rs['cod_nivel']."'>Editar</a></td>";
						echo "<td><a href='level.php?actlevel=".$rs['cod_nivel']."'>Activar</a></td>";
						//echo "<td><a href='javascript:confirmacion(".$rs['cod_nivel'].")'>Eliminar</a></td>";
						//echo "<td> <a href='jardin.php?elinivel=".$rs['cod_nivel']."'>Pinche Aqui</a></td>";
					echo '</tr>';					
				}
			echo '</table>';	
		}
		

		function listarEmpleadosActivos(){
			$sentencia = "select * from emple_generales where estado='1'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo '<table id="gradient-style">';
				echo '<caption><b><h2>Empleados</h2></b></caption>';
				echo '<tr>';
					echo '<th scope="col">Rut</th>';
					echo '<th scope="col">Nombre</th>';
					echo '<th scope="col">Apellidos</th>';
					echo '<th scope="col">Sede</th>';
					echo '<th scope="col">Posicion</th>';					
					echo '<th scope="col">Editar</th>';
					echo '<th scope="col">Inactivar</th>';
					//echo '<th scope="col">Eliminar</th>';
					//echo '<th>Eliminar</th>';
				echo '</tr>';
				
				while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
					$rs2 = mysql_query('select * from sede where cod_sede='.$rs['sede'].'');
					$rw = mysql_fetch_array($rs2);
					$sede = $rw['nom_sede'];
					if($rs != 0){
						echo '<tbody>';
						echo '<tr class="odd">';
						echo '<td>' .$rs['rut_empleado']. '</td>';
						echo '<td>' .$rs['prim_nom']. '</td>';
						echo '<td>' .$rs['apellidos']. '</td>';
						echo '<td>' .$sede. '</td>';
						echo '<td>' .$rs['posicion']. '</td>';
						//echo '<td>' .$rs['dir_sede']. '</td>';
						//echo '<td>' .$rs['tel_sede']. '</td>';						
						/*$estado = "";
						if($rs["estado"] == 1){
							$estado = "Activo";
						}else{
							$estado = "Inactivo";
						}*/
						//echo "<td> <a href='jardin.php?anusede=".$rs['cod_sede']."'>".$estado."</a></td>";
						//echo '<td>' .$rs['rut_empleado']. '</td>';
						//echo "<td><button id='btnEdi' value= class='boton'>Editar</button>";
						//echo "<td><button id='btnEli' class='boton'>Eliminar</button>";
						echo "<td><a href='ediEmple.php?ediemple=".$rs['rut_empleado']."'>Editar</a></td>";
						echo "<td><a href='emple.php?inaemple=".$rs['rut_empleado']."'>Inactivar</a></td>";
						//echo "<td><a onclick='eliSede()' href='sede.php?elisede=".$rs['cod_sede']."'>Eliminar</a></td>";
						//echo "<td><a href='javascript:confirmacion(".$rs['rut_empleado'].")'>Eliminar</a></td>";
						echo '</tr>';	
						echo '</tbody>';						
					}else{
						echo '<td>No hay Registros en la Base de Datos</td>';
					}									
				}
			echo '</table>';	
		}


		function listarEmpleadosInactivos(){
			$sentencia = "select * from emple_generales where estado='0'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo '<table id="gradient-style">';
				echo '<caption><b><h2>Empleados</h2></b></caption>';
				echo '<tr>';
					echo '<th scope="col">Rut</th>';
					echo '<th scope="col">Nombre</th>';
					echo '<th scope="col">Apellidos</th>';
					echo '<th scope="col">Sede</th>';
					echo '<th scope="col">Posicion</th>';					
					echo '<th scope="col">Editar</th>';
					echo '<th scope="col">Inactivar</th>';
					//echo '<th scope="col">Eliminar</th>';
					//echo '<th>Eliminar</th>';
				echo '</tr>';
				
				while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
					$rs2 = mysql_query('select * from sede where cod_sede='.$rs['sede'].'');
					$rw = mysql_fetch_array($rs2);
					$sede = $rw['nom_sede'];
					if($rs != 0){
						echo '<tbody>';
						echo '<tr class="odd">';
						echo '<td>' .$rs['rut_empleado']. '</td>';
						echo '<td>' .$rs['prim_nom']. '</td>';
						echo '<td>' .$rs['apellidos']. '</td>';
						echo '<td>' .$sede. '</td>';
						echo '<td>' .$rs['posicion']. '</td>';
						//echo '<td>' .$rs['dir_sede']. '</td>';
						//echo '<td>' .$rs['tel_sede']. '</td>';						
						/*$estado = "";
						if($rs["estado"] == 1){
							$estado = "Activo";
						}else{
							$estado = "Inactivo";
						}*/
						//echo "<td> <a href='jardin.php?anusede=".$rs['cod_sede']."'>".$estado."</a></td>";
						//echo '<td>' .$rs['rut_empleado']. '</td>';
						//echo "<td><button id='btnEdi' value= class='boton'>Editar</button>";
						//echo "<td><button id='btnEli' class='boton'>Eliminar</button>";
						echo "<td><a href='ediEmple.php?ediemple=".$rs['rut_empleado']."'>Editar</a></td>";
						//echo "<td><a onclick='eliSede()' href='sede.php?elisede=".$rs['cod_sede']."'>Eliminar</a></td>";
						//echo "<td><a href='javascript:confirmacion(".$rs['rut_empleado'].")'>Eliminar</a></td>";
						echo '</tr>';	
						echo '</tbody>';						
					}else{
						echo '<td>No hay Registros en la Base de Datos</td>';
					}									
				}
			echo '</table>';	
		}

		
		function listarSedeNivel(){
			$sentencia = "select * from sedenivel where";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo '<table id="gradient-style">';
				echo '<caption><h2><b>Niveles</b></h2></caption>';
				echo '<tr>';
					echo '<th scope="col">Codigo</th>';
					echo '<th scope="col">Sede</th>';
					echo '<th scope="col">Nivel</th>';
					echo '<th scope="col">Directora</th>';
					//echo '<th>Eliminar</th>';
				echo '</tr>';
				while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
					echo '<tr>';
						echo '<td>' .$rs['cod_nivel']. '</td>';
						echo '<td>' .$rs['nom_nivel']. '</td>';
						echo "<td><a href='edilevel.php?edilevel=".$rs['cod_nivel']."'>Editar</a></td>";
						echo "<td><a href='javascript:confirmacion(".$rs['cod_nivel'].")'>Eliminar</a></td>";
						//echo "<td> <a href='jardin.php?elinivel=".$rs['cod_nivel']."'>Pinche Aqui</a></td>";
					echo '</tr>';					
				}
			echo '</table>';	
		}

		function ListLevelSede($codsede){
			$sentencia = "select * from sedenivel where id_sede='$codsede'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo '<table id="gradient-style">';
				echo '<caption><b><h2>Sede/Nivel</h2></b></caption>';
				echo '<tr>';
					echo '<th scope="col">Codigo</th>';
					echo '<th scope="col">Nombre Sede</th>';
					echo '<th scope="col">Nivel Asignado</th>';
					echo '<th scope="col">Rut Educadora</th>';			
				echo '</tr>';				
				while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
					$rs2 = mysql_query('select * from sede where cod_sede='.$rs['id_sede'].'');
					$rw = mysql_fetch_array($rs2);
					$sede = $rw['nom_sede'];
					$rs3 = mysql_query('select * from nivel where cod_nivel='.$rs['id_nivel'].'');
					$rw2 = mysql_fetch_array($rs3);
					$nivel = $rw2['nom_nivel'];

					if($rs != 0){

						echo '<tbody>';
						echo '<tr class="odd">';
						echo '<td>' .$rs['id_sn']. '</td>';
						echo '<td>' .$sede. '</td>';
						echo '<td>' .$nivel. '</td>';
						echo '<td>' .$rs['rut_educadora']. '</td>';								
						//echo "<td><a href='ediEmple.php?ediemple=".$rs['rut_empleado']."'>Editar</a></td>";						
						//echo "<td><a href='javascript:confirmacion(".$rs['rut_empleado'].")'>Eliminar</a></td>";
						echo '</tr>';	
						echo '</tbody>';						
					}else{
						echo '<td>No hay Registros en la Base de Datos</td>';
					}									
				}
			echo '</table>';

		}
		
		
		
		
							/*------------------------------
								Funciones Anular y Activar
							-------------------------------*/
									
		

		function anularpago($rut){
			$sentencia = "UPDATE pagos SET estado=0 WHERE rut_nino='$rut'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
		}


		function activarpago($rut){
			$sentencia = "UPDATE pagos SET estado=1 WHERE rut_nino='$rut'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
		}
		

		function anularsede($sede){
			$sentencia = "UPDATE sede SET estado=0 WHERE cod_sede='$sede'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);				
		}
		

		function activarSede($sede){
			$sentencia = "UPDATE sede SET estado=1 WHERE cod_sede='$sede'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);				
		}

		
		function activarNivel($nivel){
			$sentencia = "UPDATE nivel SET estado=1 WHERE cod_nivel='$nivel'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
		}

		function anularLevel($nivel){
			$sentencia = "UPDATE nivel SET estado=0 WHERE cod_nivel='$nivel'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
		}


		function anularusu($rut){
			$sentencia = "UPDATE usuarios SET est_usu=0 WHERE rut_usu='$rut'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);        		
		}
		
		function activarusu($rut){
			$sentencia = "UPDATE usuarios SET est_usu=1 WHERE rut_usu='$rut'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);	  			
		}	
		
		
		
							/*---------------------------------
								Funciones Combobox Dinamicos
							----------------------------------*/
									
		
		

		function llenarcombosede(){
			$sentencia = "select * from sede where estado='1'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo "<select name='cbosede' id='cbosede' required>";			
				echo "<option value='0'>Seleccione </option>";
				while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){	//ciclo para llenar el combo dinamicamente					
					echo "<option value='".$rs['cod_sede']."'>".$rs['nom_sede']."</option>";
				}
			echo "</select>";
		}
		
		function llenarcombonivel(){
			$sentencia = "select * from nivel where estado='1'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo "<select name='cbonivel' id='cbonivel' required>";			
				echo "<option value='0'>Seleccione </option>";
				while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){	//ciclo para llenar el combo dinamicamente
					echo "<option value='".$rs['cod_nivel']."'>".$rs['nom_nivel']."</option>";
				}
			echo "</select>";
		}


		function llenarcombojornada(){
			$sentencia = "select * from tipopago where estado='1'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo "<select name='cbojornada'>";
				echo "<option value='0'>Seleccione</option>";
				while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){	//ciclo para llenar el combo dinamicamente
					echo "<option value='".$rs['cod_tipPago']."'>".$rs['jornada']."</option>";
				}
			echo "</select>";
		}

		function llenarcomboEducadora(){
			$sentencia = "select rut_empleado from emple_generales where posicion='Educadora'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo "<select name='cboedu'>";
				echo "<option value='0'>Seleccione</option>";
				while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){	//ciclo para llenar el combo dinamicamente
					echo "<option value='".$rs['rut_empleado']."'>".$rs['rut_empleado']."</option>";
				}
			echo "</select>";
		}
		
		
							/*-------------------------
								Funciones Editar
							--------------------------*/
										

		

		function editarSede($cod){
			$sentencia = "select * from sede where cod_sede='$cod'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);		
			echo '<form class="contact_form" name="contact_form" action="sede.php" method="post">';		
			while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
				echo '<ul>';
                    echo '<li>';
                        echo '<h2>Actualizar Sede</h2>';
                        echo '<span class="required_notification">* Denotes Required Field</span>';
                    echo '</li>';
                    	//Campo Oculto que contiene el codigo de la sede...
                        echo '<input type="hidden" name="txtcodsede" value="'.$rs['cod_sede'].'"/>';                   
                    echo '<li>';
                        echo '<label for="name">Nombre Sede:</label>';
                        echo '<input type="text" name="txtnomsede"  placeholder="Recreo" value="'.$rs['nom_sede'].'" required  />';
                    echo '</li>';
                    echo '<li>';
                    	$nomsede = $rs['dir_sede'];
                        echo '<label for="dir">Direccion:</label>';
                        echo '<input type="text" name="txtdirsede" value="'.$nomsede.'" placeholder="Av. Recreo #111" required />';
                    echo '</li>';
                    echo '<li>';
                        echo '<label for="fono">Fono:</label>';
                        echo '<input type="text" name="txtfonosede" value="'.$rs['tel_sede'].'" placeholder="1212121" />';                        
                    echo '</li>';                    
                    echo '<li>';
                        echo '<button value="Guardar" name="actualizar" class="boton" type="submit">Guardar</button>';
                    echo '</li>';    
			}
			echo '</ul>';
			echo '</form>';			
		}

		function actSede($codsede, $nomsede, $dirsede, $fonosede){
			$sentencia = "UPDATE sede set nom_sede='$nomsede', dir_sede='$dirsede', tel_sede='$fonosede' where cod_sede='$codsede'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
		}

		function editarLevel($cod){
			$sentencia = "select * from Nivel where cod_nivel='$cod'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);		
			echo '<form class="contact_form" name="contact_form" action="level.php" method="post">';		
			while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
				echo '<ul>';
                    echo '<li>';
                        echo '<h2>Actualizar Nivel</h2>';
                        echo '<span class="required_notification">* Denotes Required Field</span>';
                    echo '</li>';
                    	//Campo Oculto que contiene el codigo de la sede...
                        echo '<input type="hidden" name="txtcodlevel" value='.$rs['cod_nivel'].'/>';
                    	$nomlevel = $rs['nom_nivel'];
                    echo '<li>';
                        echo '<label for="name">Nombre Nivel:</label>';
                        echo '<input type="text" name="txtnomlevel"  placeholder="Recreo" value="'.$nomlevel.'" required  />';
                    echo '</li>';                   
                    echo '<li>';
                        echo '<button value="Guardar" name="actualizar" class="boton" type="submit">Guardar</button>';
                    echo '</li>'; 
                      
			}
			echo '</ul>';
			echo '</form>';		
		}


		function actLevel($codlevel, $nomlevel){
			$sentencia = "UPDATE nivel set nom_nivel='$nomlevel' where cod_nivel='$codlevel'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);	
		}


		function editarEmpleado($rut){
			$sentencia = "select * from emple_generales where rut_empleado='$rut'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);		
			echo '<form class="contact_form" name="contact_form" action="emple.php" method="post">';		
			while($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
				echo '<ul>';
                    echo '<li>';
                        echo '<h2>Actualizar Sede</h2>';
                        echo '<span class="required_notification">* Denotes Required Field</span>';
                    echo '</li>';
                    echo '<li>';
						echo '<label for="rut">Rut Empleado:</label>';                                        
                        echo '<input type="text" name="txtrutemple" value="'.$rs['rut_empleado'].'"/>';                   
                    echo '</li>';
                    echo '<li>';
                        //echo '<input type="text" name="txtnomemple"  placeholder="Juan" value="'.$rs['nom_sede'].'" required  />';
                        echo '<label for="dir">Fecha Ingreso:</label>';
                        echo '<input type="text" name="datepicker" id="datepicker" value="'.$rs['fec_ingreso'].'" readonly="readonly" size="12" />';
                    echo '</li>';
                    echo '<li>';                    	
                        echo '<label for="nomprim">Primer Nombre:</label>';
                        echo '<input type="text" name="txtprimnom" value="'.$rs['prim_nom'].'" placeholder="Juanito" required />';
                    echo '</li>';
                    echo '<li>';                    	
                        echo '<label for="nomsec">Segundo Nombre:</label>';
                        echo '<input type="text" name="txtsecnom" value="'.$rs['sec_nom'].'" placeholder="Juanito" required />';
                    echo '</li>';
                    echo '<li>';                    	
                        echo '<label for="apes">Apellidos:</label>';
                        echo '<input type="text" name="txtape" value="'.$rs['apellidos'].'" placeholder="Juanito" required />';
                    echo '</li>';
                    echo '<li>';                    	
                        echo '<label for="apes">Email:</label>';
                        echo '<input type="email" name="txtemail" value="'.$rs['email'].'" placeholder="mi@correo.com" required />';
                    echo '</li>';

                    echo '<li>';
                    	echo '<label for="genero">Genero:</label>';                        
                        echo '<input type="radio" name="sex" value="male" >Masculino<br>';
                        echo '<input type="radio" name="sex" value="female" checked="checked">Femenino';
                    echo '</li>';
                    echo '<li>';
                        //echo '<input type="text" name="txtnomemple"  placeholder="Juan" value="'.$rs['nom_sede'].'" required  />';
                        echo '<label for="dir">Fecha Nacimiento:</label>';
                        echo '<input type="text" name="datepickernac" id="datepickernac" value="'.$rs['fec_nac'].'" readonly="readonly" size="12" />';
                    echo '</li>';  
                    echo '<li>';
                        echo '<label for="sede">Sede:</label>';
                        $c = new basededatos();
                        $c->conexion();                        
                        $c->llenarcombosede(); 
                    echo '</li>';                     
                    echo '<li>'; 
                    	echo '<label for="posicion">Posicion:</label>';                    		
                        	echo '<select name="cbopuesto">';
                            	echo '<option value="0">Seleccione</option>';
                            	echo '<option value="Educadora">Educadora</option>';
                            	echo '<option value="Asistente">Asistente</option>';
                            	echo '<option value="Manipuladora">Manipuladora</option>';
                            	echo '<option value="Aseo">Aseo</option>';                                                              
                        	echo '</select>';
                    echo '</li>';
                    echo '<li>';                  
                        echo '<label for="dir">Experiencia:</label>';
                        echo '<textarea name="expcom" rows="4" cols="50"></textarea>';                    	
                    echo '</li>';
                    echo '<li>';
                        echo '<button value="Actualizar" name="actualizar" class="boton" type="submit">Guardar</button>';
                    echo '</li>';
			}
			echo '</ul>';
			echo '</form>';			
		}

		function actEmpleado($rut,$fecing,$prinom,$secnom,$ape,$email,$sex,$fecnac,$sede,$puesto,$exp){
			$sentencia = "UPDATE emple_generales set rut_empleado='$rut', fec_ingreso='$fecing', prim_nom='$prinom', sec_nom='$secnom', apellidos='$ape', email='$email', genero='$sex', fec_nac='$fecnac', sede='$sede', posicion='$puesto', exp_com='$exp' where rut_empleado='$rut'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo "Paso por aqui la wea penca!!!";
		}




							/*-------------------------
								Funciones Eliminar
							--------------------------*/



		function eliminarSede($codsede){
			$sentencia = "DELETE from sede where cod_sede='$codsede'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
		}
		
		function eliminaNivel($codlevel){
			$sentencia = "DELETE from nivel where cod_nivel='$codlevel'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);

		}
		
		
		function pagarMatri($rut){
			$sentencia = "UPDATE pagos SET matricula='Pagado' WHERE rut_nino='$rut'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);				
		}		


							/*---------------------------------
								Funcion Asignar Nivel a Sede
							-----------------------------------*/



		function AsigNivelSede($codsede, $codlevel){
			$sentencia = "select * from sedenivel where id_sede='$codsede' and id_nivel='$codlevel'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
				if($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
					echo "<br/><div class='advertencia' style='width:500px;'><b>La Sede Ya posee el Nivel Asignado, Intente Con Otro Nivel</b></div>" ;                    
				
				}else{					
					$sentencia = "insert into sedenivel values('',$codsede,$codlevel,'') ";
					$id_ejecucion = mysql_query($sentencia, $this->id_con);
					echo "<br/><div class='exito'><b>Nivel Asignado Con Exito</b></div>" ;                    
				}

				//($rs['id_sede'] == $codsede  && $rs['id_nivel'] == $codlevel )
		}


		function AsigNivelEdu($codedu, $codlevel){
			$sentencia ="select sede from emple_generales where rut_empleado='$codedu'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			$rs = mysql_fetch_array($id_ejecucion, $this->id_bd);
			$sede = $rs['sede'];
			
			$sentencia = "select * from sedenivel where rut_educadora='$codedu' and id_nivel='$codlevel' and id_sede='$sede'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
				if($rs = mysql_fetch_array($id_ejecucion, $this->id_bd)){
					echo "<br/><div class='advertencia' style='width:500px;'><b>La Educadora Ya posee el Nivel Asignado, Intente Con Otro Nivel</b></div>" ;				
					
				}else{		
					$sentencia = "UPDATE sedenivel SET rut_educadora='$codedu' where id_sede='$sede' and id_nivel='$codlevel'";
					$id_ejecucion = mysql_query($sentencia, $this->id_con);
					echo "HOLA CTM";
					echo "<br/><div class='exito'><b>Nivel Asignado Con Exito</b></div>" ;
					
					echo $codlevel;                    
				}
		}
	


		function ConfigAuto($dia, $hora){
			$sentencia="UPDATE backup SET dia='$dia',hora='$hora' WHERE manual='0000-00-00'";
			$id_ejecucion = mysql_query($sentencia, $this->id_con);
			echo "<br/><div class='exito' style='width:300px;'><b>Configuracion Guardada Con Exito</b></div>" ;
		}



	}//Cierre clase basededatos
?>
