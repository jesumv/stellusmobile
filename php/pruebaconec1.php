<?php
function __autoload($class){
	require('../include/' . strtolower($class) . '.class.php');
}

$funcbase = new dbutils;
/*** conexion a bd ***/
$mysqli = $funcbase->conecta();
if (is_object($mysqli)) {

} else {
	die ("<h1>'No se establecio la conexion a bd'</h1>");
}
		
	  				$table = 'actividades';
	  				
	  				//insercion en la tabla de actividades
	  				$sqlCommand= "INSERT INTO $table (usu,fecha,activ,otra,iddr,idhosp,idproc,idproductos,cant,idremisiones)
	  				VALUES ('j.maldonado',ABC,1,'prueba otra',1,1,1,1,4,'5555')";
	  					
	  				// Execute the query here now
	  				$query=mysqli_query($mysqli, $sqlCommand);
	  				
	  				/* enviar a la pagina de confirmacion de resultado */	
	  				if(!$query){echo '<script type="text/javascript">
							alert("error: ".mysqli_error($mysqli);
	  				</script>';
	  				
	  				}else{echo '<script type="text/javascript">

	  										alert("exito);
	  								</script>';
	  								
	  								/* cerrar la conexion */
	  				mysqli_close($mysqli);}
?>

<!doctype html>
<head>

<head>
<body>
<h1>PRUEBA DE CONEXION </h1>
</body>
</html>  				