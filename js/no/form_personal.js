// JavaScript Document
var x;
x = $(document);
x.ready(inicializarEventos);

function inicializarEventos(){
	var x;
	x = $("#registrar");		
	x.click(cargarFormulario);
}

function cargarFormulario(){
	var x;
	x = $("#formulario");
	x.html('<form action="personal.php" method="post"><table width="400"><tr><td><label>Rut : </label></td><td><input type="text" name="txtrut"></td></tr><tr><td><label>Cargo : </label></td><td><select name="cbocargo"><option>Selecione Cargo</option><option value="Administrador">Administrador</option><option value="Educadora">Educadora</option><option value="Apoderado">Apoderado</option></select></td></tr><tr><td><label>Contraseña : </label></td><td><input type="password" name="txtclave"></td></tr><th colspan="2"><td><input type="submit" name="reg" value="Registrar" style="width:80px; height:25px;"></td></th</table></form>');
}
