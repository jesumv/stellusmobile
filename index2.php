<?php

 /*** Autoload class files ***/
    function __autoload($class){
      require('include/' . strtolower($class) . '.class.php');
    }
    //directiva a la conexion con base de datos
    $funcbase = new dbutils;
    $mysqli = $funcbase->conecta();
	
 /*** si se establecio la conexion***/
    if (is_object($mysqli)) {
        session_start();

        $error = "";

            if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                // username and password sent from form 
                $myusername=mysqli_real_escape_string ($mysqli,$_POST['username']);
                $mypassword=mysqli_real_escape_string($mysqli,$_POST['password']); 
                $sql=sprintf("SELECT id,nombre,empresa,nivel FROM usuarios WHERE username='$myusername' 
                and passcode=(AES_ENCRYPT('%s','%s'))",$mypassword,$mypassword);
                $result=mysqli_query($mysqli,$sql);
                $row=mysqli_fetch_array($result);
                $nivel =$row[3];
                $username = $row[1];
                $empre = $row[2];
                
                $count=mysqli_num_rows($result);
                
                $result->free();
                
                $mysqli->close();
                
                // If result matched $myusername and $mypassword, table row must be 1 row
                if($count==1)
                {
                    
                $_SESSION['login_user']=$myusername;
                $_SESSION['username']=$username;
                $_SESSION['nivel']=$nivel;
                $_SESSION['empresa']=$empre;
				$depto = "0";
                
                //seleccion de hoja según empresa
                    switch ($depto) {
                        case 0:
                            header("location: portalventas.php");
                            break;
						case 1:
							header("location: portaladmin.php");
                        	break;
                        default:
                             header("location: php/logout.php");
                            break;
                    }
                
            
            }
        //los datos de acceso no son correctos    
        else 
            {
                $error="Su nombre de usuario o contraseña son invalidos";
            }
        }
        
    } else {
        die ("<h1>'No se establecio la conexion a bd'</h1>");
    }
    
?>

<!doctype html>
<head>
	<link rel="shortcut icon" href="img/logomin.gif" type="image/x-icon"/>
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"/>
	<title>STELLUS MEDEVICES</title>
	<meta name="description" content="pagina de entrada">
	<meta name="author" content="jmv">
	<meta name="viewport" content="width=device-width">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="stylesheet" href="css/jqtouch.css">
	<link rel="stylesheet" href="css/apple.css">
	<link rel="stylesheet" href="css/jquery-ui-1.10.4.custom.min.css">
	<!-- end CSS-->
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
			
			});
	</script>
</head>

<body>
	
<div id="jqt" class="">
	<div id="home" target="_self">
		<div class="toolbar" target="_blank">
		   <h1>StellusApp 1.0</h1>
		    <a class="button leftButton flip" href="#home" target="_self">Home</a>
		    <a class="button rightButton flip" href="logout.html" target="_blank">Salir</a>
		  </div>
	</div>
<!--copia de la rutina login original -->	
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
    <header>
		<div id="header"></div>     		
    </header>
    <div id="main" role="main">
		 <div id="bandasup">

            	<div >
	            	<span id="titprinc">Stellus Medevices</span>
	            	<div id="loginbox">
		            	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		            			<div class="entra1">
			            			<label class="box1">Usuario:</label><input type="text" name="username" id="username" />
			            		</div>
			            		<div class = "entra1">
			            			<label class="box1">Contraseña:</label><input type="password" name="password" id="password" />
			            		</div>
			            		<div class= "botonintro">
			            			<input type="submit" value=" Iniciar Sesión "/>
			            		</div> 		
	                    </form>            
                        <div id="error"> <?php echo $error; ?></div>
                	</div>
	            	<div>
	            		<img id="logoprinc1" src="img/nuevologosimp.jpg" alt="logo stellus" />
	            	</div>        
                 </div>    
           </div>      	
    </div>
    <footer>
		<div id="footer"></div>
    </footer>

  
</body>
</html>
