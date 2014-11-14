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
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="stylesheet" href="css/apple.css">
	<link rel="stylesheet" href="css/jquery-ui-1.10.4.custom.min.css">
	<!-- end CSS-->
	<meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<script src="js/jqtouch.js" type="text/javascript" charset="windows-1252"></script>
	<script src="js/jquery-1.7.min.js" type="text/javascript" charset="windows-1252"></script>
	<script src="js/jqtouch-jquery.js" type="application/x-javascript" charset="windows-1252"></script>
	<script src="js/jquery-ui-1.10.4.custom.js" type="text/javascript" charset="windows-1252"> </script>
<script>
		var estado = null;
		var jQT = new $.jQTouch({
		icon: 'img/logomin.gif',
        icon4: 'img/logomin.gif',
        addGlossToIcon: false,
        startupScreen: 'img/logomin.gif',
        statusBar: 'black-translucent',
        useFastTouch: false,
		preloadImages: []
		
		});
		//funcion para habilitar boton back
		var atras = function(evt){
			  evt.preventDefault();
			  evt.stopPropagation();
			  jQT.goBack();
			}
		//funcion para limpiar forma
		function resetForm($form) {
		    $form.find('input:text,input:file, select, textarea').val('');
		}
		
		$(document).ready(function(){
			//funcion para boton back
			$('.atras').click(atras);
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
		//-------------------funciones de jqueryui	--------------------------//
		//-----------FUNCIONES DEL REPORTE DE ACTIVIDADES	---------------//	
			$('#dr').autocomplete({
					autoFocus: true,
		            minLength: 2,
		            source: function( request, response ) {
			            $.ajax({
			                url: "php/get_dr_list.php",
			                data: {term: request.term},
			                contentType:'application/x-www-form-urlencoded; charset=ISO-8859-1',
			                success: function(data){
			                	if(data==-99){
			                		location.href ="#opcionaltamed";
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
            source: function( request, response ) {
			            $.ajax({
			                url: "php/get_hosp_list.php",
			                data: {term: request.term},
			                success: function(data){
			                	if(data==-99){
			                		location.href ="#avisonohosp";
			                	}else{response(data)};
			                    ;
			                },
			                error: function(jqXHR, textStatus, errorThrown){
			                    alert("error en consulta!");                        
			                },
			              dataType: 'json'
			            });
        			},
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
			source: function( request, response ) {
			            $.ajax({
			                url: "php/get_proc_list.php",
			                data: {term: request.term},
			                success: function(data){
			                	if(data==-99){
			                		location.href ="#noproc";
			                	}else{response(data)};
			                    ;
			                },
			                error: function(jqXHR, textStatus, errorThrown){
			                    alert("error en consulta!");                        
			                },
			              dataType: 'json'
			            });
        			},
            minLength: 2,
            appendTo:"#procs",
            position:{my:"right top",at:"right bottom"},
            select: function( event, ui ) {
            		$("#proc").val(ui.item.label);
					$( "#idproc" ).val( ui.item.idproc );
					$('#venta').focus();
				}
				                
        });
        
 //-----------FUNCIONES DEL ALTA DE MEDICOS	---------------//       
                	$('#drhosp').autocomplete({
			autoFocus: true,
			source: "php/get_hosp_list.php",
            minLength: 2,
            source: function( request, response ) {
			            $.ajax({
			                url: "php/get_hosp_list.php",
			                data: {term: request.term},
			                success: function(data){
			                	if(data==-99){
			                		location.href ="#avisonohosp";
			                	}else{response(data)};
			                    ;
			                },
			                error: function(jqXHR, textStatus, errorThrown){
			                    alert("error en consulta!");                        
			                },
			              dataType: 'json'
			            });
        			},
            appendTo:"#drhosps",
            position:{my:"right top",at:"right bottom"},
            select: function( event, ui ) {
            		$("#drhosp").val(ui.item.label);
					$( "#iddrhosp" ).val( ui.item.idsuccliente );
					$('#dir').focus();
				}
				                
        });
        
                $('#esp').autocomplete({
			autoFocus: true,
			source: function( request, response ) {
			            $.ajax({
			                url: "php/get_esp_list.php",
			                data: {term: request.term},
			                success: function(data){
			                	if(data==-99){
			                		location.href ="#noesp";
			                	}else{response(data)};
			                    ;
			                },
			                error: function(jqXHR, textStatus, errorThrown){
			                    alert("error en consulta!");                        
			                },
			              dataType: 'json'
			            });
        			},
            minLength: 2,
            appendTo:"#esps",
            position:{my:"right top",at:"right bottom"},
            select: function( event, ui ) {
            		$("#esp").val(ui.item.label);
					$( "#idesp" ).val( ui.item.idespecialidades );
					$('#drhosp').focus();
				}
				                
        });
        
//----------funciones de envio de reportes con boton submit-------------//
				$("#activ").submit(function(event){			
					event.preventDefault();
					var $form =$(this);
					var fecha = $form.find( "input[name='fecha']" ).val();
					var tactiv = $form.find( "select[name='tactiv']" ).val();
					var otrot = $form.find( "input[name='otrot']" ).val();
					var iddr = $form.find( "input[name='iddr']" ).val();
					var idhosp = $form.find( "input[name='idhosp']" ).val();
					var idproc = $form.find( "input[name='idproc']" ).val();
					var venta = $form.find( "select[name='venta']" ).val();
					var cant = $form.find( "input[name='cant']" ).val();
					var remision= $form.find( "input[name='remision']" ).val();
					var url = "php/reporteactiv.php";
					
//validación de la forma--------------------------------------------//
					function validactiv(fecha,tactiv,iddr,idhosp,idproc,venta,cant){
	//validacion de campos obligatorios
						if(fecha ==""||tactiv==""||iddr==""||idhosp=="")return 1;
	//si la actividad es otra, indicar cual es la otra actividad
						if(tactiv=="3" && otrot=="")return 1;
	//si la actividad es cirugía, indicar cual es el procedimiento
						if(tactiv=="1" && idproc=="")return 1;
	//si se indica venta, debe existir cantidad y viceversa
						if(venta!="" && cant=="0")return 1;
						if(cant!="0" && venta=="")return 1;
						return 0;
					}
					var valida = validactiv(fecha,tactiv,iddr,idhosp,idproc,venta,cant)
					if(valida == 1){
						jQT.goTo("#validado")
					}else{
						var posting = $.post( url, { 
						fecha: fecha,
						tactiv:tactiv,
						otrot: otrot,
						iddr: iddr,
						idhosp: idhosp,
						idproc:idproc,
						venta:venta,
						cant:cant,
						remision:remision
						} )
						.done(function( data ) {
						if (data == -99 || data == null){
							location.href="#error";	}else{
								location.href="#exito";	
							}
						})
						.fail(function(data){
							location.href="#error";
						});
			};
		});
			
			 $("#faltamed").submit(function(event)	{
				event.preventDefault();
				var $form = $( this );
				pat = $form.find( "input[name='pat']" ).val(),
				mat = $form.find( "input[name='mat']" ).val(),
				nombre = $form.find( "input[name='nombre']" ).val(),
				iddrhosp = $form.find( "input[name='iddrhosp']" ).val(),
				dir = $form.find( "input[name='dir']" ).val(),
				trab = $form.find( "input[name='trab']" ).val(),
				cel= $form.find( "input[name='cel']" ).val(),
				email = $form.find( "input[name='email']" ).val(),
				hor = $form.find( "input[name='hor']" ).val(),
				idesp = $form.find( "input[name='idesp']" ).val(),
				url = "php/enviaaltamed.php";
				
				//validación de la forma--------------------------------------------//
					function validaltamed(pat,mat,nombre,iddrhosp,idesp){
	//validacion de campos obligatorios
						if(pat ==""||mat==""||nombre==""||iddrhosp==""||idesp=="")return 1;
					}
					var valida = validaltamed(pat,mat,nombre,iddrhosp,idesp)
					if(valida == 1){
						jQT.goTo("#validado")
					}else{
				var posting = $.post( url, { 
					pat: pat,
					mat:mat,
					nombre: nombre,
					iddrhosp: iddrhosp,
					dir: dir,
					trab: trab,
					cel:cel,
					email:email,
					hor:hor,
					idesp:idesp
					} )
				.done(function( data ) {
					if (data == -99 || data == null){
						location.href="#error";	}else{
							location.href="#exito";	
						}
				})
				.fail(function(data){
					location.href="#error";
				});
				};
				
			 });
			 
			 $("#altaproc").submit(function(event){
			 	event.preventDefault();
				var $form = $( this );
				proc = $form.find( "input[name='aproc']" ).val(),
				url = "php/enviaaltaproc.php";
				var posting = $.post(url,{
					proc:aproc
				})
				.done(function( data ) {
					if (data == -99 || data == null){
						location.href="#error";	}else{
							location.href="#exito";	
						}
				})
				.fail(function(data){
					location.href="#error";
				});
			 });
			 
			 $("#altaesp").submit(function(event){
			 	event.preventDefault();
				var $form = $( this );
				aesp = $form.find( "input[name='aesp']" ).val(),
				url = "php/enviaaltaesp.php";
				var posting = $.post(url,{
					aesp:aesp
				})
				.done(function( data ) {
					if (data == -99 || data == null){
						location.href="#error";	}else{
							location.href="#exito";	
						}
				})
				.fail(function(data){
					location.href="#error";
				});
			 });
			 
			 
	});
//-----FIN DE Document.ready ----------------------//

	</script>

</head>
<body>
	<div id="jqt" class="">
<!--PAGINA PRINCIPAL -->
		<div id="home" target="_self">
		  <div class="toolbar" target="_blank">
		   <h1>StellusApp 1.0</h1>
		    <a class="button leftButton flip" href="#home" target="_self">Home</a>
		    <a class="button rightButton flip" href="logout.html" target="_webapp">Salir</a>
		  </div>
		  <div class="info">
		  	   <h1><?php echo $_SESSION['username']; ?></h1>
		  </div>
		  <div>
		  	 <ul class = "rounded">
			  <li class="arrow" target="_self"><a href="#activ" target="_self">Reporte Actividades</a></li>
			  <li class="arrow" target="_blank"><a href="#estad" target="_self">Estadísticas Hospital</a></li>
			  <li class="arrow" target="_self"><a href="#altamed" target="_self">Registro de Contactos</a></li>
			  <li class="arrow" target="_blank"><a href="#" target="_self">Mi Querido Diario</a></li>
			  <li class="arrow" target="_blank"><a href="#" target="_self">El Diario del Doctor</a></li>
		  	</ul>
		  </div>
		 
		</div>
<!-- REPORTE DE ACTIVIDADES -->		
		<div id="activ">
			<div class="toolbar" target="_blank">
			   <h1>StellusApp 1.0</h1>
			    <a class="button leftButton flip" href="#home" target="_self">Home</a>
			    <a class="button rightButton flip" href="logout.html" target="_webapp">Salir</a>
		  	</div>
		  	<div class="info">
		  		<h1><?php echo $_SESSION['username']; ?></h1>
		    	<h1>REPORTE DE ACTIVIDADES</h1>
		    </div>
		    <form id="reported" class="form" action = "" method="POST">
		    	<ul class="rounded">
		    		 Fecha de la actividad:
		    		 <li class="arrow"><input type="date" name="fecha" id="fecha"></li>
					Actividad:
					 <li class="arrow">
	                            <select id="tactiv" name = "tactiv">
	                            		<option selected="selected"value="">Elija una opción:</option>
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
	                            		<option selected="selected"value="">Elija un producto:</option>
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
						<br />
						<a href="#home" class="redButton">Cancelar</a>
					</div>
		    	</ul>

		    </form>
		</div>
<!-- REGISTRO DE CONTACTOS  -->		
		<div id="altamed">
			<div class="toolbar" target="__self">
			   <h1>StellusApp 1.0</h1>
			    <a class="button leftButton flip" href="#home" target="_self">Home</a>
			    <a class="button rightButton flip" href="logout.html" target="_webapp">Salir</a>
		  	</div>
		  
		  <div id ="tit" class = "info">
				  	<h1><?php echo $_SESSION['username']; ?></h1>
				    <h1>ALTA DE MEDICOS</h1>
				Por favor proporcione los datos del Dr. para incluirlo en la base.
			</div>
		  
				  <div >
					    <form id="faltamed" class="form" action = "" method="POST" >
								
								<ul class = "rounded">
									Datos del médico:
					                	<div id="diddr">
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
					                	<div id="drhosps">
											<li><input  type="text" name="drhosp" placeholder="Hospital" id="drhosp" /></li>
										</div>
										<input type="hidden" name="iddrhosp"  id="iddrhosp" />
											<li><input  type="text" name="dir" placeholder="Dirección" id="dir" /></li>
											<li><input  type="tel" name="trab" placeholder="Tel. trabajo" id="trab" /></li>
											<li><input  type="tel" name="cel" placeholder="Tel. celular" id="cel" /></li>
											<li><input  type="email" name="email" placeholder="E-mail" id="email" /></li>
											<li><input  type="text" name="hor" placeholder="Horario" id="hor" /></li>
											
									</ul>
										<div>
											<a href="#" class="submit greenButton">Enviar</a>
											<br />
											<a href="portalventas.php#activ" class="redButton">Cancelar</a>
										</div>
												
										
					    </form> 
 					</div>
				</div>
<!--OPCION A ALTA DE MEDICO-->		
		<div id="opcionaltamed" class="actionsheet">
                <div class="actionchoices">
                    <fieldset>
                    	<div><h1>No existe Apellido con las letras introducidas</h1> </div>
                        <div><h1>Desea dar de alta al Dr.?</h1> </div>
                        <a href="#altamed" class="whiteButton">Sí,Dar de alta</a>
                        <br />
                        <a href="#activ" class="whiteButton">Volver al reporte</a>
                    </fieldset>
                    <a href="#home" class="redButton dismiss">Cancelar</a>
                </div>
        </div>	
<!--AVISO EL HOSPITAL NO EXISTE-->		
		<div id="avisonohosp" class="actionsheet">
                <div class="actionchoices">
                    <fieldset>
                    	<div><h1>No existe Hospital que inicie con esas letras</h1> </div>
                        <div><h1>Avise al Gerente para dar de alta</h1> </div>
                        <a href="#activ" class="whiteButton">OK</a>
                    </fieldset>
                </div>
            </div>
 <!--ALTA DE PROCEDIMIENTO-->           
        <div id="noproc">
        	<div class = "info">
				  	<h1><?php echo $_SESSION['username']; ?></h1>
				    <h1>ALTA DE PROCEDIMIENTO</h1>
				No hay procedimiento con las letras especificadas.
				Por favor complételo para darlo de alta.	
			</div>
			<form id="altaproc" class="form" action = "" method="POST" >
				<ul class = "rounded">
                	<div id="idaproc">
						<li><input type="text" name="proce" placeholder="Nombre Procedimiento" id="proce" /></li>	
        			</div>																	
			    </ul>
		    	<div>
					<a href="#" class="submit greenButton">Enviar</a>
					<br />
					<a href="portalventas.php#activ" class="redButton">Cancelar</a>
				</div>
			    
			</form>
		</div>			
 <!--ALTA DE ESPECIALIDAD-->       	
       <div id="noesp">
	       	<div class= "info">
	       		<h1><?php echo $_SESSION['username']; ?></h1>
					    <h1>ALTA DE ESPECIALIDAD</h1>
					No hay especialidad médica con las letras especificadas.
					Por favor complétela para darla de alta.
					
	       	</div>
	       	
	       	<form id="altaesp" class="form" action = "" method="POST" >
					<ul class = "rounded">
	                	<div id="idaesp">
							<li><input type="text" name="aesp" placeholder="Nombre de la especialidad" id="aesp" /></li>	
	        			</div>																	
				    </ul>
			    	<div>
						<a href="#" class="submit greenButton">Enviar</a>
						<br />
						<a href="portalventas.php#altamed" class="redButton">Cancelar</a>
					</div>
				    
			</form>
		</div>
<!--ESTADISTICAS DE HOSPITAL-->
  		<div id="estad">
  			 <div class="toolbar" target="_blank">
			   <h1>StellusApp 1.0</h1>
			    <a class="button leftButton flip" href="#home" target="_self">Home</a>
			    <a class="button rightButton flip" href="logout.html" target="_webapp">Salir</a>
			  </div>
			  <div class="info">
		  		<h1><?php echo $_SESSION['username']; ?></h1>
		    	<h1>ESTADISTICAS DE HOSPITAL</h1>
		    </div>
		    <form id="esthospi" name = "esthospi" class="form" action = "php/enviaestad.php" method="POST">
		    	<ul class="rounded">
		    		Fecha:
					<li class="arrow"><input type="date" name="fechaest" id="fechaest"></li>
					<div id="esthosps">
						<li class="arrow"><input  type="text" name="esthosp" placeholder="Hospital" id="esthosp" /></li>
					</div>
	                <input type="hidden" name="idhosp"  id="idhosp" />
	                <li class="arrow"><input  type="number" min = "0" max = "40"  name="numcx" placeholder="Número de Cirugías" id="numcx" /></li>
	                <li class = "arrow"><input type ="text" name="dr1" placeholder="Doctor 1" id="dr1"/></li>
	                <li class = "arrow"><input type ="text" name="proc1" placeholder="Procedimiento 1" id="proc1"/></li>
	                <li class = "arrow"><input type ="text" name="dr2" placeholder="Doctor 2" id="dr2"/></li>
	                <li class = "arrow"><input type ="text" name="proc2" placeholder="Procedimiento 2" id="proc2"/></li>
	                <li class = "arrow"><input type ="text" name="dr3" placeholder="Doctor 3" id="dr3"/></li>
	                <li class = "arrow"><input type ="text" name="proc3" placeholder="Procedimiento 3" id="proc3"/></li>
			    </ul>
			    		<div>
							<a href="#" class="submit greenButton">Enviar</a>
							<br />
							<a href="portalventas.php#home" class="redButton">Cancelar</a>
						</div>
		    </form>

       		</div>
 <!--DIVISIONES DE ENVIO DE DATOS-->      		
       		<div id = "exito">
       			<div class="toolbar">
                    <h1>StellusApp 1.0</h1>
                    <a class="back" href="#">Back</a>
                </div>
       			
       			<div class = "info">
       				<h1>EL ARCHIVO HA SIDO ENVIADO CON EXITO</h1>
       				<a href="portalventas.php" class="greenButton"  target="_webapp">OK</a>
       			</div>
       		</div>
       		<div id = "error">
       			
       			<div class="toolbar">
                    <h1>StellusApp 1.0</h1>
                    <a class="back" href="#">Back</a>
                </div>
                
       			<div class = "info">
       				<h1>ERROR EN EL ENVIO DEL ARCHIVO. INTENTE DE NUEVO</h1>
       				<a href="#" class="redButton atras">OK</a>
       			</div>
       		</div>

			<!--AVISO DE VALIDACION INCORRECTA-->		
		<div id="validado" class="actionsheet">
                <div class="actionchoices">
                    <fieldset>
                    	<div><h1>LA INFORMACION A ENVIAR ESTA INCOMPLETA</h1> </div>
                        <div><h1>Por favor, revise</h1> </div>
                        <a href="#" class="whiteButton atras">Volver al reporte</a>
                    </fieldset>
                </div>
        </div>			
		</div>
<!--FIN DE JQTOUCH DIV-->		
</body>
</html>