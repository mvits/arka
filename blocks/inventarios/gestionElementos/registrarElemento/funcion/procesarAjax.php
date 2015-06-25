<?php
use inventarios\gestionCompras\registrarOrdenCompra\Sql;

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

if ($_REQUEST ['funcion'] == 'SeleccionTipoBien') {

	
	$cadenaSql = $this->sql->getCadenaSql ( 'ConsultaTipoBien', $_REQUEST['valor'] );
	$resultadoItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	$resultadoItems=$resultadoItems[0];

	echo json_encode($resultadoItems);
}

?>