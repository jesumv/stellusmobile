<?php
/*** Autoload class files ***/ 
    function __autoload($class){
      require('include/' . strtolower($class) . '.class.php');
    }
	
    $funcbase = new dbutils;
/*** conexion a bd ***/
    $mysqli = $funcbase->conecta();
    if (is_object($mysqli)) {
/*** checa login***/
        $funcbase->checalogin($mysqli);
	}	
?>
<!doctype html>
<head>
	<link rel="shortcut icon" href="img/logomin.gif" type="image/x-icon"/>
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"/>
	<title>STELLUS MEDEVICES</title>
	<meta name="description" content="alta de medicos">
	<meta name="author" content="jmv">
	<!-- Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/jqtouch.css">
	<link rel="stylesheet" href="css/apple.css">
	<link rel="stylesheet" href="css/jquery-ui-1.10.4.custom.min.css">
	<!-- end CSS-->
	<link rel="shortcut icon" href="img/logomin.gif" />
	<meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<script src="js/jqtouch.js" type="text/javascript" charset="ISO-8859-1"></script>
	<script src="js/jquery-1.7.min.js" type="text/javascript" charset="ISO-8859-1"></script>
	<script src="js/jqtouch-jquery.js" type="application/x-javascript" charset="ISO-8859-1"></script>
	<script src="js/jquery-ui-1.10.4.custom.js" type="text/javascript" charset="ISO-8859-1"> </script>
<script>
		var jQT = new $.jQTouch({
		icon: 'img/logomin.gif',
        icon4: 'img/logomin.gif',
        addGlossToIcon: false,
        startupScreen: 'img/logomin.gif',
        statusBar: 'black-translucent',
        useFastTouch: false,
		preloadImages: []
		
		});
		$(document).ready(function(){
			$('#pat').focus();
//funciones de jqueryui
        	$('#hosp').autocomplete({
			autoFocus: true,
			source: "php/get_hosp_list.php",
            minLength: 2,
            appendTo:"#hosps",
            position:{my:"right top",at:"right bottom"},
            select: function( event, ui ) {
            		$("#hosp").val(ui.item.label);
					$( "#idhosp" ).val( ui.item.idsuccliente );
					$('#').focus();
				}
				                
        });
                	$('#esp').autocomplete({
			autoFocus: true,
			source: "php/get_esp_list.php",
            minLength: 2,
            appendTo:"#esps",
            position:{my:"right top",at:"right bottom"},
            select: function( event, ui ) {
            		$("#esp").val(ui.item.label);
					$( "#idesp" ).val(ui.item.idespecialidades);
					$('#').focus();
				}
				                
        });
				
		});

	</script>

</head>
<body>
	<div id="jqt" class="current">
		<div id="home" target="_self">
		  <div class="toolbar" target="__self">
		   <h1>StellusApp 1.0</h1>
		    <a class="button leftButton flip" href="#home" target="_self">Home</a>
		    <a class="button rightButton flip" href="#login" target="_self">Login</a>
		  </div>
			<div id ="tit" class = "info">
				  	<h1><?php echo $_SESSION['username']; ?></h1>
				    <h1>ALTA DE MEDICOS</h1>
No hay Médicos cuyo apellido inicie con las letras introducidas 
por favor proporcione sus datos, para incluirlo en la base.*SI EL HOSPITAL NO EXISTE, CONTACTAR AL GERENTE PARA SU ALTA.
			</div>
		     <div >
			    <form id="altamed" class="form" action = "php/enviaaltamed.php" method="POST" >
						
						<ul class = "rounded">
							Datos del médico:
			                	<div id="iddr">
			        					<li><input type="text" name="pat" placeholder="Apellido Paterno" id="pat" /></li>	
			                			<li><input type="text" name="mat" placeholder="Apellido Materno" id="mat" /></li>
			                			<li><input type="text" name="nombre" placeholder="Nombre" id="nombre" /></li>
			                			<div id="esps">
				                			<li><input  type="text" name="esp" placeholder="Especialidad" id="esp" /></li>
				                			<input type="hidden" name="idesp"  id="idesp" />
			                			</div>
																								
			                	</div>
			             </ul>
			             <ul class ="rounded" >
							Datos de localizacion:
			                	<div id="hosps">
									<li><input  type="text" name="hosp" placeholder="Hospital" id="hosp" /></li>
								</div>
								<input type="hidden" name="idhosp"  id="idhosp" />
									<li><input  type="text" name="dir" placeholder="Dirección" id="dir" /></li>
									<li><input  type="tel" name="trab" placeholder="Tel. trabajo" id="trab" /></li>
									<li><input  type="tel" name="cel" placeholder="Tel. celular" id="cel"" /></li>
									<li><input  type="email" name="email" placeholder="E-mail" id="email" /></li>
									<li><input  type="text" name="hor" placeholder="Horario" id="hor" /></li>
									
							</ul>
								<div>
										<a href="#" class="submit greenButton">Enviar</a>
										<a href="portalventas.php#activ" class="redButton">Cancelar</a>
								</div>
			    </form>
		    </div>	 
		</div>
				
		<div id="login" target="_blank">
		  <div class="toolbar" target="_blank">
		    <h1>Login</h1>
		    <a class="button leftButton flip" href="#home" target="_blank">Home</a>
		  </div>
		  
		  <form id="form-login" enctype="application/x-www-form-urlencoded" method="get" target="_blank">
		  <ul class="rounded" target="_blank">
		    <li><input type="text" />
		    </li><li><input type="password" />
		  </li></ul>
		  <a id="submit-login" class="whiteButton submit" target="_blank">Login</a>
		  </form>
		</div>
			
	</div>	
</body>
</html>