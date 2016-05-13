<?php 



//Conexion con DB

function dbConnect(){

	static $conexion;

	if(!isset($conexion)){
		$config = parse_ini_file("dbparam.ini");
		$conexion = mysqli_connect($config['servername'],$config['username'],$config['password'],$config['dbname']);
		
	}

	if(!$conexion){
		return mysqli_connect_error();

	}

		return $conexion;
}

function nombreTabla(){
	$config = parse_ini_file("dbparam.ini");
	$table_name = $config['tablename'];

	return $table_name;
}
// Error Handler
function dbError(){

	$conexion = dbConnect();
	return mysqli_error($conexion);
}

//Ejecución de consultas

function dbQuery($query){

	$conexion = dbConnect();
	$result = mysqli_query($conexion, $query);

	return $result;
}	
//Insercion de datos

$query = "INSERT INTO `".nombreTabla()."` (`ID`, `FECHA`, `HORA`, `LATITUD`, `LONGITUD`) VALUES (ABS(NULL), '".$_GET["fecha"]."', '".$_GET["hora"]."', '".$_GET["lat"]."', '".$_GET["lon"]."')";

$result = dbQuery($query);

	if(!$result){
		$error = dbError();
		echo $error;
	}else{
		echo "Coordinates succesfully uploaded to database.";
	}


?>