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

		$table = 'doctores';
		$usu = $_SESSION['login_user'];
		$pat = $_POST ['pat'];
		$mat = $_POST ['mat'];
		$nombre = $_POST ['nombre'];
		$idhosp = $_POST ['idhosp'];
		$dir = $_POST ['dir'];
		$trab = $_POST ['trab'];
		$cel= $_POST ['cel'];
		$email= $_POST ['email'];
		$hor = $_POST ['hor'];
		$idesp = $_POST ['idesp'];
		$nomcorto = $pat.", ".$nombre;
//insercion en la tabla de actividades		
	    $sqlCommand= "INSERT INTO $table (usualta,paterno,materno,nombre,idhosp,
	    dir,trab,cel,email,hor,idesp,status,nom_corto)
	    VALUES ('$usu','$pat','$mat','$nombre',$idhosp,'$dir','$trab','$cel','$email','$hor','$idesp',1,'$nomcorto')";
			
	    // Execute the query here now
	    $query=mysqli_query($mysqli, $sqlCommand) or die ("error en alta de medico: ".mysqli_error($mysqli)); 

		/* cerrar la conexion */
	    	mysqli_close($mysqli);
		/* enviar a la pagina de confirmacion de resultado */ 
		 
		if(!$query){
						
	  			echo '<script type="text/javascript">
	  					location.href="error.php";
	  				</script>';}else{	
	  			echo '<script type="text/javascript">
	  					location.href="exito.php";
	  				</script>';}
		
?>