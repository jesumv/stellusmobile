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
	
/***asignaci�n de variables ***/
	$fecha = $_POST ['fechaevent'];
	$idhosp= $_POST ['idhospevent'];
	$idr= $_POST ['iddoctorevent'];
    $req = "SELECT idactividades FROM actividades WHERE iddr =".$idr." AND fecha ='".$fecha."' AND idhosp =".$idhosp ;
	
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