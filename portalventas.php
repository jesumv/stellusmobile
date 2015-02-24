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
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
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
	//FUNCIONES DE REPORTE DE ACTIVIDADES

			//funcion para activar cajas otras y  procedimiento
				$('#tactiv').on('change',function(e){
   					e.preventDefault();
   					var e = document.getElementById('tactiv');
					var item = e.options[e.selectedIndex].value;
					if(item == 1){
						$('#proc').toggle();
						$('#ventatit').toggle();
						$('#venta').toggle();
						$('#dr').focus();
					}else if(item == 3){
						$('#otrot').toggle();
						$('#otrot').focus();
					}					
					else {
						if($("#otrot").is(":visible")){
							$('#otrot').toggle();
						};	
						if($("#proc").is(":visible")){
							$('#proc').toggle();
						};
						if($("#ventatit").is(":visible")){
							$('#ventatit').toggle();
						};
						if($("#venta").is(":visible")){
							$('#venta').toggle();
						};
						$('#dr').focus();
				}	
   					return false;
				});
				
			//funcion para activar caja cantidad	
				$('#venta').on('change',function(e){
   					e.preventDefault();
   					var e = document.getElementById('venta');
					var item = e.options[e.selectedIndex].value;
					if(item != ""){
						$('#cantit').toggle();
						$('#cant').toggle();
						$('#cant').val('1');
						$('#remision').toggle();
						$('#cant').focus();
					}else{
						$('#cant').val("");
						if($('#cantit').is(":visible")){
								$('#cantit').toggle();
							};
							
						if($('#cant').is(":visible")){
							$('#cant').toggle();
						};
					};
   				return false;
				});	
				
//-------------------funciones de jqueryui	--------------------------//
		//-----------FUNCIONES DEL REPORTE DE ACTIVIDADES	---------------//
				//--AUTOCOMPLETAR CAMPOS--//	
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
							$('#hosp').focus();
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
              					
//validación de la forma reporte de actividades--------------------------------------------//
					function validactiv(fecha,tactiv,dr,hosp,proc,venta,cant){
	//validacion de campos obligatorios
						if(fecha ==""||tactiv==""||dr==""||hosp=="")return 1;
	//si la actividad es otra, indicar cual es la otra actividad
						if(tactiv=="3" && otrot=="")return 1;
	//si la actividad es cirugía, indicar cual es el procedimiento
						if(tactiv=="1" && proc=="")return 1;
	//si se indica venta, debe existir cantidad y viceversa
						if(venta!="" && cant=="0")return 1;
						if(venta!="" && cant=="")return 1;
						if(cant> 0 && venta=="")return 1;
						return 0;
					}
				
 //--------------------FUNCIONES DE ESTADISTICAS DE HOSPITAL------------------//
 				 	$('#esthosp').autocomplete({
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
            appendTo:"#esthosps",
            position:{my:"right top",at:"right bottom"},
            select: function( event, ui ) {
            		$("#esthosp").val(ui.item.label);
					$( "#idesthosp" ).val( ui.item.idsuccliente );
					$('#numcx').focus();
				}
				                
        });
                $('#proc1').autocomplete({
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
            appendTo:"#procs1",
            position:{my:"right top",at:"right bottom"},
            select: function( event, ui ) {
            		$("#proc1").val(ui.item.label);
					$( "#idproc1" ).val( ui.item.idproc );
					$('#dr2').focus();
				}
				                
        });
        
        $('#proc2').autocomplete({
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
            appendTo:"#procs2",
            position:{my:"right top",at:"right bottom"},
            select: function( event, ui ) {
            		$("#proc2").val(ui.item.label);
					$( "#idproc2" ).val( ui.item.idproc );
					$('#dr3').focus();
				}
				                
        });
        
        $('#proc3').autocomplete({
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
            appendTo:"#procs3",
            position:{my:"right top",at:"right bottom"},
            select: function( event, ui ) {
            		$("#proc3").val(ui.item.label);
					$( "#idproc3" ).val( ui.item.idproc );
				}
				                
        });
        
//validación de la forma estadisticas de hospital--------------------------------------------//
					function validaest(fechaest,numcx,hosp,dr1,proc1,dr2,proc2,dr3,proc3){
	//validacion de campos obligatorios. solo son exigibles fecha, hospital y no. cirugias
						if(fechaest==""||numcx==""||hosp=="")return 1;
	//si hay 1 cirugía, se exige 1 campo dr y proc
						if(numcx=="1"){
							if(dr1=="" || proc1==""){
								return 1;
							}
						};
	//si hay 2 cirugías, se exigen 2 campos dr y proc
						if(numcx=="2"){
							if(dr1=="" || proc1=="" ||dr2=="" || proc2==""){
								return 1;
							}
						};
	//si hay >2 cirugías, se exigen 3 campos dr y proc
						if(numcx > 2){
							if(dr1=="" || proc1=="" ||dr2=="" || proc2=="" ||dr3=="" || proc3==""){
								return 1;
							}
						};
	//el resultado es correcto
							return 0;

					}
              
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


//reporte de actividades

				$("#activ").submit(function(event){			
					event.preventDefault();
					var $form =$(this);
					var fecha = $form.find( "input[name='fecha']" ).val();
					var tactiv = $form.find( "select[name='tactiv']" ).val();
					var otrot = $form.find( "input[name='otrot']" ).val();
					var dr = $form.find( "input[name='dr']" ).val();
					var iddr = $form.find( "input[name='iddr']" ).val();
					var hosp = $form.find( "input[name='hosp']" ).val();
					var idhosp = $form.find( "input[name='idhosp']" ).val();
					var proc = $form.find( "input[name='proc']" ).val();
					var idproc = $form.find( "input[name='idproc']" ).val();
					var venta = $form.find( "select[name='venta']" ).val();
					var cant = $form.find( "input[name='cant']" ).val();
					var remision= $form.find( "input[name='remision']" ).val();
					var urlf = "php/reporteactiv.php";
					var valida = validactiv(fecha,tactiv,dr,hosp,proc,venta,cant);
					if(valida == 1){
						jQT.goTo("#validado")
					}else{
						var consulta = $.ajax({
			 					url:"php/get_event.php",
		        				data: {
		        				fechaevent:fecha,
		        				iddoctorevent:iddr,
		        				idhospevent:idhosp,
		        			},
		        				type: 'POST',
		        				dataType: 'json'
							});
							
						var exito = function(data){
									if (data == 0){
										jQT.goTo("#repetido")}else{
											var posting = $.post( urlf, {  
												fechaevent: fecha,
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
												location.href="#error";	}
											else{
												location.href="#exito";	
											}
											})
										.fail(function(data){
											location.href="#error";
										});
								}
						}
						var fracaso= function(){
							location.href="#error";
						}
						
						consulta.then( exito,fracaso );
						
					}
					
					
					
		});
		
		
//estadísticas hospital	
						$("#esthospi").submit(function(event){			
					event.preventDefault();
					var $form =$(this);
					var fechaest = $form.find( "input[name='fechaest']" ).val();
					var esthosp = $form.find( "input[name='esthosp']" ).val();
					var idesthosp = $form.find( "input[name='idesthosp']" ).val();
					var numcx= $form.find( "input[name='numcx']" ).val();
					var dr1 = $form.find( "input[name='dr1']" ).val();
					var idproc1 = $form.find( "input[name='idproc1']" ).val();
					var dr2 = $form.find( "input[name='dr2']" ).val();
					var idproc2 = $form.find( "input[name='idproc2']" ).val();
					var dr3 = $form.find( "input[name='dr3']" ).val();
					var idproc3 = $form.find( "input[name='idproc3']" ).val();
					var url = "php/enviaest.php";				
					var valida = validaest(fechaest,numcx,esthosp,dr1,proc1,dr2,proc2,dr3,proc3)
					if(valida == 1){
						jQT.goTo("#validado")
					}else{
						var posting = $.post( url, { 
						fecha: fechaest,
						nocx: numcx,
						idesthosp: idesthosp,
						dr1:dr1,
						idproc1:idproc1,
						dr2:dr2,
						idproc2:idproc2,
						dr3:dr3,
						idproc3:idproc3,
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
//alta de medicos		
			 $("#faltamed").submit(function(event)	{
				event.preventDefault();
				var $form = $( this );
				pat = $form.find( "input[name='pat']" ).val(),
				mat = $form.find( "input[name='mat']" ).val(),
				nombre = $form.find( "input[name='nombre']" ).val(),
				drhosp = $form.find( "input[name='drhosp']" ).val(),
				iddrhosp = $form.find( "input[name='iddrhosp']" ).val(),
				dir = $form.find( "input[name='dir']" ).val(),
				trab = $form.find( "input[name='trab']" ).val(),
				cel= $form.find( "input[name='cel']" ).val(),
				email = $form.find( "input[name='email']" ).val(),
				hor = $form.find( "input[name='hor']" ).val(),
				esp = $form.find( "input[name='esp']" ).val(),
				idesp = $form.find( "input[name='idesp']" ).val(),
				urlM = "php/enviaaltamed.php";
				
				//validación de la forma alta de medicos--------------------------------------------//
					function validaltamed(pat,mat,nombre,iddrhosp,idesp){
	//validacion de campos obligatorios
						if(pat ==""||mat==""||nombre==""||drhosp==""||esp=="")return 1;
					}
					var valida = validaltamed(pat,mat,nombre,iddrhosp,idesp)
					if(valida == 1){
						jQT.goTo("#validado")
					}else{
						var consulta = $.ajax({
			 					url:"php/get_dr.php",
		        				data: {
		        				pat:pat,
		        				mat:mat,
		        				nombre:nombre,
		        			},
		        				type: 'POST',
		        				dataType: 'json'
							});
							
						var exito = function(data){
									if (data == 0){
										jQT.goTo("#drrepe")}else{
											var posting = $.post( urlM, {  
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
												location.href="#error";	}
											else{
												location.href="#exito";	
											}
											})
										.fail(function(data){
											location.href="#error";
										});
										
										
								}
						}
							var fracaso= function(){
										location.href="#error";
							}
						
							consulta.then( exito,fracaso );		
					}
					
														
				
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
//Si se confirma que se desea enviar un evento repetido:			 
			 $("#confirma1").submit(function(event){
			 	event.preventDefault();
			 	var $form =$("#activ");
					var fecha = $form.find( "input[name='fecha']" ).val();
					var tactiv = $form.find( "select[name='tactiv']" ).val();
					var otrot = $form.find( "input[name='otrot']" ).val();
					var dr = $form.find( "input[name='dr']" ).val();
					var iddr = $form.find( "input[name='iddr']" ).val();
					var hosp = $form.find( "input[name='hosp']" ).val();
					var idhosp = $form.find( "input[name='idhosp']" ).val();
					var proc = $form.find( "input[name='proc']" ).val();
					var idproc = $form.find( "input[name='idproc']" ).val();
					var venta = $form.find( "select[name='venta']" ).val();
					var cant = $form.find( "input[name='cant']" ).val();
					var remision= $form.find( "input[name='remision']" ).val();
					var urlf2 = "php/reporteactiv.php";
					
					var posting = $.post( urlf2, {  
												fechaevent: fecha,
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
												location.href="#error";	}
											else{
												location.href="#exito";	
											}
											})
										.fail(function(data){
											location.href="#error";
										});
					
			 });
//si se confirma que se desea registrar un doctor repetido
				$("#confirmadr").submit(function(event){
					event.preventDefault();
					var $form = $("#faltamed" );
					pat = $form.find( "input[name='pat']" ).val(),
					mat = $form.find( "input[name='mat']" ).val(),
					nombre = $form.find( "input[name='nombre']" ).val(),
					drhosp = $form.find( "input[name='drhosp']" ).val(),
					iddrhosp = $form.find( "input[name='iddrhosp']" ).val(),
					dir = $form.find( "input[name='dir']" ).val(),
					trab = $form.find( "input[name='trab']" ).val(),
					cel= $form.find( "input[name='cel']" ).val(),
					email = $form.find( "input[name='email']" ).val(),
					hor = $form.find( "input[name='hor']" ).val(),
					esp = $form.find( "input[name='esp']" ).val(),
					idesp = $form.find( "input[name='idesp']" ).val(),
					urlM = "php/enviaaltamed.php";
					var posting = $.post( urlM, {  
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
												location.href="#error";	}
											else{
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
	                                    <option value =3>Otra</option>
	                            </select>
	                </li>
	                <li class= "info">
	                	<input  type="text" name="otrot" placeholder="Nombre de la otra actividad" id="otrot" style="display:none" />
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
							<li class="info"><input  type="text" name="proc" placeholder="Procedimiento" id="proc" style="display:none" /></li>
					</div>
					<input type="hidden" name="idproc"  id="idproc" />
					<span id="ventatit" style="display:none">Información de la Venta:</span>
					<li class= "arrow">
						<select id="venta" name = "venta" style="display:none">
	                            	<optgroup label="Producto">
	                            		<option selected="selected"value="">Elija un producto:</option>
	                                    <option value =1>Responder</option>
	                                    <option value =2>Seal Foam</option>
	                                </optgroup>
	                    </select>
					</li>
					<span id="cantit" style="display:none">Cantidad:</span>
					<li>
						<input type="number" min="1" max="3" step="1" value="" name="cant" id = "cant" style="display:none">
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
		    <form id="esthospi" name = "esthospi" class="form" action = "" method="POST">
		    	<ul class="rounded">
		    		Fecha:
					<li class="arrow"><input type="date" name="fechaest" id="fechaest"></li>
					<div id="esthosps">
						<li class="arrow"><input  type="text" name="esthosp" placeholder="Hospital" id="esthosp" /></li>
					</div>
	                <input type="hidden" name="idesthosp"  id="idesthosp" />
	                <li class="arrow"><input  type="number" min = "0" max = "40"  name="numcx" placeholder="Número de Cirugías" id="numcx" /></li>
	                <li class = "arrow"><input type ="text" name="dr1" placeholder="Doctor 1" id="dr1"/></li>
	                <div id="procs1">
	                	<li class = "arrow"><input type ="text" name="proc1" placeholder="Procedimiento 1" id="proc1"/></li>
	                	<input type="hidden" name="idproc1"  id="idproc1" />
	                </div>
	                <li class = "arrow"><input type ="text" name="dr2" placeholder="Doctor 2" id="dr2"/></li>
	                <div id="procs2">
	                	<li class = "arrow"><input type ="text" name="proc2" placeholder="Procedimiento 2" id="proc2"/></li>
	                	<input type="hidden" name="idproc2"  id="idproc2" />
	                </div>
	                <li class = "arrow"><input type ="text" name="dr3" placeholder="Doctor 3" id="dr3"/></li>
	                <div id="procs3">
	                	<li class = "arrow"><input type ="text" name="proc3" placeholder="Procedimiento 3" id="proc3"/></li>
	                	<input type="hidden" name="idproc3"  id="idproc3" />
	                </div>
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
       				<h1>EL REPORTE HA SIDO ENVIADO CON EXITO</h1>
       				<a href="portalventas.php" class="greenButton"  target="_webapp">OK</a>
       			</div>
       		</div>
       		<div id = "error">
       			
       			<div class="toolbar">
                    <h1>StellusApp 1.0</h1>
                    <a class="back" href="#">Back</a>
                </div>
                
       			<div class = "info">
       				<h1>ERROR EN EL ENVIO DEL REPORTE. INTENTE DE NUEVO</h1>
       				<a href="#" class="redButton atras">OK</a>
       			</div>
       		</div>

			<!--AVISO DE VALIDACION INCORRECTA-->		
		<div id="validado" class="actionsheet">
                <div class="actionchoices">
                    <fieldset>
                    	<div><h1>LA INFORMACION A ENVIAR ESTA INCOMPLETA,O ES INCORRECTA.</h1> </div>
                        <div><h1>Por favor, revise</h1> </div>
                        <a href="#" class="whiteButton atras">Volver al reporte</a>
                    </fieldset>
                </div>
        </div>
        
  <!--AVISO DE EVENTO REPETIDO-->		
		<div id="repetido" class="actionsheet">
                <div class="actionchoices">
                    <fieldset>
                    	<div><h1>SE HA DETECTADO UNA ACTIVIDAD PREVIA CON CARACTERISTICAS SIMILARES.</h1> </div>
                        <div><h1>¿Desea enviarla de cualquier modo?</h1> </div>
                        <form id="confirma1" name = "confirma1" class="form" action = "" method="POST">
                        	<a href="#" class="submit greenButton">Sí, enviar</a>
                        </form>
                        <br />
                        <a href="#activ" class="whiteButton atras">No, regresar y revisar el reporte</a>
                        <br />
                    	<a href="#home" class="redButton dismiss">No,cancelar el reporte</a>
                    </fieldset>
                </div>
        </div>      
   <!--AVISO DE DOCTOR REPETIDO-->
   		<div id="drrepe" class="actionsheet">
                <div class="actionchoices">
                    <fieldset>
                    	<div><h1>SE HA DETECTADO EN LOS REGISTROS UN DOCTOR CON APELLIDOS IGUALES.</h1> </div>
                        <div><h1>¿Desea registrarlo de cualquier modo?</h1> </div>
                        <form id="confirmadr" name = "confirmadr" class="form" action = "" method="POST">
                        	<a href="#" class="submit greenButton">Sí, enviar</a>
                        </form>
                        <br />
                        <a href="#" class="whiteButton atras">No, regresar y revisar el reporte</a>
                        <br />
                    	<a href="#home" class="redButton dismiss">No,cancelar el reporte</a>
                    </fieldset>
                </div>
        </div>
   		      
        			
		</div>
<!--FIN DE JQTOUCH DIV-->		
</body>
</html>