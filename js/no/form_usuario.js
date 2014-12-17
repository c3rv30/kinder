// JavaScript Document
var x;
x = $(document);
x.ready(inicializarEventos);

function inicializarEventos(){
	var x, y, z, p, q;
	x = $("#registrar");		
	x.click(cargarFormulario);
	
	y = $("#registrarsede");
	y.click(cargarFormulario2);
	
	z = $("#registrarnivel");
	z.click(cargarFormulario3);
	
	p = $("#editarsede");
	p.click(cargarFormulario4);
	
	q = $("#editarnivel");
	q.click(cargarFormulario5);
}

/*function cargarFormulario(){
	var x;
	x = $("#formulario");
	x.html('<form action="usuarios.php" method="post"><table width="400"><tr><td><label>Rut* : </label></td><td><input type="text" name="txtrut" required=""></td></tr><tr><td><label>Cargo : </label></td><td><select name="cbocargo" required=""><option>Selecione Cargo</option><option value="Administrador">Administrador</option><option value="Educadora">Educadora</option><option value="Apoderado">Apoderado</option></select></td></tr><tr><td><label>Contraseña : </label></td><td><input type="password" name="txtclave" required=""></td></tr><th colspan="2"><td><input type="submit" name="reg" value="Registrar" style="width:80px; height:25px;"></td></th</table></form>');
}*/


/*function cargarFormulario(){
	var x;
	x = $("#formulario");
	x.html('<form action="usuarios2.php" method="post"><table width="400" border="1"><tr><td><label>Rut* </label></td><td><input type="text" name="txtrut" required="" autofocus="autofocus" placeholder="12.345.678-0" maxlength="12" size="12px"></td></tr><tr><td><label>Nombre* </label></td><td><input type="text" name="txtnom" required="" placeholder="Juan Perez" maxlength="30" size="20px" onkeypress="return onKeyPressBlockNumbers(event);"></td></tr><tr><td><label>Fecha Nacimiento* </label></td><td><input type="date" name="txtfec" required="required" size="12"/></td></tr><tr><td><label>Direccion* </label></td><td><input type="text" name="txtdir" required="required" size="30"/></td></tr><tr><td><label>Fono* </label></td><td><input type="tel" name="txtfono" required="required" size="12" onkeypress="return isNumberKey(event);" /></td></tr><tr><td><label>Rol del Usuario* :</label></td><td><select name="cbocargo" required=""><option>Selecione Cargo</option><option value="Administrador">Administrador</option><option value="Educadora">Educadora</option><option value="Apoderado">Apoderado</option></select></td></tr><tr><td><label>Contraseña : </label></td><td><input type="password" name="txtclave" required="" maxlength="12" size="12" />Min. 6 Caracteres</td> </tr><?php echo"<tr>";echo"<td><label>Sede :</label></td>";echo"<td>";$c->conexion();$c->llenarcombosede();$c->desconexion();echo"</td>";echo"</tr>";echo"<tr>";echo"<td><label>Nivel : </label></td>";echo"<td>";$c->conexion();$c->llenarcombonivel();$c->desconexion();echo"</td>";echo"</tr>";?></tr><th colspan="2"><input type="submit" name="reg" value="Registrar" style="width:80px; height:25px;"></th</table></form>');
}*/


function cargarFormulario2(){
	var x;
	x = $("#formulario");
	x.html('<form action="jardin.php" method="post"><table width="400"><tr><td><label>Nombre : </label></td><td><input type="text" name="nomsede"></td></tr><tr><td><label>Direccion : </label></td><td><input type="text" name="dirsede"></td></tr><tr><td><label>Telefono : </label></td><td><input type="text" name="telsede"></td></tr><th colspan="2"><td><input type="submit" name="regsede" value="Registrar" style="width:80px; height:25px;"></td></th></table></form>');
}

function cargarFormulario3(){
	var x;
	x = $("#formulario");
	x.html('<form action="jardin.php" method="post"><table width="400"><tr><td><label>Nombre : </label></td><td><input type="text" name="nomnivel"></td><th colspan="2"><td><input type="submit" name="regnivel" value="Registrar" style="width:80px; height:25px;"></td></th></table></form>');
}

function cargarFormulario4(){
	var x;
	x = $("#formulario");
	x.html('<form action="jardin.php" method="post"><table width="400"><tr><td><label>Codigo Sede : </label></td><td><input type="text" name="codsede"></td><th colspan="2"><td><input type="submit" name="buscarsede" value="Buscar" style="width:80px; height:25px;"></td></th></table></form>');
}


function cargarFormulario5(){
	var x;
	x = $("#formulario");
	x.html('<form action="jardin.php" method="post"><table width="400"><tr><td><label>Codigo Nivel : </label></td><td><input type="text" name="codsede"></td><th colspan="2"><td><input type="submit" name="buscarnivel" value="Buscar" style="width:80px; height:25px;"></td></th></table></form>');
}























