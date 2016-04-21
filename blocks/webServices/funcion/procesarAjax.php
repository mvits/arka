<?php
// var_dump ( $_REQUEST );
$this->ruta = $this->miConfigurador->getVariableConfiguracion ( "rutaBloque" );

$atributosGlobales ['campoSeguro'] = 'true';
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

$conexion = "inventarios";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

$conexion = "sicapital";
$esteRecursoDBO = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

if (isset ( $_REQUEST ['webServices'] ) && $_REQUEST ['webServices'] == 'true') {
	
	$_REQUEST ['usuario'] = 'ACTUALIZACIÓN_PARAMETROS';
	
	switch ($_REQUEST ['funcion']) {
		
		case 'actualizarParametros' :
			
			switch ($_REQUEST ['tipo_parametro']) {
				
				case 'proveedores' :
					
					$cadenaSql = $this->sql->getCadenaSql ( 'Consulta_Proveedores_Sicapital' );
					
					$datos_proveedores_sic = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );
					if ($datos_proveedores_sic != false) {
						foreach ( $datos_proveedores_sic as $valor ) {
							
							$cadenaSql = $this->sql->getCadenaSql ( 'validacion_proveedores', $valor ['PRO_IDENTIFICADOR'] );
							
							$consulta_proveedor = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
							
							if ($consulta_proveedor == false) {
								
								$arreglo_cadenas = $this->sql->getCadenaSql ( 'registro_proveedores', $valor );
								
								$registrarProveedor = $esteRecursoDB->ejecutarAcceso ( $arreglo_cadenas, "acceso", $valor, "registro_proveedores" );
							}
						}
						
						$arregloProcesos [] = array (
								'status' => "Exito",
								'Proceso' => "Registrar Proveedores" 
						);
					} else {
						$arregloProcesos [] = array (
								'status' => "Error",
								'Proceso' => "Registrar Proveedores" 
						);
					}
					
					if ($datos_proveedores_sic != false) {
						
						$cadenaSql = $this->sql->getCadenaSql ( 'consulta_informacion_proveedores' );
						
						$datos_proveedores_psql = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
						
						echo count ( $datos_proveedores_psql ) . " - " . count ( $datos_proveedores_sic );
						
						var_dump ( $datos_proveedores_psql );
						exit ();
						
						for($i = 0; $i <= count ( $datos_proveedores_sic ); $i ++) {
							
							if ($datos_proveedores_sic [$i]['PRO_IDENTIFICADOR'] == $datos_proveedores_psql [$i]['PRO_IDENTIFICADOR']) {
								
								
								
								
								
								
								
							}
						}
						
						// foreach ( $datos_proveedores_sic as $valor ) {
						
						// if ($consulta_proveedor == false) {
						
						// $arreglo_cadenas = $this->sql->getCadenaSql ( 'registro_proveedores', $valor );
						
						// $registrarProveedor = $esteRecursoDB->ejecutarAcceso ( $arreglo_cadenas, "acceso", $valor, "registro_proveedores" );
						// }
						// }
						
						$arregloProcesos [] = array (
								'status' => "Exito",
								'Proceso' => "Actualizar Información  Proveedores" 
						);
					} else {
						$arregloProcesos [] = array (
								'status' => "Error",
								'Proceso' => "Actualizar Información  Proveedores" 
						);
					}
					
					break;
			}
			
			break;
		
		default :
			for($i = 0; $i < 1000000; $i ++) {
				
				$i = $i + $i;
			}
			
			break;
	}
	
	$resultadoFinal [] = array (
			"accion" => $arregloProcesos,
			'fecha' => date ( 'Y-m-d' ) 
	);
} else {
	
	$resultadoFinal [] = array (
			"Error" => "Acceso Web Service",
			'fecha' => date ( 'Y-m-d' ) 
	);
}

$resultado = json_encode ( $resultadoFinal );
echo $resultado;
EXIT ();
?>
