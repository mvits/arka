<?php
use inventarios\gestionElementos\modificarElemento\Sql;

$ruta = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" );

$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/plugin/html2pfd/";

include ($ruta . "/plugin/scripts/javascript/dataTable/ssp.class.php");

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
$directorio = $this->miConfigurador->getVariableConfiguracion ( "host" );
$directorio .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/index.php?";
$directorio .= $this->miConfigurador->getVariableConfiguracion ( "enlace" );

$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "host" );
$rutaBloque .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/";
$rutaBloque .= $esteBloque ['grupo'] . '/' . $esteBloque ['nombre'];

$miPaginaActual = $this->miConfigurador->getVariableConfiguracion ( 'pagina' );

if ($_REQUEST ['funcion'] == 'Consulta') {
	
	/*
	 * DataTables example server-side processing script.
	 *
	 * Please note that this script is intentionally extremely simply to show how
	 * server-side processing can be implemented, and probably shouldn't be used as
	 * the basis for a large complex system. It is suitable for simple use cases as
	 * for learning.
	 *
	 * See http://datatables.net/usage/server-side for full details on the server-
	 * side processing requirements of DataTables.
	 *
	 * @license MIT - http://datatables.net/license_mit
	 */
	
	/*
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	// DB table to use
	$table = 'arka_inventarios.elemento ';
	
	// Table's primary key
	$primaryKey = 'id_elemento';
	
	// DB JOINS
	$join [] = " JOIN arka_inventarios.tipo_bienes  ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
	$join [] = " JOIN arka_inventarios.entrada  ON entrada.id_entrada = elemento.id_entrada ";
	$join [] = " JOIN arka_inventarios.elemento_individual  ON elemento_individual.id_elemento_gen = elemento.id_elemento ";
	
	$join = implode ( " ", $join );
	
	// DB WHERE
	
	$arreglo = unserialize ( $_REQUEST ['arreglo'] );
	
	if ($arreglo ['fecha_inicio'] != '') {
		$where [] = "elemento.fecha_registro BETWEEN CAST ( '" . $arreglo ['fecha_inicio'] . "' AS DATE) AND  CAST ( '" . $arreglo ['fecha_final'] . "' AS DATE)  ";
	} else {
		$where [] = '1=1';
	}
	if ($arreglo ['placa'] != '') {
		$where [] = "elemento_individual.placa = '" . $arreglo ['placa'] . "' ";
	} else {
		
		$where [] = '1=1';
	}
	if ($arreglo ['serie'] != '') {
		$where [] = "elemento.serie= '" . $arreglo ['serie'] . "' ";
	} else {
		
		$where [] = '1=1';
	}
	
	$where = implode ( " AND ", $where );
	
	if ($arreglo ['fecha_inicio'] == '' && $arreglo ['placa'] == '' && $arreglo ['serie'] == '') {
		$where = '';
	}
	
	// Array of database columns which should be read and sent back to DataTables.
	// The `db` parameter represents the column name in the database, while the `dt`
	// parameter represents the DataTables column identifier. In this case simple
	// indexes
	$columns = array (
			array (
					'db' => 'elemento_individual.placa',
					'dt' => 0
			),
			array (
					'db' => 'elemento.serie',
					'dt' => 1 
			),
			array (
					'db' => 'tipo_bienes.descripcion',
					'dt' => 2
			),
			array (
					'db' => 'elemento.fecha_registro',
					'dt' => 3
			),
			array (
					'db' => 'elemento.id_elemento',
					'dt' => 4
			),
			array (
					'db' => 'entrada.estado_entrada',
					'dt' => 5 
			),
			array (
					'db' => 'entrada.cierre_contable',
					'dt' => 6 
			) 
	);
	
// 	var_dump($esteRecursoDB);exit;
	// SQL server connection information
	$sql_details = array (
			'user' => $esteRecursoDB-> usuario,
			'pass' => $esteRecursoDB->clave,
			'db' => $esteRecursoDB->db,
			'host' => $esteRecursoDB->servidor 
	);
	
// 	var_dump($sql_details);exit;
	/*
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP
	 * server-side, there is no need to edit below this line.
	 */
	
	echo json_encode ( SSP::simple ( $_GET, $sql_details, $table, $primaryKey, $columns,$join,$where ) );
}

if ($_REQUEST ['funcion'] == 'consultaPlacas') {
	
	$cadenaSql = $this->sql->getCadenaSql('buscar_placa',$_GET['query']);
	$resultadoItems = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
		

	foreach ($resultadoItems as $key => $values) {
		$keys = array('value', 'data');
		$resultado[$key] = array_intersect_key($resultadoItems[$key], array_flip($keys));
	}
	
	//    var_dump($resultado);
	
// 	echo json_encode($resultadoItems);
	echo '{"suggestions":'.json_encode($resultado).'}';
	
	
}


if ($_REQUEST ['funcion'] == 'consultaSerie') {

	$cadenaSql = $this->sql->getCadenaSql('buscar_serie',$_GET['query']);
	$resultadoItems = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


	foreach ($resultadoItems as $key => $values) {
		$keys = array('value', 'data');
		$resultado[$key] = array_intersect_key($resultadoItems[$key], array_flip($keys));
	}

	//    var_dump($resultado);

	// 	echo json_encode($resultadoItems);
	echo '{"suggestions":'.json_encode($resultado).'}';


}


if ($_REQUEST ['funcion'] == 'consultaEntrada') {

	$cadenaSql = $this->sql->getCadenaSql('buscar_entradas',$_GET['query']);
	
	
	$resultadoItems = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
	

	foreach ($resultadoItems as $key => $values) {
		$keys = array('value', 'data');
		$resultado[$key] = array_intersect_key($resultadoItems[$key], array_flip($keys));
	}

	//    var_dump($resultado);

	// 	echo json_encode($resultadoItems);
	echo '{"suggestions":'.json_encode($resultado).'}';


}






?>
