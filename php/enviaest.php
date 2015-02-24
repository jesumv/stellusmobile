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
						
		$table = 'estadisticas';
		$usu = $_SESSION['login_user'];
		$fecha = $_POST ['fecha'];
		$idesthosp= $_POST ['idesthosp'];
		$nocx= $_POST ['nocx'];
		$dr1 = $_POST ['dr1'];
		$idproc1 = $_POST ['idproc1'];
		$dr2 = $_POST ['dr2'];
		$idproc2 = $_POST ['idproc2'];
		$dr3 = $_POST ['dr3'];
		$idproc3 = $_POST ['idproc3'];
		
//insercion en la tabla de estadisticas	
		$stmt = mysqli_prepare($mysqli, "INSERT INTO $table(usu,fecha,idhosp,nocx,dr1,idproc1,dr2,idproc2,dr3,idproc3)
	    VALUES (?,?,?,?,?,?,?,?,?,?)");

		if ($stmt === false) {
			trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
		}

		$bind = mysqli_stmt_bind_param($stmt, "ssiisisisi",$usu,$fecha,$idesthosp,$nocx,$dr1,$idproc1,$dr2,$idproc2,$dr3,$idproc3);

		if ($bind === false) {
			trigger_error('Bind param failed!', E_USER_ERROR);
		}
		
		$exec = mysqli_stmt_execute($stmt);
		
		/* cerrar la conexion */
	    	mysqli_close($mysqli);

		if ($exec === false) {
			$data =-99;
			echo json_encode($data);	
		}	

		
		 
		
		
