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
	<meta name="description" content="pagina de inicio">
	<meta name="author" content="jmv">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/jqtouch.css">
	<link rel="stylesheet" href="css/apple.css">
	<link rel="stylesheet" href="css/jquery-ui-1.10.4.custom.min.css">
	<!-- end CSS-->
	<link rel="shortcut icon" href="/img/logomin.gif" />
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
			//funcion para activar caja otras
				$('#tactiv').on('change',function(e){
   					e.preventDefault();
   					var e = document.getElementById('tactiv');
					var item = e.options[e.selectedIndex].value;
					if(item == 3){
						$('#otrot').toggle();
						$('#otrot').focus();
					}else{$('#dr').focus();};
   				return false;
				});
			//funcion para activar caja cantidad	
				$('#venta').on('change',function(e){
   					e.preventDefault();
   					var e = document.getElementById('venta');
					var item = e.options[e.selectedIndex].value;
					if(item > 0){
						$('#cantit').toggle();
						$('#cant').toggle();
						$('#remision').toggle();
						$('#cant').focus();
					};
   				return false;
				});	
		//funciones de jqueryui		
			$('#dr').autocomplete({
					autoFocus: true,
		            minLength: 2,
		            source: function( request, response ) {
			            $.ajax({
			                url: "php/get_dr_list.php",
			                data: {term: request.term},
			                success: function(data){
			                	if(data=-99){
			                		location.href = "#opcionaltamed";
			                	}else{response(data)};
			                    ;
			                },
			                error: function(jqXHR, textStatus, errorThrown){
			                    alert("error en consulta!");                        
			                },
			              dataType: 'json'
			            });
        			},
		         
			        appendTo:"#dres",
		            position:{my:"right top",at:"right bottom"},
		            select: function( event, ui ) {
		            		$("#dr").val(ui.item.label);
							$( "#iddr" ).val( ui.item.iddoctores )
						}
						                
		        });        
				                
        	$('#hosp').autocomplete({
			autoFocus: true,
			source: "php/get_hosp_list.php",
            minLength: 2,
            appendTo:"#hosps",
            position:{my:"right top",at:"right bottom"},
            select: function( event, ui ) {
            		$("#hosp").val(ui.item.label);
					$( "#idhosp" ).val( ui.item.idsuccliente );
					$('#proc').focus();
				}
				                
        });
        $('#proc').autocomplete({
			autoFocus: true,
			source: "php/get_proc_list.php",
            minLength: 2,
            appendTo:"#procs",
            position:{my:"right top",at:"right bottom"},
            select: function( event, ui ) {
            		$("#proc").val(ui.item.label);
					$( "#idproc" ).val( ui.item.idproc );
					$('#venta').focus();
				}
				                
        });
				
		});

	</script>

</head>
<body>
	<div id="jqt" class="">
		<div id="home" target="_self">
		  <div class="toolbar" target="_blank">
		   <h1>StellusApp 1.0</h1>
		    <a class="button leftButton flip" href="#home" target="_self">Home</a>
		    <a class="button rightButton flip" href="#login" target="_blank">Login</a>
		  </div>
		  <div class="info">
		  	   <h1><?php echo $_SESSION['username']; ?></h1>
		  </div>
		  <div>
		  	 <ul class = "rounded">
			  <li class="arrow" target="_self"><a href="#activ" target="_self">Reporte Actividades</a></li>
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
			   <h1>StellusApp 1.0</h1>
			    <a class="button leftButton flip" href="#home" target="_self">Home</a>
			    <a class="button rightButton flip" href="#login" target="_blank">Login</a>
		  	</div>
		  	<div class="info">
		  		<h1><?php echo $_SESSION['username']; ?></h1>
		    	<h1>REPORTE DE ACTIVIDADES</h1>
		    </div>
		    <form id="reported" class="form" action = "php/reporteactiv.php" method="POST">
		    	<ul class="rounded">
		    		 Fecha de la actividad:
					<li class="arrow"><input type="date" name="fecha" id="fecha"></li>
					Actividad:
					 <li class="arrow">
	                            <select id="tactiv" name = "tactiv">
	                            		<option selected="selected">Elija una opción:</option>
	                                    <option value =1>Asistencia A Cirugía</option>
	                                    <option value =2>Visita en consultorio</option>
	                                    <option value =3>otra</option>
	                            </select>
	                </li>
	                <li>
	                	<input  type="text" name="otrot" placeholder="Actividad" id="otrot" style="display:none" />
	                </li>
	                ID:
		                	<div id= "dres">
								<li class="info"><input type="text" name="dr" placeholder="Doctor" id="dr" /></li>
		                	</div>	
					<input type="hidden" name="iddr"  id="iddr" />
					<li></li>
							<div id="hosps">
								<li class="info"><input  type="text" name="hosp" placeholder="Hospital" id="hosp" /></li>
							</div>
	                <input type="hidden" name="idhosp"  id="idhosp" />
	                <li></li>
						<div id="procs">
							<li class="info"><input  type="text" name="proc" placeholder="Procedimiento" id="proc" /></li>
						</div>
					<input type="hidden" name="idproc"  id="idproc" />
					<li class= "arrow">
						Venta:
						<select id="venta" name = "venta">
	                            	<optgroup label="Producto">
	                            		<option selected="selected">Elija un producto:</option>
	                                    <option value =1>Responder</option>
	                                    <option value =2>Seal Foam</option>
	                                </optgroup>
	                    </select>
					</li>
					<span id="cantit" style="display:none">Cantidad:</span>
					<li>
						<input type="number" min="0" max="3" step="1" value="0" name="cant" id = "cant" style="display:none">
					</li>
					 <li>
	                	<input  type="text" name="remision" placeholder="Remisión" id="remision" style="display:none" />
	                </li>
					<div>
						<a href="#" class="submit greenButton">Enviar</a>
						<a href="#home" class="redButton">Cancelar</a>
					</div>
		    	</ul>

		    </form>
		</div>
		
		<div id="altamed">
			 <div class="toolbar" target="__self">
			   <h1>StellusApp 1.0</h1>
			    <a class="button leftButton flip" href="#home" target="_self">Home</a>
			    <a class="button rightButton flip" href="#login" target="_self">Login</a>
		  </div>
		  
		  <div id ="tit" class = "info">
				  	<h1><?php echo $_SESSION['username']; ?></h1>
				    <h1>ALTA DE MEDICOS</h1>
				Por favor proporcione sus datos, para incluir al Dr. en la base.
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
		
		<div id="opcionaltamed" class="actionsheet">
                <div class="actionchoices">
                    <fieldset>
                    	<div><h1>No existe Apellido con las letras introducidas</h1> </div>
                        <div><h1>Desea dar de alta al Dr.?</h1> </div>
                        <a href="#altamed" class="whiteButton">Sí,Dar de alta</a>
                        <a href="#activ" class="whiteButton">Volver al reporte</a>
                    </fieldset>
                    <a href="#home" class="redButton dismiss">Cancelar</a>
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
		
	</div>	
</body>
</html>