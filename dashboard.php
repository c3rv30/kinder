<?php
    //restringir el acceso a personas no logeadas
    session_start();    
    $usuario = $_SESSION["login"];
    $cargo  = $_SESSION["rol"];
    if(!isset($_SESSION['login'])){ //preguntar si NO se ha logeado
        header("location:index.php?error=2");       
    }   
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Kinder</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <link rel="icon" type="image/png" href="images/icon.png"/>
		<link rel="stylesheet" href="css/style.css" type="text/css" media="all"/>
        <script type="text/javascript" src="js/jquery-1.7.2.js"></script>

<script type="text/javascript">
$(document).ready(function() {
        // Tooltip only Text
        $('.masterTooltip').hover(function(){
                // Hover over code
                var title = $(this).attr('title');
                $(this).data('tipText', title).removeAttr('title');
                $('<p class="tooltip"></p>')
                .text(title)
                .appendTo('body')
                .fadeIn('slow');
        }, function() {
                // Hover out code
                $(this).attr('title', $(this).data('tipText'));
                $('.tooltip').remove();
        }).mousemove(function(e) {
                var mousex = e.pageX + 20; //Get X coordinates
                var mousey = e.pageY + 10; //Get Y coordinates
                $('.tooltip')
                .css({ top: mousey, left: mousex })
        });
});
</script>
<script type="text/javascript">
            $(document).ready(function() {
                //$("#boton").click(function(event) {
                    $("#message_backup").load('veri_backup_auto.php');
                //});
            });
</script>
	</head>
    <body onload="javascript:loadDivAjaxMenu('veri_backup_auto.php','body');">
		<header>
        	<div id="container">
        		<div class="wrapper">
            		<a href="dashboard.php"><img id="logo" src="images/logo.png"></a>
            	</div>
                <div id="logout">
            		<form name="form_usu" action="cerrar_ses.php" method="post">
						<input type=image class="logout" src="images/logout_com.png" align="right";>
          			</form>
       			</div><!--Cierre div log-->
                <div id="nav">               
    			<nav>
                    	<ul class="menu">
                        	<li><a href="veri_backup_auto.php">Inicio</a></li>
                            <li><a href="#">Niños</a>
                                <!--<ul class="sub">
                                    <li><a href="#">sub link 1</a></li>
                                    <li><a href="#">sub link 2</a></li>
                                    <li><a href="#">sub link 3</a></li>
                                </ul>-->
                            </li>
                            <li><a href="#">Configuracion</a>
                                <ul class="sub">
                                	<li><a href="#">Gestion Sede</a></li>
                                    <li><a href="#">Gestion Nivel</a></li>
                                    <li><a href="#">sub link 3</a></li>                               
                                </ul>
                            </li>
                            <li><a href="#">link 4</a></li>
                            <li><a href="#">FAQs</a>
                             	<!--<ul class="sub">
                                	<li><a href="#">sub link 1</a></li>
                                    <li><a href="#">sub link 2</a></li>
                                </ul>-->
                            </li>
                             <!--<li><a href="#">link 6</a></li>-->
                        </ul>
            	</nav>       
                </div> 	
        	</div>
    	</header>
        <div class="top">
        		<div class="efecto2" id="message" style="float:left">
                    Bienvenido a kinder!!	                                                
                </div>    
                <div class="efecto2" id="message_backup" style="float:left;background-color:yellow; width:300px;heigth:80px;;">                        
                    
                </div>
                <div id="divatras" style="width:20px; height:auto; float:right; margin:20px;">                        
                        <a href="javascript:history.back()"><img src="images/back.png" height="44" width="44" alt="Botón"/></a> 
                </div>
                          
        </div>        
    	<section id="content">    	
            <div id="box-buttonleft" onClick="location.href='folders/admission.php';" class="masterTooltip" title="Ingresar información de admisión de niños">
            	<div id="admissi" >
                </div>        
            </div>
            <div id="box-button" onclick="location.href='folders/search.php';" class="masterTooltip" title="Buscar en los Registros de Estudiantes Presentes y Antiguos">
            	<div id="search">
                	
                </div>        
            </div>
            <div id="box-button" onclick="location.href='folders/users/users.php';" class="masterTooltip" title="Gestionar Usuarios">
            	<div id="users">
                	
                </div>        
            </div>
            <div id="box-button" onclick="location.href='folders/config_sis.php';" class="masterTooltip" title="Configurar Informacion Basica de la Institucion">
            	<div id="config">
                	
                </div>        
            </div>
             <div id="box-buttondown" onclick="location.href='folders/rrhh/rrhh.php';" class="masterTooltip" title="Departamento de Recursos humanos">
                <div id="rrhh">
                    
                </div>        
            </div>
            
    	</section>    
           
        
    	<footer>
        	<div class="container">
    			<div class="copy">Industrial Services (c) 2010	|	<a href="index-4.html">Privacy policy</a></div>
				<address class="phone">
					We're glad to help you. Please email or call us. <strong>1-123-456-7890</strong>
				</address>
            </div>
    	</footer>
	</body>
</html>
<script type="text/javascript">
		var Site = {  
  			accessibleMenu: function(){
    			$menu = $('.menu');
    			$sub = $('.sub');
    			$link = $menu.find('> li > a');
    			$sublink = $sub.find('> li > a');  
    			$link.focus(function() {
      				$sub.removeClass('show');
      				if($(this).next().length){
        				$(this).next().addClass('show');
      				}
    			});
    
    			$sublink.focus(function() {
      				$sub.removeClass('show');
      				$(this).parent().parent().addClass('show');
    			});
    
    			$(window).click(function(e) {
      				$sub.removeClass('show');
    			});
    
    			$(document).keyup(function(e) {
      				if(e.keyCode == 27 && $sub.is(':visible')){
        				$sub.removeClass('show');
      				}
    			});
  			}
		}

		$(function() {
  			Site.accessibleMenu();
		});
</script>
