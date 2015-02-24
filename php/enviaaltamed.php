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
    	$acentos = $mysqli->query("SET NAMES 'utf8'");
/*** checa login***/
        $funcbase->checalogin($mysqli);
		$mysqli->set_charset("utf-8");
    } else {
        die ("<h1>'No se establecio la conexion a bd'</h1>");
    }

		$table = 'doctores';
		$usu = $_SESSION['login_user'];
		$pat = strtoupper($_POST ['pat']);
		$mat = strtoupper($_POST ['mat']);
		$nombre = strtoupper($_POST ['nombre']);
		$idhosp = $_POST ['iddrhosp'];
		$dir = $_POST ['dir'];
		$trab = $_POST ['trab'];
		$cel= $_POST ['cel'];
		$email= $_POST ['email'];
		$hor = $_POST ['hor'];
		$idesp = $_POST ['idesp'];
		$linic = strtoupper(substr($mat,0,1));
		$nomcorto = $pat." ".$linic.", ".$nombre;
//insercion en la tabla de actividades		
	    $sqlCommand= "INSERT INTO $table (usualta,paterno,materno,nombre,idhosp,
	    dir,trab,cel,email,hor,idesp,status,nom_corto)
	    VALUES ('$usu','$pat','$mat','$nombre',$idhosp,'$dir','$trab','$cel','$email','$hor','$idesp',1,'$nomcorto')";
			
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