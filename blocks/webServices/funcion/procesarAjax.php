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


switch ($_REQUEST ['funcion']) {
	
	case 'actualizarParametros' :
		
		switch ($_REQUEST ['tipo_parametro']) {
			
			case 'proveedores' :
				
				$cadenaSql = $this->sql->getCadenaSql ( 'Consulta_Proveedores_Sicapital' );
				
				$datos_proveedores_sic = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );
				
				foreach ( $datos_proveedores_sic as $valor ) {
					
					$cadenaSql = $this->sql->getCadenaSql ( 'validacion_proveedores', $valor ['PRO_IDENTIFICADOR'] );
					
					$consulta_proveedor = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
					
					if ($consulta_proveedor == false) {
						
						$arreglo_cadenas = $this->sql->getCadenaSql ( 'registro_proveedores', $valor );
						
						$registrarProveedor = $esteRecursoDB->ejecutarAcceso ( $arreglo_cadenas, "acceso" ,$valor, "registro_proveedores");
					}
				}
				
				$resultadoFinal [] = array (
						'status' => "Exito",
						'Proceso' => "Actualizar Proveedores",
						'fecha' => date ( 'Y-m-d' )
				);

				
				break;
		}
		
		break;
	
	default :
		for($i = 0; $i < 1000000; $i ++) {
			
			$i = $i + $i;
		}
		
		$resultadoFinal [] = array (
				'status' => "Error",
				'Proceso' => "Error Proceso",
				'fecha' => date ( 'Y-m-d' ) 
		);
		break;
}

$resultado = json_encode ( $resultadoFinal );
echo $resultado;
EXIT ();

?>
