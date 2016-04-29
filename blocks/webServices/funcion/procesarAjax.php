<?php
var_dump($_REQUEST);exit;
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
								'Proceso' => "Gestion Nuevos Proveedores" 
						);
					} else {
						$arregloProcesos [] = array (
								'status' => "Error",
								'Proceso' => "Gestion Nuevos Proveedores" 
						);
					}
					
					if ($datos_proveedores_sic != false) {
						
						$cadenaSql = $this->sql->getCadenaSql ( 'Consulta_Proveedores_Arka' );
						
						$datos_proveedores_psql = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
						$conteo_psql = count ( $datos_proveedores_psql );
						$conteo_sic = count ( $datos_proveedores_sic );
						
						if ($conteo_psql === $conteo_sic) {
							
							foreach ( $datos_proveedores_psql as $key => $valor ) {
								
								if ($datos_proveedores_psql [$key] ['PRO_IDENTIFICADOR'] === $datos_proveedores_sic [$key] ['PRO_IDENTIFICADOR']) {
									
									$valor_psql = $datos_proveedores_psql [$key] ['PRO_RAZON_SOCIAL'] . $datos_proveedores_psql [$key] ['PRO_NIT'] . $datos_proveedores_psql [$key] ['PRO_DIRECCION'] . $datos_proveedores_psql [$key] ['PRO_TELEFONO'];
									$valor_sic = $datos_proveedores_sic [$key] ['PRO_RAZON_SOCIAL'] . $datos_proveedores_sic [$key] ['PRO_NIT'] . $datos_proveedores_sic [$key] ['PRO_DIRECCION'] . $datos_proveedores_sic [$key] ['PRO_TELEFONO'];
									if ($valor_psql != $valor_sic) {
										
										$cadena = $this->sql->getCadenaSql ( 'registro_proveedor_historico', $datos_proveedores_psql [$key] );
										$registrarProveedorHistorico = $esteRecursoDB->ejecutarAcceso ( $cadena, "acceso", $datos_proveedores_psql [$key], "registro_proveedor_historico" );
										
										$cadena = $this->sql->getCadenaSql ( 'actualizar_proveedor', $datos_proveedores_sic [$key] );
										
										$actualizarProveedor = $esteRecursoDB->ejecutarAcceso ( $cadena, "acceso", $datos_proveedores_sic [$key], "actualizar_proveedor" );
									}
								}
							}
							
							$arregloProcesos [] = array (
									'status' => "Exito",
									'Proceso' => "Gestion Actualizacion Proveedores" 
							);
						} else {
							$arregloProcesos [] = array (
									'status' => "Error",
									'Proceso' => "Gestion Actualizacion Proveedores" 
							);
						}
					} else {
						
						$arregloProcesos [] = array (
								'status' => "Error",
								'Proceso' => "Gestion Actualizacion Proveedores" 
						);
					}
					
					$array_status = json_encode ( $arregloProcesos );
					
					$cadena = $this->sql->getCadenaSql ( 'registro_web_services', "gestion Proveedores : " . $array_status );
					$registrarEventoWebServices = $esteRecursoDB->ejecutarAcceso ( $cadena, "acceso", "gestion Proveedores : " . $array_status, "registro_web_services" );
					
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
