<?php
use inventarios\gestionCompras\registrarOrdenCompra\Sql;

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

if (isset ( $_REQUEST ['funcion'] ) && $_REQUEST ['funcion'] == 'estado') {

	switch ($_REQUEST ['cls_entr']) {

		case '1' :
				
			$cadenaSql = $this->sql->getCadenaSql ( 'tipo_contrato_avance' );
			$datos = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			$datos = json_encode ( $datos );
			break;

		case '' :
				
			$datos = 'Error';
				
			break;

		default :
			$cadenaSql = $this->sql->getCadenaSql ( 'tipo_contrato' );
			$datos = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
			$datos = json_encode ( $datos );
			break;
	}

	echo $datos;
}


if ($_REQUEST ['funcion'] == 'SeleccionOrdenador') {

	$conexion = "sicapital";
	$esteRecursoDBO = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

	$cadenaSql = $this->sql->getCadenaSql ( 'informacion_ordenador', $_REQUEST ['ordenador'] );
	$resultadoItems = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );

	$resultado = json_encode ( $resultadoItems [0] );

	echo $resultado;
}

if ($_REQUEST ['funcion'] == 'consultarDependencia') {

	$conexion = "sicapital";

	$esteRecursoDBO = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );


	$cadenaSql = $this->sql->getCadenaSql ( 'dependenciasConsultadas', $_REQUEST['valor'] );

	$resultado = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );


	$resultado = json_encode ( $resultado);

	echo $resultado;
}




if ($_REQUEST ['funcion'] == 'consultarActa') {


	$cadenaSql = $this->sql->getCadenaSql ( 'consultarActas', $_REQUEST['valor'] );

	$resultado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );

	$resultado=$resultado[0];


	$resultado = json_encode ( $resultado);

	echo $resultado;
}








?>


