<?php
use inventarios\asignarInventarioC\gestionContratista\Sql;

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

if ($_REQUEST ['funcion'] == 'SeleccionTipoBien') {
	
	$cadenaSql = $this->sql->getCadenaSql ( 'ConsultaTipoBien', $_REQUEST ['valor'] );
	$resultadoItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	$resultadoItems = $resultadoItems [0];
	
	echo json_encode ( $resultadoItems );
}

if ($_REQUEST ['funcion'] == 'consultaProveedor') {
	
	$cadenaSql = $this->sql->getCadenaSql ( 'buscar_Proveedores', $_GET ['query'] );
	
	$resultadoItems = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	
	foreach ( $resultadoItems as $key => $values ) {
		$keys = array (
				'value',
				'data' 
		);
		$resultado [$key] = array_intersect_key ( $resultadoItems [$key], array_flip ( $keys ) );
	}
	
	echo '{"suggestions":' . json_encode ( $resultado ) . '}';
}

if ($_REQUEST ['funcion'] == 'consultarIva') {
	
	$cadenaSql = $this->sql->getCadenaSql ( 'consultar_tipo_iva' );
	
	$resultado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	
	$resultado = json_encode ( $resultado );
	
	echo $resultado;
}

if ($_REQUEST ['funcion'] == 'ConsultarContratistas') {
	
	if (isset ( $_REQUEST ['vigencia'] ) == true) {
		
		$vigencia = $_REQUEST ['vigencia'];
	} else {
		
		$vigencia = date ( 'Y' );
	}
	
	$cadenaSql = $this->sql->getCadenaSql ( 'Consultar_Contratistas', $vigencia );
	
	$resultado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
	
	foreach ( $resultado as $valor ) {
		
		$VariableModificar = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
		$VariableModificar .= "&opcion=modificarContratista";
		$VariableModificar .= "&identificador_contratista=" . $valor ['CON_IDENTIFICADOR'];
		$VariableModificar .= "&usuario=" . $_REQUEST ['usuario'];
		$VariableModificar = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $VariableModificar, $directorio );
		
		$resultadoFinal [] = array (
				'vigencia' => "<center>" . $valor ['nombre_tipo_bienes'] . "</center>",
				'numero' => "<center>" . $valor ['placa'] . "</center>",
				'identificacion' => "<center>" . $valor ['descripcion_elemento'] . "</center>",
				'nombre' => "<center>" . $valor ['sede'] . "</center>",
				'fecha_inicio' => "<center>" . $valor ['dependencia'] . "</center>",
				'fecha_final' => "<center>" . $valor ['espaciofisico'] . "</center>",
				'modificar' => "<center><a href='" . $VariableModificar . "'>&#9658; &blk34;</a></center>" 
		)
		;
	}
	
	$resultado = json_encode ( $resultado );
	
	echo $resultado;
}

?>