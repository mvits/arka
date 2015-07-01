<?php
use inventarios\gestionCompras\registrarOrdenCompra\Sql;


$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

if ($_REQUEST ['funcion'] == 'consultarDependencia') {

	$conexion = "sicapital";

	$esteRecursoDBO = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );


	$cadenaSql = $this->sql->getCadenaSql ( 'dependenciasConsultadas', $_REQUEST['valor'] );
	$resultado = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );


	$resultado = json_encode ( $resultado);

	echo $resultado;
}


if ($_REQUEST ['funcion'] == 'consultarUbicacion') {

	$conexion = "sicapital";

	$esteRecursoDBO = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );


	$cadenaSql = $this->sql->getCadenaSql ( 'ubicacionesConsultadas', $_REQUEST['valor'] );
	$resultado = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );


	$resultado = json_encode ( $resultado);

	echo $resultado;
}



?>
