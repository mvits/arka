<?php
use inventarios\gestionActa\registrarActa\Sql;

$ruta = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" );

$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/plugin/html2pfd/";

include ($ruta . "/plugin/scripts/javascript/dataTable/ssp.class.php");

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

// ********************
$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
$directorio = $this->miConfigurador->getVariableConfiguracion ( "host" );
$directorio .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/index.php?";
$directorio .= $this->miConfigurador->getVariableConfiguracion ( "enlace" );

$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "host" );
$rutaBloque .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/";
$rutaBloque .= $esteBloque ['grupo'] . '/' . $esteBloque ['nombre'];

$miPaginaActual = $this->miConfigurador->getVariableConfiguracion ( 'pagina' );

// *************************************

if ($_REQUEST ['funcion'] == 'tablaItems') {
	$tabla = new stdClass ();
	
	$page = $_GET ['page'];
	
	$limit = $_GET ['rows'];
	
	$sidx = $_GET ['sidx'];
	
	$sord = $_GET ['sord'];
	
	if (! $sidx)
		$sidx = 1;
		
		// ------------------
	
	$cadenaSql = $this->sql->getCadenaSql ( 'items', $_REQUEST ['tiempo'] );
	// echo $cadenaSql;
	$resultadoItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	
	// ---------------------
	$filas = count ( $resultadoItems );
	
	if ($filas > 0 && $limit > 0) {
		$total_pages = ceil ( $filas / $limit );
	} else {
		$total_pages = 0;
	}
	
	if ($page > $total_pages)
		$page = $total_pages;
	
	$start = $limit * $page - $limit;
	
	if ($resultadoItems != false) {
		$tabla->page = $page;
		$tabla->total = $total_pages;
		$tabla->records = $filas;
		
		$i = 0;
		
		foreach ( $resultadoItems as $row ) {
			$tabla->rows [$i] ['id'] = $row ['id_items'];
			$tabla->rows [$i] ['cell'] = array (
					$row ['item'],
					$row ['cantidad'],
					$row ['descripcion'],
					$row ['valor_unitario'],
					$row ['valor_total'] 
			);
			$i ++;
		}
		
		$tabla = json_encode ( $tabla );
		
		echo $tabla;
	} else {
		
		$tabla->page = $page;
		$tabla->total = $total_pages;
		$tabla->records = $filas;
		
		$i = 0;
		
		$tabla->rows [0] ['id'] = '0';
		$tabla->rows [0] ['cell'] = array (
				' ',
				'0.00',
				' ',
				'0.00',
				'0.00' 
		);
		
		$tabla = json_encode ( $tabla );
		
		echo $tabla;
	}
}
if ($_REQUEST ['funcion'] == 'AgregarItem') {
	
	$cadenaSql = $this->sql->getCadenaSql ( 'id_items_temporal' );
	$idItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	$id = $idItems [0] [0] + 1;
	
	if ($idItems [0] [0] != null) {
		
		$datos = array (
				$id,
				$_GET ['item'],
				$_GET ['cantidad'],
				$_GET ['descripcion'],
				$_GET ['valor_unitario'],
				$_GET ['cantidad'] * $_GET ['valor_unitario'],
				$_REQUEST ['tiempo'] 
		);
	} else {
		$datos = array (
				'1',
				$_GET ['item'],
				$_GET ['cantidad'],
				$_GET ['descripcion'],
				$_GET ['valor_unitario'],
				$_GET ['cantidad'] * $_GET ['valor_unitario'],
				$_REQUEST ['tiempo'] 
		);
	}
	
	// ------------------
	
	$cadenaSql = $this->sql->getCadenaSql ( 'insertarItem', $datos );
	$resultadoItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
	echo $resultadoItems;
	// ---------------------
}

if ($_REQUEST ['funcion'] == 'EliminarItem') {
	
	$cadenaSql = $this->sql->getCadenaSql ( 'eliminarItem', $_GET ['id'] );
	$resultadoItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "acceso" );
	
	echo $resultadoItems;
}

$conexion2 = "sicapital";
$esteRecursoDB2 = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion2 );

if ($_REQUEST ['funcion'] == 'proveedor') {
	$cadenaSql = $this->sql->getCadenaSql ( 'select_proveedor', $_REQUEST ['proveedor'] );
	$resultadoItems = $esteRecursoDB2->ejecutarAcceso ( $cadenaSql, "busqueda" );
	$resultado = json_encode ( $resultadoItems [0] );
	echo $resultado;
}

if ($_REQUEST ['funcion'] == 'consultarDependencia') {
	
	$conexion = "sicapital";
	
	$esteRecursoDBO = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
	
	$cadenaSql = $this->sql->getCadenaSql ( 'dependenciasConsultadas', $_REQUEST ['valor'] );
	
	$resultado = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );
	
	$resultado = json_encode ( $resultado );
	
	echo $resultado;
}

if ($_REQUEST ['funcion'] == 'SeleccionOrdenador') {
	
	$conexion = "sicapital";
	$esteRecursoDBO = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
	
	$cadenaSql = $this->sql->getCadenaSql ( 'informacion_ordenador', $_REQUEST ['ordenador'] );
	$resultadoItems = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );
	
	$resultado = json_encode ( $resultadoItems [0] );
	
	echo $resultado;
}

if ($_REQUEST ['funcion'] == 'consultarInfoContrato') {
	
	$cadenaSql = $this->sql->getCadenaSql ( 'informacionContrato', $_REQUEST ['valor'] );
	$resultado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	$resultado = $resultado [0];
	$resultado = json_encode ( $resultado );
	
	echo $resultado;
}

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
	
	$arreglo = unserialize ( $_REQUEST ['datos'] );
	
	// DB table to use
	
	$table = '';
	
	if (isset ( $arreglo ['tipo'] ) && $arreglo ['tipo'] == 'Orden de Servicios') {
		
		$table = 'arka_inventarios.orden_servicio ';
	}
	
	if (isset ( $arreglo ['tipo'] ) && $arreglo ['tipo'] == 'Orden de Compra') {
		
		$table = 'arka_inventarios.orden_compra ';
	}
	
	// Table's primary key
	$primaryKey = '';
	
	if (isset ( $arreglo ['tipo'] ) && $arreglo ['tipo'] == 'Orden de Servicios') {
		
		$primaryKey = ' id_orden_servicio ';
	}
	
	if (isset ( $arreglo ['tipo'] ) && $arreglo ['tipo'] == 'Orden de Compra') {
		
		$primaryKey = ' id_orden_compra ';
	}
	
	// DB JOINS
	// $join [] = " JOIN arka_inventarios.tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
	// $join [] = " JOIN arka_inventarios.entrada ON entrada.id_entrada = elemento.id_entrada ";
	// $join [] = " JOIN arka_inventarios.elemento_individual ON elemento_individual.id_elemento_gen = elemento.id_elemento ";
	
	// $join = implode ( " ", $join );
	
	$join = '';
	
	// DB WHERE
	
	if (isset ( $arreglo ['fechaInicio'] ) && $arreglo ['fechaInicio'] != '') {
		$where [] = " fecha_registro BETWEEN CAST ( '" . $arreglo ['fechaInicio'] . "' AS DATE) AND  CAST ( '" . $arreglo ['fechaFinal'] . "' AS DATE) ";
	} else {
		$where [] = '1=1';
	}
	
	$where = implode ( " AND ", $where );
	
	// Array of database columns which should be read and sent back to DataTables.
	// The `db` parameter represents the column name in the database, while the `dt`
	// parameter represents the DataTables column identifier. In this case simple
	// indexes
	
	if (isset ( $arreglo ['tipo'] ) && $arreglo ['tipo'] == 'Orden de Servicios') {
		
		$columns = array (
				array (
						'db' => 'id_orden_servicio',
						'dt' => 0 
				),
				array (
						'db' => 'fecha_registro',
						'dt' => 1 
				) 
		)
		;
	}
	
	if (isset ( $arreglo ['tipo'] ) && $arreglo ['tipo'] == 'Orden de Compra') {
		
		$columns = array (
				array (
						'db' => 'id_orden_compra',
						'dt' => 0 
				),
				array (
						'db' => 'fecha_registro',
						'dt' => 1 
				) 
		)
		;
	}
	
	// var_dump($esteRecursoDB);exit;
	// SQL server connection information
	$sql_details = array (
			'user' => $esteRecursoDB->usuario,
			'pass' => $esteRecursoDB->clave,
			'db' => $esteRecursoDB->db,
			'host' => $esteRecursoDB->servidor 
	);
	
	
	
	$parametros_enlace = array (
			'pagina' => $this->miConfigurador->getVariableConfiguracion ( "pagina" ),
			'opcion' => 'asociarActa',
			'parametros' => array(
					'id'=>($arreglo['tipo']=='Orden de Compra')?'id_orden_compra':($arreglo['tipo']=='Orden de Servicios')?'id_orden_servicio':'null',
					'fecha'=>'fecha_registro',
					'tipo'=>$arreglo['tipo'],
					
			)
	);
	
	
	/*
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP
	 * server-side, there is no need to edit below this line.
	 */
	
	echo json_encode ( SSP::simple ( $_GET, $sql_details, $table, $primaryKey, $columns, $join, $where,$parametros_enlace) );
}

?>