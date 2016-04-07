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

switch ($_REQUEST ['funcion']) {
	
	case 'consultarDependencia' :
		
		$resultadoFinal [] = array (
				'status' => "En Linea",
				'placa' => "QQQQ",
				'descripcion' => "STVFAT",
				'sede' => "JJJ",
				'dependencia' => "6WGQW",
				'espaciofisico' => "HDHDH",
				'estadoelemento' => "AGSVGTVA",
				'contratista' => "SGHBV",
				'detalle' => "515@",
				'observaciones' => "AHGSDFF",
				'verificacion' => "123ASE" 
		);
		
		break;
	
	default :
		for($i = 0; $i < 1000000; $i ++) {
			
			
			$i=$i+$i;
			
		}
		
		$resultadoFinal [] = array (
				'status' => "Error",
				'fecha' => date ( 'Y-m-d' )
		);
		break;
}

$resultado = json_encode ( $resultadoFinal );
echo $resultado;
EXIT ();

?>
