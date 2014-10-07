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
	
	
	
    $req = "SELECT idespecialidades,especialidad FROM especialidades WHERE especialidad like '" 
    . mysqli_real_escape_string($mysqli,$_GET['term']) . "%' && status <> 2"; 
	
    $query = mysqli_query($mysqli,$req);
    
    while($row = mysqli_fetch_array($query))
    {
		$results[] = array_map('utf8_encode',array('label' => $row['especialidad'],'idespecialidades' 
        => $row['idespecialidades']));
    }
	
	
	 /* liberar la serie de resultados */
	    mysqli_free_result($query);
	    /* cerrar la conexion */
	    mysqli_close($mysqli);
		/*funcion de conversion de caracteres */
		
    	
		
    	echo json_encode($results);


?>