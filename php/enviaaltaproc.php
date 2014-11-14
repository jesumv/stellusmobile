<?php
/***Esta funcion hace la consulta de insercion de medicos la bd***/
/*** Autoload class files ***/ 
     function __autoload($class){
      require('../include/' . strtolower($class) . '.class.php');
    }
    
    $funcbase = new dbutils;
/*** conexion a bd ***/
    $mysqli = $funcbase->conecta();
    if (is_object($mysqli)) {
/*** checa login***/
        $funcbase->checalogin($mysqli);
		$mysqli->set_charset("utf8");
    } else {
        die ("<h1>'No se establecio la conexion a bd'</h1>");
    }

		$table = 'procedimientos';
		$usu = $_SESSION['login_user'];
		$nombre = $_POST ['proc'];
//insercion en la tabla de actividades		
	    $sqlCommand= "INSERT INTO $table (usu,nombre)
	    VALUES ('$usu','$nombre')";
			
	    // Execute the query here now
	    $query=mysqli_query($mysqli, $sqlCommand); 

		/* cerrar la conexion */
	    	mysqli_close($mysqli);
		/* enviar a la pagina de confirmacion de resultado */ 
		 
		if(!$query){
			$data =-99;
			echo json_encode($data);	
	  	}
							  			
		
?>