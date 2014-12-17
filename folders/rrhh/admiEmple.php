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
        <link rel="stylesheet" type="text/css" href="../../css/custom-theme/jquery-ui-1.10.3.custom.css">
        <script type="text/javascript" src="../../js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../../js/jquery-ui-1.10.3.custom.js"></script>        
        <script type="text/javascript">
            //Script Para Calendario en español
            jQuery(function($){
                $.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '&#x3c;Ant',
                nextText: 'Sig&#x3e;',
                currentText: 'Hoy',
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
                'Jul','Ago','Sep','Oct','Nov','Dic'],
                dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
                dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''};
                $.datepicker.setDefaults($.datepicker.regional['es']);
            });    

            $(document).ready(function() {
                $("#datepicker").datepicker();
                //$("#datepickernac").datepicker();
            });

            $(document).ready(function() {
                $("#datepicker").datepicker({ appendText: ' Haga click para introducir una fecha' });
            });



            $(function() {
                $("#datepickernac").datepicker(
                {
                    minDate: new Date(1900,1-1,1), maxDate: '-18Y',
                    dateFormat: 'dd/mm/yy',
                    defaultDate: new Date(1988,1-1,1),
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '-110:-18'
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
                    <form name="form_usu" action="cerrar_ses.php" method="post">
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
                        <img src="../../images/hipo.png" style="width:80px; height:80px;">
                    </div>
                    <div id="divatras" style="width:auto; height:auto; float:right; margin:20px;">                        
                        <a href="javascript:history.back()"><img src="../../images/back.png" height="44" width="44" alt="Botón"></a> 
                    </div>
                    <div id="conf" style="float:left; height:80px;">
                        <div class="subTitle">
                            <h2 style="color:#333333">Recursos Humanos</h2>
                            <h3 style="color:green;">Admision Empleados</h3>
                        </div> 
                    </div>
                </div>
        </div>                     
        <section id="content" style="height:auto;"> 
            <div class="link-heading">
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

                 ?>
                <form class="contact_form" action="emple.php" method="post" name="contact_form">
                <ul>
                    <li>
                        <h2>Ingresar Empleado</h2>
                        <span class="required_notification">* Denotes Required Field</span>
                    </li>
                    <li>
                        <label for="name">Rut Empleado:</label>
                        <input type="text" name="txtrutemple"  placeholder="11222333-4" required />
                    </li>
                    <li>
                        <label for="dir">Fecha Ingreso:</label>
                        <input type="text" name="datepicker" id="datepicker" readonly="readonly" size="12" />
                    </li>
                    <li>
                        <label for="pri_nom">Primer Nombre:</label>
                        <input type="text" name="txtprimnom" placeholder="Juanita" required />                        
                    </li>
                    <li>
                        <label for="sec_nom">Segundo Nombre:</label>
                        <input type="text" name="txtsecnom" placeholder="Juanita" />                        
                    </li>
                    <li>
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" name="txtape" placeholder="Perez Vargas" required/>                        
                    </li>
                    <li>
                        <label for="email">Email:</label>
                        <input type="email" name="txtemail" placeholder="nombre@mimail.com" required />                        
                    </li>
                    <li>
                        <label for="genero">Genero:</label>
                        <input type="radio" name="sex" value="male" checked="checked">Masculino<br>
                        <input type="radio" name="sex" value="female">Femenino                       
                    </li>
                    <li>
                        <label for="dir">Fecha Nacimiento:</label>
                        <input type="text" name="datepickernac" id="datepickernac" readonly="readonly" size="12" />
                    </li>
                    <li>
                        <label for="dir">Sede:</label>
                        <?php                            
                            $c->conexion(); 
                            $c->llenarcombosede(); 
                            $c->desconexion();
                        ?>
                    </li>
                    <li>
                        <label for="puesto">Posicion o Puesto:</label>
                        <select name="cbopuesto">
                            <option value="0">Seleccione</option>                            
                            <option value="Educadora">Educadora</option>
                            <option value="Asistente">Asistente</option>
                            <option value="Manipuladora">Manipuladora</option>                            
                            <option value="Aseo">Aseo</option>                                                                                
                        </select>
                    </li>
                    <li>
                        <label for="dir">Experiencia:</label>
                        <textarea name="expcom" rows="4" cols="50"></textarea>                        
                    </li>
                    <li>
                        <button name="reg" class="boton" type="submit" style="width:90px; margin-top:30px;">Ingresar</button>
                    </li>
                </ul>
            </form>
            </div>
        </section>          

        <footer>
            <div class="container">
                <div class="copy">Industrial Services (c) 2010  |   <a href="index-4.html">Privacy policy</a></div>
                <address class="phone">
                    We're glad to help you. Please email or call us. <strong>1-123-456-7890</strong>
                </address>
            </div>
        </footer>
    </body>
</html>
<script type="text/javascript">
        //Script Para el NAV
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


