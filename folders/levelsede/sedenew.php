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
        <link rel="stylesheet" href="../../css/style.css" type="text/css" media="all">	
        <link rel="stylesheet" type="text/css" href="../../css/styles-form.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
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
	</head>
	<body>
		<header>
        	<div id="container">
        		<div class="wrapper">
            		<a href="../../dashboard.php"><img id="logo" src="../../images/logo.png"></a>
            	</div>
                <div id="logout">
            		<form name="form_usu" action="../../cerrar_ses.php" method="post">
						<input type=image class="logout" src="../../images/logout_com.png" align="right";>
          			</form>
       			</div><!--Cierre div log-->
                <div id="nav">               
    			<nav>
                    	<ul class="menu">
                        	<li><a href="../../dashboard.php">Inicio</a></li>
                            <li><a href="#">Niños</a>
                                <!--<ul class="sub">
                                    <li><a href="#">sub link 1</a></li>
                                    <li><a href="#">sub link 2</a></li>
                                    <li><a href="#">sub link 3</a></li>
                                </ul>-->
                            </li>
                            <li><a href="#">link 3</a>
                                <ul class="sub">
                                	<li><a href="#">sub link 1</a></li>
                                    <li><a href="#">sub link 2</a></li>
                                    <li><a href="#">sub link 3</a></li>                               
                                </ul>
                            </li>
                            <li><a href="#">link 4</a></li>
                            <li><a href="#">link 5</a>
                             	<ul class="sub">
                                	<li><a href="#">sub link 1</a></li>
                                    <li><a href="#">sub link 2</a></li>
                                </ul>
                            </li>
                             <!--<li><a href="#">link 6</a></li>-->
                          </ul>
            	</nav>       
                </div> 	
        	</div>
    	</header>
        <div class="top">
        		<div class="efecto2" id="message" style="width:900px;">
                    <div id="menu_config" style="width:80px; height:80px; float:left;">
                        <img src="../../images/camello.png" style="width:80px; height:80px;">
                    </div>
                    <div id="divatras" style="width:auto; height:auto; float:right; margin:20px;">                        
                        <a href="javascript:history.back()"><img src="../../images/back.png" height="44" width="44" alt="Botón"></a> 
                    </div>
                    <div id="conf" style="float:left; height:80px;">
                        <div class="subTitle">
                            <h2 style="color:#333333">Configuracion</h2>
                            <h3 style="color:green;">Ingresar Nueva Sede</h3>
                        </div> 
                    </div>
        		</div>
        </div>                     
    	<section id="content" style="height:400px;"> 
            <div class="link-heading">
                <form class="contact_form" action="sede.php" method="post" name="contact_form">
                <ul>
                    <li>
                        <h2>Ingresar Sede</h2>
                        <span class="required_notification">* Denotes Required Field</span>
                    </li>
                    <li>
                        <label for="name">Nombre Sede:</label>
                        <input type="text" name="txtnomsede"  placeholder="Recreo" required />
                    </li>
                    <li>
                        <label for="dir">direccion:</label>
                        <input type="text" name="txtdirsede" placeholder="Av. Recreo #111" required />
                    </li>
                    <li>
                        <label for="fono">Fono:</label>
                        <input type="text" name="txtfonosede" placeholder="1212121" />                        
                    </li>                                    
                        <button name="reg" class="boton" type="submit" style="width:90px; margin-top:30px;">Ingresar</button>
                    </li>
                </ul>
            </form>
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
