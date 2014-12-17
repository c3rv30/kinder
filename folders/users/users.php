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
        <link rel="icon" type="image/png" href="../../images/icon.png"/>
        <link rel="stylesheet" href="../../css/style.css" type="text/css" media="all">	
        <link rel="stylesheet" type="text/css" href="../../css/custom-theme/jquery-ui-1.10.3.custom.css">
        <script type="text/javascript" src="../../js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../../js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript">
//Globo con ayuda en el hover de la interfaz principal
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

//Ventana emergente para actualizar Datos de sede
$(function(){
        $('#dialogModal').dialog({
            autoOpen:false,
            modal:true,
            show:'explode',
            hide:'blind'

        });

        $('.botonMini').on('click',function(){
            $('#dialogModal').dialog('open');
            return false;
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
        		<div class="efecto2" id="message" style="width:auto;">
                    <div id="menu_config" style="width:80px; height:80px; float:left;">
                        <img src="../../images/camello.png" style="width:80px; height:80px;">
                    </div>
                    <div id="divatras" style="width:auto; height:auto; float:right; margin:20px;">                        
                        <a href="javascript:history.back()"><img src="../../images/back.png" height="44" width="44" alt="Botón"></a>
                    </div>
                    <div id="conf" style="float:left; height:80px;">
                        <div class="subTitle">
                            <h2 style="color:#333333">Configuracion</h2>
                            <h3 style="color:green;">Gestion Sede</h3>
                        </div>                        
                    </div>                    
        		</div>                
        </div>                     
    	<section id="content" style="height:auto; clear:both; overflow:hidden; margin-bottom:172px;">
        <div id="left" style="float:left; width:auto;">
            <div style="float:left; margin:auto;">
                <?php                     
                    require_once("../../claseBD.php");
                    $c = new basededatos();
                    if(isset($_POST['reg'])){
                        $nomsede = $_POST['txtnomsede'];
                        $dirsede = $_POST['txtdirsede'];
                        $fonosede = $_POST['txtfonosede'];
                        $c->conexion();
                        $c->insertarSede($nomsede, $dirsede, $fonosede);
                        echo "<br/><div class='exito'><b>Sede Registrada Correctamente</b></div>" ;                    
                        $c->desconexion();
                    }

                    if(isset($_GET['elisede'])){
                        $codsede = $_GET['elisede'];
                        $c->conexion();
                        $c->eliminarSede($codsede);
                        echo "<br/><div class='exito'><b>Se Elimino Correctamente</b></div>" ;      
                        //$c->listarActivos();
                        //echo "<br/>";
                        //$c->listarInactivos();
                        $c->desconexion(); 
                    }

                    if (isset($_POST['actualizar'])) {
                        $codsede = $_POST['txtcodsede'];
                        $nomsede = $_POST['txtnomsede'];
                        $dirsede = $_POST['txtdirsede'];
                        $fonosede = $_POST['txtfonosede'];
                        $c->conexion();
                        $c->actSede($codsede, $nomsede, $dirsede, $fonosede);
                        echo "<br/><div class='exito'><b>Se Actualizo Correctamente El Registro</b></div>" ;
                        $c->desconexion();
                    }

                    if(isset($_GET['actsede'])){
                        $codsede = $_GET['actsede'];
                        $c->conexion();
                        $c->activarSede($codsede);
                        echo "<br/><div class='exito'><b>Se Activo la Sede Correctamente</b></div>" ;
                        $c->desconexion();
                    }
                ?>  

                <script type="text/javascript">
                    function confirmacion(id) {
                        var answer = confirm("Esta seguro que desea eliminar la Sede?")
                        if (answer){
                            //alert("Evento eliminado")
                            window.location.href="sede.php?elisede="+id;
                        }else{
                            //alert("Cancelado")
                        }    
                    }
                </script>            
            </div>                 
            <div id="tableSede" style="clear:both; margin:auto;">
                <?php            
                        require_once("../../claseBD.php");
                        $c = new basededatos();
                        $c->conexion();
                        $c->listarActivos();                    
                        $c->desconexion();
                ?>
            </div>
        </div> 
        <div id="right" style="float:right; width:auto; margin-right:40px;">
            <div id="opcsede" style="width:auto; float:right;">
                <a href="sedenew.php" style="text-decoration:none;"><input class="boton" type="button" value="Nueva"></a>
                <a href="sedeIna.php" style="text-decoration:none;"><input name="" class="boton" type="button" value="Inactivas"></a>
                <a href="reportSede.php" style="text-decoration:none;"><input name="" class="boton" type="button" value="Reportes"></a>
            </div>
        </div> 

        <div id="dialogModal" title="Actualizar">
            <p>Holi!!!!</p>
            
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
        //Script Para Barra Nav
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
