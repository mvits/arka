<?php
if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}
class registrarForm {
	var $miConfigurador;
	var $lenguaje;
	var $miFormulario;
	var $miSql;
	function __construct($lenguaje, $formulario, $sql) {
		$this->miConfigurador = \Configurador::singleton ();
		
		$this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
		
		$this->lenguaje = $lenguaje;
		
		$this->miFormulario = $formulario;
		
		$this->miSql = $sql;
	}
	function miForm() {
		
		// Rescatar los datos de este bloque
		$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );
		$miPaginaActual = $this->miConfigurador->getVariableConfiguracion ( 'pagina' );
		
		$directorio = $this->miConfigurador->getVariableConfiguracion ( "host" );
		$directorio .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/index.php?";
		$directorio .= $this->miConfigurador->getVariableConfiguracion ( "enlace" );
		
		$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "host" );
		$rutaBloque .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/";
		$rutaBloque .= $esteBloque ['grupo'] . "/" . $esteBloque ['nombre'];
		
		// ---------------- SECCION: Parámetros Globales del Formulario ----------------------------------
		/**
		 * Atributos que deben ser aplicados a todos los controles de este formulario.
		 * Se utiliza un arreglo
		 * independiente debido a que los atributos individuales se reinician cada vez que se declara un campo.
		 *
		 * Si se utiliza esta técnica es necesario realizar un mezcla entre este arreglo y el específico en cada control:
		 * $atributos= array_merge($atributos,$atributosGlobales);
		 */
		
		$atributosGlobales ['campoSeguro'] = 'true';
		
		// -------------------------------------------------------------------------------------------------
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$cadenaSql = $this->miSql->getCadenaSql ( "Verificar_Periodo" );
		$resultado_periodo = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, 'busqueda' );
		
		// ---------------- SECCION: Parámetros Generales del Formulario ----------------------------------
		$esteCampo = $esteBloque ['nombre'];
		$atributos ['id'] = $esteCampo;
		$atributos ['nombre'] = $esteCampo;
		// Si no se coloca, entonces toma el valor predeterminado 'application/x-www-form-urlencoded'
		$atributos ['tipoFormulario'] = 'multipart/form-data';
		// Si no se coloca, entonces toma el valor predeterminado 'POST'
		$atributos ['metodo'] = 'POST';
		// Si no se coloca, entonces toma el valor predeterminado 'index.php' (Recomendado)
		$atributos ['action'] = 'index.php';
		// $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo );
		// Si no se coloca, entonces toma el valor predeterminado.
		$atributos ['estilo'] = '';
		$atributos ['marco'] = true;
		$tab = 1;
		// ---------------- FIN SECCION: de Parámetros Generales del Formulario ----------------------------
		
		// ----------------INICIAR EL FORMULARIO ------------------------------------------------------------
		$atributos ['tipoEtiqueta'] = 'inicio';
		echo $this->miFormulario->formulario ( $atributos );
		// ---------------- SECCION: Controles del Formulario -----------------------------------------------
		
		$variable = "pagina=" . $miPaginaActual;
		$variable = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $variable, $directorio );
		
		// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
		$esteCampo = 'botonRegresar';
		$atributos ['id'] = $esteCampo;
		$atributos ['enlace'] = $variable;
		$atributos ['tabIndex'] = 1;
		$atributos ['estilo'] = 'textoSubtitulo';
		$atributos ['enlaceTexto'] = $this->lenguaje->getCadena ( $esteCampo );
		$atributos ['ancho'] = '10%';
		$atributos ['alto'] = '10%';
		$atributos ['redirLugar'] = true;
		echo $this->miFormulario->enlace ( $atributos );
		unset ( $atributos );
		
		$funcionario = $_REQUEST ['funcionario'];
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarElemento', $funcionario );
		
		$resultado = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
		$esteCampo = 'encabezado';
		$atributos ['id'] = $esteCampo;
		$atributos ['tipo'] = 'information';
		$atributos ['estilo'] = 'textoNotasFormulario';
		$atributos ['mensaje'] = $this->lenguaje->getCadena ( $esteCampo );
		
		$tab ++;
		
		// Aplica atributos globales al control
		$atributos = array_merge ( $atributos, $atributosGlobales );
		echo $this->miFormulario->cuadroMensaje ( $atributos );
		
		$esteCampo = "marcoDatosBasicos";
		$atributos ['id'] = $esteCampo;
		$atributos ["estilo"] = "jqueryui";
		$atributos ['tipoEtiqueta'] = 'inicio';
		$atributos ["leyenda"] = "Inventario Funcionario CC. " . $_REQUEST ['funcionario'] . "    -    " . $resultado [0] ['nombre_funcionario'];
		echo $this->miFormulario->marcoAgrupacion ( 'inicio', $atributos );
		unset ( $atributos );
		{
			
			if ($resultado) {
				
				// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
				$esteCampo = 'encabezado';
				$atributos ['id'] = $esteCampo;
				$atributos ['nombre'] = $esteCampo;
				$atributos ['tipo'] = 'text';
				$atributos ['estilo'] = 'textoNotasFormulario';
				$atributos ['marco'] = true;
				$atributos ['estiloMarco'] = '';
				$atributos ['texto'] = $this->lenguaje->getCadena ( $esteCampo );
				$atributos ["etiquetaObligatorio"] = false;
				$atributos ['columnas'] = 1;
				$atributos ['dobleLinea'] = 0;
				$atributos ['tabIndex'] = $tab;
				$atributos ['validar'] = '';
				// $atributos ['etiqueta'] =$this->lenguaje->getCadena ( $esteCampo."Nota" );
				if (isset ( $_REQUEST [$esteCampo] )) {
					$atributos ['valor'] = $_REQUEST [$esteCampo];
				} else {
					$atributos ['valor'] = '';
				}
				$atributos ['titulo'] = '';
				$atributos ['deshabilitado'] = true;
				$atributos ['tamanno'] = 10;
				$atributos ['maximoTamanno'] = '';
				$atributos ['anchoEtiqueta'] = 10;
				$tab ++;
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				// echo $this->miFormulario->campoTexto ( $atributos );
				unset ( $atributos );
				
				// ------------------Division para los botones-------------------------
				$atributos ["id"] = "SeleccionRegistro";
				echo $this->miFormulario->division ( "inicio", $atributos );
				unset ( $atributos );
				{
					$esteCampo = "selecc_registros";
					$atributos ['nombre'] = $esteCampo;
					$atributos ['id'] = $esteCampo;
					$atributos ['etiqueta'] = $this->lenguaje->getCadena ( $esteCampo );
					$atributos ["etiquetaObligatorio"] = false;
					$atributos ['tab'] = $tab ++;
					$atributos ['seleccion'] = 0;
					$atributos ['anchoEtiqueta'] = 150;
					$atributos ['evento'] = '';
					if (isset ( $_REQUEST [$esteCampo] )) {
						$atributos ['valor'] = $_REQUEST [$esteCampo];
					} else {
						$atributos ['valor'] = '';
					}
					$atributos ['deshabilitado'] = false;
					$atributos ['columnas'] = 2;
					$atributos ['tamanno'] = 1;
					$atributos ['ajax_function'] = "";
					$atributos ['ajax_control'] = $esteCampo;
					$atributos ['estilo'] = "jqueryui";
					$atributos ['validar'] = "required";
					$atributos ['limitar'] = false;
					$atributos ['anchoCaja'] = 24;
					$atributos ['miEvento'] = '';
					// $atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "estado_entrada" );
					$matrizItems = array (
							array (
									'0',
									'Ningun Registro' 
							),
							
							array (
									'1',
									'Todos Registros' 
							) 
					);
					$atributos ['matrizItems'] = $matrizItems;
					// $atributos['miniRegistro']=;
					$atributos ['baseDatos'] = "inventarios";
					// $atributos ['cadena_sql'] = $this->miSql->getCadenaSql ( "clase_entrada" );
					
					// Aplica atributos globales al control
					$atributos = array_merge ( $atributos, $atributosGlobales );
					echo $this->miFormulario->campoCuadroLista ( $atributos );
					unset ( $atributos );
				}
				echo $this->miFormulario->division ( 'fin' );
				unset ( $atributos );
				
				$mostrarHtml = "<table id='tablaTitulos'>
			<thead>
                <tr>
              	  <th>Tipo Bien</th>
					<th>Placa</th>
					<th>Descripción</th>
					<th>Sede</th>
					<th>Dependencia</th>
                	<th>Estado Elemento</th>
					<th>Detalle Elemento</th> 
					<th>Registrar<br>Observaciones</th> 
					<th>Verificación</th> 
					 </tr>
            </thead>
			<tbody>
            ";
				
				for($i = 0; $i < count ( $resultado ); $i ++) {
					
					$VariableDetalles = "pagina=detalleElemento"; // pendiente la pagina para modificar parametro
					$VariableDetalles .= "&opcion=detalle";
					$VariableDetalles .= "&elemento=" . $resultado [$i] ['identificador_elemento_individual'];
					$VariableDetalles .= "&funcionario=" . $funcionario;
					$VariableDetalles = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $VariableDetalles, $directorio );
					
					$VariableObservaciones = "pagina=" . $miPaginaActual; // pendiente la pagina para modificar parametro
					$VariableObservaciones .= "&opcion=observaciones";
					$VariableObservaciones .= "&elemento_individual=" . $resultado [$i] ['identificador_elemento_individual'];
					$VariableObservaciones .= "&funcionario=" . $funcionario;
					$VariableObservaciones .= "&placa=" . $resultado [$i] ['placa'];
					$VariableObservaciones = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $VariableObservaciones, $directorio );
					
					$identificaciones_elementos [] = $resultado [$i] ['identificador_elemento_individual'];
					
					// $elementos_acta = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
					
					// $validacion_elementos = " <td><center>
					// <a href='" . $variable1 . "'>
					// <img src='" . $rutaBloque . "/css/images/update.png' width='15px'>
					// </a>
					// </center> </td>";
					
					$mostrarHtml .= "<tr>
                    <td><center>" . $resultado [$i] ['nombre_tipo_bienes'] . "</center></td>
                    <td><center>" . $resultado [$i] ['placa'] . "</center></td>
                    <td><center>" . $resultado [$i] ['descripcion_elemento'] . "</center></td>
                    <td><center>" . $resultado [$i] ['sede'] . "</center></td>
                    <td><center>" . $resultado [$i] ['dependencia'] . "</center></td>
                    <td><center>" . $resultado [$i] ['estado_bien'] . "</center></td>
                    <td><center><a href='" . $VariableDetalles . "'><u>Ver Detalles</u></a></center> </td>    
					 <td><center><a href='" . $VariableObservaciones . "'><img src='" . $rutaBloque . "/css/images/edit.png' width='15px'></a></center>
                     <td><center>		
					";
					
					$nombre = 'item_' . $i;
					$atributos ['id'] = $nombre;
					$atributos ['nombre'] = $nombre;
					$atributos ['marco'] = true;
					$atributos ['estiloMarco'] = true;
					$atributos ["etiquetaObligatorio"] = true;
					$atributos ['columnas'] = 1;
					$atributos ['dobleLinea'] = 1;
					$atributos ['tabIndex'] = $tab;
					$atributos ['etiqueta'] = '';
					$atributos ['seleccionado'] = ($resultado [$i] ['confirmada_existencia'] == 't') ? true : false;
					$atributos ['evento'] = 'onclick';
					$atributos ['eventoFuncion'] = ' verificarElementos(this.form)';
					$atributos ['valor'] = $resultado [$i] ['identificador_elemento_individual'];
					$atributos ['deshabilitado'] = false;
					$tab ++;
					
					// Aplica atributos globales al control
					$atributos = array_merge ( $atributos, $atributosGlobales );
					$mostrarHtml .= ($resultado [$i] ['tipo_confirmada'] == 1) ? '&#8730 ' : $this->miFormulario->campoCuadroSeleccion ( $atributos );
					
					$mostrar_botones = ($resultado [$i] ['tipo_confirmada'] != 1) ? 'block' : 'none';
					
					$mostrarHtml .= "</center> </td> </tr>";
				}
				
				$mostrarHtml .= "</tbody>
					 </table>";
				echo $mostrarHtml;
				unset ( $mostrarHtml );
				unset ( $variable );
			} else {
				
				$mensaje = "No Existen Elementos Asociados con el Funcionario";
				
				// ---------------- CONTROL: Cuadro de Texto --------------------------------------------------------
				$esteCampo = 'mensajeRegistro';
				$atributos ['id'] = $esteCampo;
				$atributos ['tipo'] = 'error';
				$atributos ['estilo'] = 'textoCentrar';
				$atributos ['mensaje'] = $mensaje;
				
				$tab ++;
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->cuadroMensaje ( $atributos );
			}
		}
		echo $this->miFormulario->marcoAgrupacion ( 'fin' );
		
		if ($resultado) {
			
			if ($resultado_periodo) {
				
				// ------------------Division para los botones-------------------------
				$atributos ["id"] = "botones";
				$atributos ["estilo"] = "marcoBotones";
				$atributos ["estiloEnLinea"] = "display:" . $mostrar_botones;
				echo $this->miFormulario->division ( "inicio", $atributos );
				
				// -----------------CONTROL: Botón ----------------------------------------------------------------
				$esteCampo = 'botonGuadar';
				$atributos ["id"] = $esteCampo;
				$atributos ["tabIndex"] = $tab;
				$atributos ["tipo"] = ' ';
				// submit: no se coloca si se desea un tipo button genérico
				$atributos ['submit'] = true;
				$atributos ["estiloMarco"] = '';
				$atributos ["estiloBoton"] = 'jqueryui';
				// verificar: true para verificar el formulario antes de pasarlo al servidor.
				$atributos ["verificar"] = '';
				$atributos ["tipoSubmit"] = 'jquery'; // Dejar vacio para un submit normal, en este caso se ejecuta la función submit declarada en ready.js
				$atributos ["valor"] = $this->lenguaje->getCadena ( $esteCampo );
				$atributos ['nombreFormulario'] = $esteBloque ['nombre'];
				$tab ++;
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->campoBoton ( $atributos );
				unset ( $atributos );
				
				// -----------------CONTROL: Botón ----------------------------------------------------------------
				$esteCampo = 'botonAprobar';
				$atributos ["id"] = $esteCampo;
				$atributos ["tabIndex"] = $tab;
				$atributos ["tipo"] = ' ';
				// submit: no se coloca si se desea un tipo button genérico
				$atributos ['submit'] = true;
				$atributos ["estiloMarco"] = '';
				$atributos ["estiloBoton"] = 'jqueryui';
				// verificar: true para verificar el formulario antes de pasarlo al servidor.
				$atributos ["verificar"] = '';
				$atributos ["tipoSubmit"] = 'jquery'; // Dejar vacio para un submit normal, en este caso se ejecuta la función submit declarada en ready.js
				$atributos ["valor"] = $this->lenguaje->getCadena ( $esteCampo );
				$atributos ['nombreFormulario'] = $esteBloque ['nombre'];
				$tab ++;
				
				// Aplica atributos globales al control
				$atributos = array_merge ( $atributos, $atributosGlobales );
				echo $this->miFormulario->campoBoton ( $atributos );
				unset ( $atributos );
				
				echo $this->miFormulario->division ( "fin" );
				unset ( $atributos );
			}
			// ------------------Division para los botones-------------------------
			$atributos ["id"] = "botones";
			$atributos ["estilo"] = "marcoBotones";
			echo $this->miFormulario->division ( "inicio", $atributos );
			
			// -----------------CONTROL: Botón ----------------------------------------------------------------
			$esteCampo = 'botonGenerarPdf';
			$atributos ["id"] = $esteCampo;
			$atributos ["tabIndex"] = $tab;
			$atributos ["tipo"] = ' ';
			// submit: no se coloca si se desea un tipo button genérico
			$atributos ['submit'] = true;
			$atributos ["estiloMarco"] = '';
			$atributos ["estiloBoton"] = 'jqueryui';
			// verificar: true para verificar el formulario antes de pasarlo al servidor.
			$atributos ["verificar"] = '';
			$atributos ["tipoSubmit"] = 'jquery'; // Dejar vacio para un submit normal, en este caso se ejecuta la función submit declarada en ready.js
			$atributos ["valor"] = $this->lenguaje->getCadena ( $esteCampo );
			$atributos ['nombreFormulario'] = $esteBloque ['nombre'];
			$tab ++;
			
			// Aplica atributos globales al control
			$atributos = array_merge ( $atributos, $atributosGlobales );
			echo $this->miFormulario->campoBoton ( $atributos );
			unset ( $atributos );
			
			// -----------------FIN CONTROL: Botón -----------------------------------------------------------
			
			// ---------------------------------------------------------
		}
		
		// ------------------Fin Division para los botones-------------------------
		echo $this->miFormulario->division ( "fin" );
		unset ( $atributos );
		
		// ------------------- SECCION: Paso de variables ------------------------------------------------
		
		/**
		 * En algunas ocasiones es útil pasar variables entre las diferentes páginas.
		 * SARA permite realizar esto a través de tres
		 * mecanismos:
		 * (a). Registrando las variables como variables de sesión. Estarán disponibles durante toda la sesión de usuario. Requiere acceso a
		 * la base de datos.
		 * (b). Incluirlas de manera codificada como campos de los formularios. Para ello se utiliza un campo especial denominado
		 * formsara, cuyo valor será una cadena codificada que contiene las variables.
		 * (c) a través de campos ocultos en los formularios. (deprecated)
		 */
		
		// En este formulario se utiliza el mecanismo (b) para pasar las siguientes variables:
		
		// Paso 1: crear el listado de variables
		
		$valorCodificado = "action=" . $esteBloque ["nombre"];
		$valorCodificado .= "&pagina=" . $this->miConfigurador->getVariableConfiguracion ( 'pagina' );
		$valorCodificado .= "&bloque=" . $esteBloque ['nombre'];
		$valorCodificado .= "&bloqueGrupo=" . $esteBloque ["grupo"];
		$valorCodificado .= "&opcion=Accion";
		$valorCodificado .= "&funcionario=" . $_REQUEST ['funcionario'];
		if ($resultado_periodo) {
			if ($resultado) {
				
				$valorCodificado .= "&id_elementos=" . serialize ( $identificaciones_elementos );
			}
		}
		// $valorCodificado .= "&opcion=mensaje";
		// $valorCodificado .= "&mensaje=mantenimiento";
		
		/**
		 * SARA permite que los nombres de los campos sean dinámicos.
		 * Para ello utiliza la hora en que es creado el formulario para
		 * codificar el nombre de cada campo. Si se utiliza esta técnica es necesario pasar dicho tiempo como una variable:
		 * (a) invocando a la variable $_REQUEST ['tiempo'] que se ha declarado en ready.php o
		 * (b) asociando el tiempo en que se está creando el formulario
		 */
		$valorCodificado .= "&tiempo=" . time ();
		$valorCodificado .= "&campoSeguro=" . $_REQUEST ['tiempo'];
		// Paso 2: codificar la cadena resultante
		$valorCodificado = $this->miConfigurador->fabricaConexiones->crypto->codificar ( $valorCodificado );
		
		$atributos ["id"] = "formSaraData"; // No cambiar este nombre
		$atributos ["tipo"] = "hidden";
		$atributos ['estilo'] = '';
		$atributos ["obligatorio"] = false;
		$atributos ['marco'] = true;
		$atributos ["etiqueta"] = "";
		$atributos ["valor"] = $valorCodificado;
		echo $this->miFormulario->campoCuadroTexto ( $atributos );
		unset ( $atributos );
		
		$atributos ['marco'] = true;
		$atributos ['tipoEtiqueta'] = 'fin';
		echo $this->miFormulario->formulario ( $atributos );
	}
}

$miSeleccionador = new registrarForm ( $this->lenguaje, $this->miFormulario, $this->sql );

$miSeleccionador->miForm ();
?>
