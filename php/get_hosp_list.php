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
	
	
	
    $req = "SELECT idsuccliente,nom_corto FROM succliente WHERE nom_corto like '" 
    . mysqli_real_escape_string($mysqli,$_GET['term']) . "%' && status <> 2"; 
	
    $query = mysqli_query($mysqli,$req);
    
    while($row = mysqli_fetch_array($query))
    {
		$results[] = array_map('utf8_encode',array('label' => $row['nom_corto'],'idsuccliente' 
        => $row['idsuccliente']));
    }
	
	
	 /* liberar la serie de resultados */
	    mysqli_free_result($query);
	    /* cerrar la conexion */
	    mysqli_close($mysqli);

		/*funcion de conversion de caracteres */
		/* rutina para detectar falta de resultados */	
		if(!isset($results)){
			$results = -99;
			echo json_encode($results);
		}else{
			echo json_encode($results);
		};


?>