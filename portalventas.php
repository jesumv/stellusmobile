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
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"/>
	<title>STELLUS MEDEVICES</title>
	<meta name="description" content="pagina de inicio">
	<meta name="author" content="jmv">
	<!-- Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/jqtouch.css">
	<link rel="stylesheet" href="css/apple.css">
	<!-- end CSS-->
	<link rel="shortcut icon" href="img/logomin.gif" />
	<meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<script src="js/zepto.min.js"></script>
	<script src="js/jqtouch.min.js" type="application/x-javascript" charset="ISO-8859-1">></script>
	<script type="text/javascript" charset="ISO-8859-1">

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
				$('#tactiv').on('change',function(e){
   					e.preventDefault();
   					var e = document.getElementById('tactiv');
					var item = e.options[e.selectedIndex].value;
					if(item == 3){
						$('#otrot').toggle();
						$('#otrot').focus();
					};
   				return false;
				});
				
		});

	</script>

</head>
<body>
	
	<div id="home" target="_blank">
	  <div class="toolbar" target="_blank">
	   <h1>Stellus</h1>
	    <a class="button leftButton flip" href="#home" target="_blank">Home</a>
	    <a class="button rightButton flip" href="#login" target="_blank">Login</a>
	  </div>
	  	   <h1><?php echo $_SESSION['username']; ?></h1>
	  <div class = "scroll">
	  	 <ul class = "rounded">
		  <li class="arrow" target="_blank"><a href="#activ" target="_blank">Reporte Actividades</a></li>
		  <li class="arrow" target="_blank"><a href="#playing" target="_blank">Estadísticas Hospital</a></li>
		  <li class="arrow" target="_blank"><a href="#news" target="_blank">Registro de Contactos</a></li>
		  <li class="arrow" target="_blank"><a href="#contact" target="_blank">Mi Querido Diario</a></li>
		  <li class="arrow" target="_blank"><a href="#contact" target="_blank">El Diario del Doctor</a></li>
	  	</ul>
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
	
	<div id="activ">
		<div class="toolbar" target="_blank">
		   <h1>Stellus</h1>
		    <a class="button leftButton flip" href="#home" target="_blank">Home</a>
		    <a class="button rightButton flip" href="#login" target="_blank">Login</a>
	  	</div>
	  	<h1><?php echo $_SESSION['username']; ?></h1>
	    <h1>REPORTE DE ACTIVIDADES</h1>
	    <form class="scroll">
	    	<ul class="edit rounded">
	    		 Fecha de la actividad:
				<li><input type="date" name="fecha" id="fecha"></li>
				Actividad:
				 <li class="arrow">
                            <select id="tactiv">
                            	<optgroup label="Actividad">
                                    <option value =1>Asistencia A Cirugía</option>
                                    <option value =2>Visita en consultorio</option>
                                    <option value =3>otra</option>
                                </optgroup>
                            </select>
                </li>
                <li>
                	<input  type="text" name="otrot" placeholder="Actividad" id="otrot" style="display:none" />
                </li>
				<li><input type="text" name="dr" placeholder="Doctor" id="dr" /></li>		
	    	</ul>
	    </form>
	</div>
	
</body>
</html>