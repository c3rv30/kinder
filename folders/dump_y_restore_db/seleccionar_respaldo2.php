<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
 <HEAD>
 	<title>Kinder</title>
	<!-- no cache headers -->
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-store">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Cache-Control" content="must-revalidate">
	<!-- end no cache headers --> 
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	
        <link rel="stylesheet" href="../../css/style.css" type="text/css" media="all">	
 </HEAD>
<BODY
	bgcolor="#D5D5D5" 
	text="#000000" 
	id="all" 
	leftmargin="25" 
	topmargin="25" 
	marginwidth="25" 
	marginheight="25" 
	link="#000020" 
	vlink="#000020" 
	alink="#000020">
	<br>
<center><h1>Seleccion de Archivo a Restaurar</h1></center>
<br>
<center><a href="respaldar.php"><INPUT style="width:200px;" class="boton" type=button value="Volver a Kinder"></INPUT></a></center><br>
<br><br>

<!-- El Formulario --> 
<form method="POST" action="restore_db.php"> 
	<div id="wizard"> 
		<ul id="status"> 
			<li class="active" style="margin-left:40px;margin-top:20px;">Restaurar Base de Datos </li> 
		</ul> 
		<div class="items"> 
			<!-- Pagina 1 --> 
			<div class="page"> 
				<ul>            
                  	<table style="margin-left:40px;margin-top:20px;" width="800" height="106" border="0">
                    	<tr>
                      		<td width="200"><p>Seleccione Archivo a Restaurar:</p></td>
                      		<td width="206" align="center" colspan="2"> <INPUT class="boton" type=file name="nom_res" id="nom_res" value="" accept="application/x-gzip"></td>
                      	</tr>
                      	<tr align="center"><td colspan="3"><p  align="center"><INPUT style="width:70px;text-decoration:none;" class="boton" type=submit value="Enviar"></p> </td>
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

</BODY>