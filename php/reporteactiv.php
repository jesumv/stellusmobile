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
    } else {
        die ("<h1>'No se establecio la conexion a bd'</h1>");
    }

		$table = 'actividades';
		$usu = $_SESSION['login_user'];
		$fecha = $_POST ['fechaevent'];
		$activ = $_POST ['tactiv'];
		$otra = $_POST ['otrot'];
		$iddr = $_POST ['iddr'];
		$idhosp = $_POST ['idhosp'];
		$idproc = $_POST ['idproc'];
		$idproductos = $_POST ['venta'];
		$cant = $_POST ['cant'];
		$remi = $_POST ['remision'];
		
//insercion en la tabla de actividades		
	    $sqlCommand= "INSERT INTO $table (usu,fecha,activ,otra,iddr,idhosp,idproc,idproductos,cant,idremisiones)
	    VALUES ('$usu','$fecha',$activ,'$otra',$iddr,$idhosp,'$idproc','$idproductos','$cant','$remi')";
			
	    // Execute the query here now
	    $query=mysqli_query($mysqli, $sqlCommand); 

		/* cerrar la conexion */
	    	mysqli_close($mysqli);
		/* enviar a la pagina de confirmacion de resultado */ 
		 
		if(!$query){
			$data =-99;
			echo json_encode($data);	
	  	}
		
