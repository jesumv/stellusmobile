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
	
	<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"/>
	<title>STELLUS MEDEVICES</title>
	<link rel="shortcut icon" href="img/logomin.gif" />
	<meta name="description" content="pagina de inicio">
	<meta name="author" content="jmv">
	<!-- Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/plantilla2.css">
	  <!-- end CSS-->
	
</head>

<body class="fondocolor">

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
