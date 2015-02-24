<?php
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
	
/***asignación de variables ***/
	$paterno = $_POST ['pat'];
	$materno= $_POST ['mat'];
	$nombre= $_POST ['nombre'];
    $req = "SELECT iddoctores FROM doctores WHERE paterno ='".$paterno."' AND materno ='".$materno."' AND nombre ='".$nombre."'";
	
	$query = mysqli_query($mysqli,$req);
	
	/* rutina para detectar falta de resultados */	   
    if (mysqli_num_rows($query)>0) {
			$resultado = 0;
			
	    } else {
	    	$resultado = -99;
			
			
	 /* liberar la serie de resultados */
	    mysqli_free_result($query);
	    /* cerrar la conexion */
	    mysqli_close($mysqli);
		
}

	echo json_encode($resultado);

?>