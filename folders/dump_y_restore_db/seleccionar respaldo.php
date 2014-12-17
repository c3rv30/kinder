<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="css/jquery.tools.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Añadiendo Librerias css-->
<link rel="stylesheet" href="../../css/style.css" type="text/css" media="all">	
<link rel="stylesheet" type="text/css" href="../../css/styles-form.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/standalone.css"/>	
<link rel="stylesheet" type="text/css" href="../css/Restaurar_BD.css"/>
 
 
<title>Restaurar BD ISL-Online</title>

<style> 
	body {
		background-color:#234;
		padding-top:5%;
	}
</style>

<body>

<!-- Ventana de Validacion de los campos en color Rojo --> 
<div id="drawer">Porfavor Complete los Campos en color<samp style="color:red"> Rojo</samp>.</div> 
 
<!-- El Formulario --> 
<form method="POST" action="restore_db.php"> 
 
	<div id="wizard"> 
 
		<ul id="status"> 
			<li class="active">Restaurar Base de Datos </li> 
		</ul> 
 
		<div class="items"> 
 
			<!-- Pagina 1 --> 
			<div class="page"> 
				<ul> 
                
                  <table width="400" height="106" border="0">
                    <tr>
                      	<td width="100"><p>Seleccione la Base de Datos:</td>
                      		<td width="276" align="center" colspan="2"> <INPUT type=file name="nom_res" id="nom_res" value="" accept="application/x-gzip">
                      	</td><td width="10"></p>
                      </tr>
                      <tr align="center"><td colspan="3"><p  align="center"> 
						
                        <INPUT type=submit value="Enviar">
				</p> </td>
  </table>
                      
 
			</div> 
 
 
		</div><!--items--> 
 
	</div><!--wizard--> 
                      
                    </form>
                      
         <script> 
$(function() {
 
 
var root = $("#wizard").scrollable();
 
 
 
// some variables that we need
var api = root.scrollable(), drawer = $("#drawer");
 
// validation logic is done inside the onBeforeSeek callback
api.onBeforeSeek(function(event, i) {
 
	// we are going 1 step backwards so no need for validation
	if (api.getIndex() < i) {
 
		// 1. get current page
		var page = root.find(".page").eq(api.getIndex()),
 
			 // 2. .. and all required fields inside the page
			 inputs = page.find(".required :input").removeClass("error"),
 
			 // 3. .. which are empty
			 empty = inputs.filter(function() {
				return $(this).val().replace(/\s*/g, '') == '';
			 });
 
		 // if there are empty fields, then
		if (empty.length) {
 
			// slide down the drawer
			drawer.slideDown(function()  {
 
				// colored flash effect
				drawer.css("backgroundColor", "#229");
				setTimeout(function() { drawer.css("backgroundColor", "#fff"); }, 1000);
			});
 
			// add a CSS class name "error" for empty & required fields
			empty.addClass("error");
 
			// cancel seeking of the scrollable by returning false
			return false;
 
		// everything is good
		} else {
 
			// hide the drawer
			drawer.slideUp();
		}
 
	}
 
	// update status bar
	$("#status li").removeClass("active").eq(i).addClass("active");
 
});
 
 
 
// if tab is pressed on the next button seek to next page
root.find("button.next").keydown(function(e) {
	if (e.keyCode == 9) {
 
		// seeks to next tab by executing our validation routine
		api.next();
		e.preventDefault();
	}
});
 
});



</script>            


</body>

</html>







