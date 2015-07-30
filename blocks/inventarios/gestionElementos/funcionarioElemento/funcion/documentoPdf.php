<?

namespace inventarios\gestionElementos\funcionarioElemento\funcion;

use inventarios\gestionElementos\funcionarioElemento\funcion\redireccion;

$ruta = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" );

$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/plugin/html2pfd/";

include ($ruta . "/plugin/html2pdf/html2pdf.class.php");

if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}
class RegistradorOrden {
	var $miConfigurador;
	var $lenguaje;
	var $miFormulario;
	var $miFuncion;
	var $miSql;
	var $conexion;
	function __construct($lenguaje, $sql, $funcion) {
		$this->miConfigurador = \Configurador::singleton ();
		$this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
		$this->lenguaje = $lenguaje;
		$this->miSql = $sql;
		$this->miFuncion = $funcion;
	}
	function documento() {
// echo "pdf";
// 		var_dump($_REQUEST);exit;
		
		
		
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		
		
		
		$funcionario = $_REQUEST ['funcionario'];
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarElemento', $funcionario );
		
		$resultado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		
// 		var_dump($resultado);exit;
		
	 foreach ($resultado as $valor){
	 	
	 	
	 	if ($valor['tipo_bien']==2){
	 	
	 	$elementos_consumo_controlado[]=$valor;
	 	
	 	}
	 	
	 	
	 	if ($valor['tipo_bien']==3){
	 		 
	 		$elementos_devolutivos[]=$valor;
	 		 
	 	}
	 	
	 }
		
// 	 var_dump($elementos_devolutivos);exit;
	 
	 
		
		
		$directorio = $this->miConfigurador->getVariableConfiguracion ( 'rutaUrlBloque' );
		
	
		
		
		$contenidoPagina = "
<style type=\"text/css\">
    table { 
        
        font-family:Helvetica, Arial, sans-serif; /* Nicer font */
		
        border-collapse:collapse; border-spacing: 3px; 
    }

    td, th { 
        border: 1px solid #CCC; 
        height: 13px;
    } /* Make cells a bit taller */

	col{
	width=50%;
	
	}			
				
    th {
        
        font-weight: bold; /* Make sure they're bold */
        text-align: center;
        font-size:10px
    }

    td {
        
        text-align: left;
        font-size:10px
    }
</style>				
				
				
<page backtop='10mm' backbottom='7mm' backleft='10mm' backright='10mm'>
	

        <table align='left' style='width:100%;' >
            <tr>
                <td align='center' style='width:12%;' >
                    <img src='" . $directorio . "/css/images/escudo.png'  width='80' height='100'>
                </td>
                <td align='center' style='width:88%;' >
                    <font size='9px'><b>UNIVERSIDAD DISTRITAL FRANCISCO JOSÉ DE CALDAS </b></font>
                     <br>
                    <font size='7px'><b>NIT: 899.999.230-7</b></font>
                     <br>
                      <br>
                     <font size='7px'>Almacén General e Inventarios</font>
                    <br>		
                    <font size='5px'>Acta Inventario Individualizado</font>
                    <br>									
                    <font size='3px'>www.udistrital.edu.co</font>
                     <br>
                    <font size='4px'>" . date ( "Y-m-d" ) . "</font>
                   			
                </td>
            </tr>
        </table>
                   
                    		<br>
                    		<br>
                    		
           	<table style='width:100%;'>
            <tr> 
			<td style='width:50%;'>NOMBRE FUNCIONARIO : " . $resultado[0]['nombre_funcionario'] . "</td>
			<td style='width:50%;text-aling=left;'>CC : " . $_REQUEST ['funcionario'] . "</td> 			
 		 	</tr>
			<tr> 
			<td style='width:50%;'>DEPENDENCIA : " . $resultado[0]['dependencia'] . "</td>
			<td style='width:50%;text-aling=left;'>SEDE : " . $resultado[0] ['sede'] . "</td> 			
 		 	</tr>		
			</table>   		
             <br>		
			<table style='width:100%;'>
			<tr> 
			<td style='width:15%;text-align=center;'>Placa</td>
			<td style='width:35%;text-align=center;'>Descripción</td>
			<td style='width:15%;text-align=center;'>Marca</td>
			<td style='width:15%;text-align=center;'>Serie</td>
			<td style='width:10%;text-align=center;'>Estado</td>
			<td style='width:10%;text-align=center;'>Verificación</td>
			</tr> 		          		
 			</table>
			<table style='width:100%;'>";	       		
                    		
                    		foreach ($elementos_consumo_controlado as $valor){
                    			
                   $contenidoPagina.="<tr>
                    			<td style='width:15%;text-align=center;'>".$valor['placa']."</td>
                    			<td style='width:35%;text-align=center;'>".$valor['descripcion_elemento']."</td>
                    			<td style='width:15%;text-align=center;'>".$valor['marca']."</td>
                    			<td style='width:15%;text-align=center;'>".$valor['serie']."</td>
                    			<td style='width:10%;text-align=center;'>".$valor['estado_bien']."</td>
                    			<td style='width:10%;text-align=center;'>".$valor['marca_existencia']."</td>
                    			</tr>";
                    			
                    			
                    			
                    			
                    		}
	
$contenidoPagina .= "</table>";

$contenidoPagina.="<page_footer  backleft='10mm' backright='10mm'>

</page_footer> 
					
					
				";
		
		$contenidoPagina .= "</page>";
		
// 		echo $contenidoPagina;exit;
		return $contenidoPagina;
	}
}

$miRegistrador = new RegistradorOrden ( $this->lenguaje, $this->sql, $this->funcion );

$textos = $miRegistrador->documento ();

ob_start ();
$html2pdf = new \HTML2PDF ( 'L', 'LETTER', 'es', true, 'UTF-8' );
$html2pdf->pdf->SetDisplayMode ( 'fullpage' );
$html2pdf->WriteHTML ( $textos );

$html2pdf->Output ( 'Compra_Nro_.pdf', 'D' );

?>





