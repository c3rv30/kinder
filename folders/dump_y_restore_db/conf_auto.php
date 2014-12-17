<?php
    //restringir el acceso a personas no logeadas
    session_start();    
    $usuario = $_SESSION["login"];
    $cargo  = $_SESSION["rol"];
    if(!isset($_SESSION['login'])){ //preguntar si NO se ha logeado
        header("location:../../index.php?error=2");       
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
	</head>
	<body>
		<header>
        	<div id="container">
        		<div class="wrapper">
            		<a href="../../index.php"><img id="logo" src="../../images/logo.png"></a>
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
                            <li><a href="#">link 2</a>
                            	<ul class="sub">
                                	<li><a href="#">sub link 1</a></li>
                                    <li><a href="#">sub link 2</a></li>
                                    <li><a href="#">sub link 3</a></li>
                                </ul>
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
        		<div class="efecto2" id="message" style="width:960px;">
                    <div id="menu_config" style="width:80px; height:80px; float:left;">
                        <img src="../../images/camello.png" style="width:80px; height:80px;">
                    </div>
                    <div id="conf" style="float:left; height:80px;">
                        <div class="subTitle">
                            <h2 style="color:#333333">Configuracion</h2>
                            <h3 style="color:green;">Menu Mantencion Sistema</h3>
                        </div>                                                
                    </div>
                    <div id="divatras" style="width:auto; height:auto; float:right;">                        
                        <a href="javascript:history.back()"><img src="../../images/back.png" height="66" width="66" alt="Botón"></a> 
                    </div>
        		</div>
        </div>                     
    	<section id="content" style="height:400px;">    	                           
                <div id="left" style="float:left; width:auto; margin-left:40px;margin-top:40px;">
                <?php
                    require_once("../../claseBD.php");
                    $c = new basededatos();
                    if(isset($_POST['config_auto'])){
                        $dia = $_POST['dia']; 
                        $hora = $_POST['hora']; 
                        $c->conexion();
                        $c->ConfigAuto($dia, $hora);
                        $c->desconexion();
                    }
                ?>
                    <div id="confauto" style="width:auto; float:right;">
                        <form class="contact_form" action="conf_auto.php" method="post" id="config_form">
                        <input type="hidden" name="manual" id="manual" value="0000-00-00" ></input>
                            <ul>
                                <li>
                                    <h2>Configurar Hora y dia Para Respaldo Automatico de la BD</h2>
                                </li>
                                <li>
                                    <label for="name">D&iacute;a :</label>
                                    <input type="hidden"/>
                                        <select id="dia" name="dia">
                                            <option value="todos">Todos los dias</option>
                                            <option value="lunes">Lunes</option>
                                            <option value="martes">Martes</option>
                                            <option value="miercoles">Miercoles</option>
                                            <option value="jueves">Jueves</option>
                                            <option value="viernes">Viernes</option>
                                            <option value="sabado">Sabado</option>
                                            <option value="domingo">Domingo</option>
                                        </select>                                                           
                                </li>   
                                <li>
                                    <label for="name">Hora :</label>
                                    <input type="hidden"/>                            
                                        <select id="hora" name="hora">
                                            <option value="00:00:00">00:00</option>
                                            <option value="01:00:00">01:00</option>
                                            <option value="02:00:00">02:00</option>
                                            <option value="03:00:00">03:00</option>
                                            <option value="04:00:00">04:00</option>
                                            <option value="05:00:00">05:00</option>
                                            <option value="06:00:00">06:00</option>
                                            <option value="07:00:00">07:00</option>
                                            <option value="08:00:00">08:00</option>
                                            <option value="09:00:00">09:00</option>
                                            <option value="10:00:00">10:00</option>
                                            <option value="11:00:00">11:00</option>
                                            <option value="12:00:00">12:00</option>
                                            <option value="13:00:00">13:00</option>
                                            <option value="14:00:00">14:00</option>
                                            <option value="15:00:00">15:00</option>
                                            <option value="16:00:00">16:00</option>
                                            <option value="17:00:00">17:00</option>
                                            <option value="18:00:00">18:00</option>
                                            <option value="19:00:00">19:00</option>
                                            <option value="20:00:00">20:00</option>
                                            <option value="21:00:00">21:00</option>
                                            <option value="22:00:00">22:00</option>
                                            <option value="23:00:00">23:00</option>
                                            <option value="24:00:00">24:00</option>
                                        </select>
                                </li>          
                                <button name="config_auto" class="boton" type="submit" style="width:auto; margin-top:20px;">Guardar</button>                            
                            </ul>
                    </form>                        
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
<script>
    function send(){
        sendInfoPostDiv('save_auto_config.php?d="martes"','config_form','confauto');
    }
</script>