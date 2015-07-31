<?php
// var_dump($this->miConfigurador);
$esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");

$rutaBloque = $this->miConfigurador->getVariableConfiguracion("host");
$rutaBloque .= $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/";
$rutaBloque .= $esteBloque ['grupo'] . "/" . $esteBloque ['nombre'];

$directorio = $this->miConfigurador->getVariableConfiguracion("host");
$directorio .= $this->miConfigurador->getVariableConfiguracion("site") . "/index.php?";
$directorio .= $this->miConfigurador->getVariableConfiguracion("enlace");
$miSesion = Sesion::singleton();

$nivel = $miSesion->nivelSesion();

$enlacePrincipal ['enlace'] = "pagina=indexARKA";
$enlacePrincipal ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlacePrincipal ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlacePrincipal ['enlace'], $directorio);
$enlacePrincipal ['nombre'] = "Inicio";


// Reposición Elementos
$enlacereposicionElementos ['enlace'] = "pagina=registrarReposicion";
$enlacereposicionElementos ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlacereposicionElementos ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlacereposicionElementos ['enlace'], $directorio);
$enlacereposicionElementos ['nombre'] = "Reposición Elemento";


// Consulta General
$enlaceConsultaGeneral ['enlace'] = "pagina=consultaGeneral";
$enlaceConsultaGeneral ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceConsultaGeneral ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceConsultaGeneral ['enlace'], $directorio);
$enlaceConsultaGeneral ['nombre'] = "Consultas Generales";

// Registro Orden Compra
$enlaceRegistroOrdenCompra ['enlace'] = "pagina=registrarOrdenCompra";
$enlaceRegistroOrdenCompra ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceRegistroOrdenCompra ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceRegistroOrdenCompra ['enlace'], $directorio);
$enlaceRegistroOrdenCompra ['nombre'] = "Registrar Orden de Compra";

// consultar y modificar Orden Compra
$enlaceConsultaOrdenCompra ['enlace'] = "pagina=consultaOrdenCompra";
$enlaceRegistroOrdenCompra ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceConsultaOrdenCompra ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceConsultaOrdenCompra ['enlace'], $directorio);
$enlaceConsultaOrdenCompra ['nombre'] = "Consultar y Modificar Orden de Compra";

// Registro Orden Servicios
$enlaceRegistroOrdenServicios ['enlace'] = "pagina=registrarOrdenServicios";
$enlaceRegistroOrdenServicios ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceRegistroOrdenServicios ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceRegistroOrdenServicios ['enlace'], $directorio);
$enlaceRegistroOrdenServicios ['nombre'] = "Registrar Orden de Servicios";


// Consultar y Modificar Orden Servicios
$enlaceConsultaOrdenServicios ['enlace'] = "pagina=consultaOrdenServicios";
$enlaceConsultaOrdenServicios ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceConsultaOrdenServicios ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceConsultaOrdenServicios ['enlace'], $directorio);
$enlaceConsultaOrdenServicios ['nombre'] = "Consultar y Modificar Orden de Servicios";


// Registro de Contrato

$enlacegestionContrato['enlace'] = "pagina=gestionContrato";
$enlacegestionContrato['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlacegestionContrato['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlacegestionContrato ['enlace'], $directorio);
$enlacegestionContrato['nombre'] = "Contratos";

// Gestionar Acta de Recibido

$enlacegestionActa['enlace'] = "pagina=registrarActa";
$enlacegestionActa['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlacegestionActa['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlacegestionActa ['enlace'], $directorio);
$enlacegestionActa['nombre'] = "Registrar Acta de Recibido";

// Gestionar Acta de Recibido

$enlaceconsultaActa['enlace'] = "pagina=consultarActa";
$enlaceconsultaActa['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceconsultaActa['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceconsultaActa['enlace'], $directorio);
$enlaceconsultaActa['nombre'] = "Consultar y Modificar Acta de Recibido";



// Gestionar Acta de Recibido Elementos

$enlaceElementosActa ['enlace'] = "pagina=registrarElementoActa";
$enlaceElementosActa['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceElementosActa['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceElementosActa['enlace'], $directorio);
$enlaceElementosActa['nombre'] = "Cargar Elementos Acta de Recibido";


$enlaceActivarElementosActa ['enlace'] = "pagina=activacionElementosActa";
$enlaceActivarElementosActa['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceActivarElementosActa['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceActivarElementosActa['enlace'], $directorio);
$enlaceActivarElementosActa['nombre'] = "Activar  Elementos";



// Registro Entradas
$enlaceRegistroEntradas ['enlace'] = "pagina=registrarEntradas";
$enlaceRegistroEntradas ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceRegistroEntradas ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceRegistroEntradas ['enlace'], $directorio);
$enlaceRegistroEntradas ['nombre'] = "Registrar Entrada";

// Consultar y Modificar Estado Entradas
$enlaceConsultaEntradas ['enlace'] = "pagina=consultaEntradas";
$enlaceConsultaEntradas ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceConsultaEntradas ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceConsultaEntradas ['enlace'], $directorio);
$enlaceConsultaEntradas ['nombre'] = "Consultar y Modificar Estado Entrada";

// Modificar Entradas

$enlaceModificarEntradas ['enlace'] = "pagina=modificarEntradas";
$enlaceModificarEntradas ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceModificarEntradas ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceModificarEntradas ['enlace'], $directorio);
$enlaceModificarEntradas ['nombre'] = "Modificar Entradas";

// Registro Elementos
$enlaceRegistroElementos ['enlace'] = "pagina=registrarElemento";
$enlaceRegistroElementos ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceRegistroElementos ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceRegistroElementos ['enlace'], $directorio);
$enlaceRegistroElementos ['nombre'] = "Cargar Elementos";

//Modificar Elementos
$enlaceModificarElementos ['enlace'] = "pagina=modificarElemento";
$enlaceModificarElementos['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceModificarElementos ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceModificarElementos ['enlace'], $directorio);
$enlaceModificarElementos ['nombre'] = "Modificar y Anular Elementos";




//Funcionario  Elementos
$enlacePeriodoLevantamiento ['enlace'] = "pagina=periodoLevantamiento";
$enlacePeriodoLevantamiento['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlacePeriodoLevantamiento ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlacePeriodoLevantamiento ['enlace'], $directorio);
$enlacePeriodoLevantamiento ['nombre'] = "Periodo Levantamiento Físico";





//Funcionario  Elementos
$enlaceFuncionarioElementos ['enlace'] = "pagina=funcionarioElemento";
$enlaceFuncionarioElementos['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceFuncionarioElementos ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceFuncionarioElementos ['enlace'], $directorio);
$enlaceFuncionarioElementos ['nombre'] = "Inventario Funcionarios";


// Consultar Elementos
$enlaceHojaVida ['enlace'] = "pagina=detalleElemento";
$enlaceHojaVida['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceHojaVida ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceHojaVida ['enlace'], $directorio);
$enlaceHojaVida ['nombre'] = "Consultar Detalle del Elemento";

// Registro Salidas
$enlaceRegistroSalidas ['enlace'] = "pagina=registrarSalidas";
$enlaceRegistroSalidas ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceRegistroSalidas ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceRegistroSalidas ['enlace'], $directorio);
$enlaceRegistroSalidas ['nombre'] = "Registrar Salida";

// Consultar y Modificar Salidas

$enlaceModificarSalidas ['enlace'] = "pagina=modificarSalidas";
$enlaceModificarSalidas ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceModificarSalidas ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceModificarSalidas ['enlace'], $directorio);
$enlaceModificarSalidas ['nombre'] = "Consultar y Modificar Salidas";


// Traslado Elementos
$enlaceTrasladosElementos ['enlace'] = "pagina=registrarTraslados";
$enlaceTrasladosElementos ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceTrasladosElementos ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceTrasladosElementos ['enlace'], $directorio);
$enlaceTrasladosElementos ['nombre'] = "Traslados Elementos";


// Sobrantes Y faltantes
$enlaceSobranteFlatanteElementos ['enlace'] = "pagina=registrarFaltantesSobrantes";
$enlaceSobranteFlatanteElementos ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceSobranteFlatanteElementos ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceSobranteFlatanteElementos ['enlace'], $directorio);
$enlaceSobranteFlatanteElementos ['nombre'] = "Faltantes y Sobrantes Elementos";

// Gestionar Catalogo

$enlaceGestionarCatalogo ['enlace'] = "pagina=catalogo";
$enlaceGestionarCatalogo ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceGestionarCatalogo ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceGestionarCatalogo ['enlace'], $directorio);
$enlaceGestionarCatalogo ['nombre'] = "Nivel de Inventarios";

// Gestionar GrupoC

$enlaceGestionarGrupoC ['enlace'] = "pagina=grupoContable";
$enlaceGestionarGrupoC ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceGestionarGrupoC ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceGestionarGrupoC ['enlace'], $directorio);
$enlaceGestionarGrupoC ['nombre'] = "Grupo Manejo de Bienes";

// Radicar ASignar

$enlaceRadicarAsignar ['enlace'] = "pagina=radicarAsignar";
$enlaceRadicarAsignar ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceRadicarAsignar ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceRadicarAsignar ['enlace'], $directorio);
$enlaceRadicarAsignar ['nombre'] = "Soportes Entradas";


// Radicar entrada y salida de elementos

$enlaceradicarEntradaSalida ['enlace'] = "pagina=radicarEntradaSalida";
$enlaceradicarEntradaSalida ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceradicarEntradaSalida ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceradicarEntradaSalida ['enlace'], $directorio);
$enlaceradicarEntradaSalida ['nombre'] = "Entrada y Salida de Elementos";


//Asignar inventarios a Contratistas

$enlaceasignarInventarioC ['enlace'] = "pagina=asignarInventarioC";
$enlaceasignarInventarioC ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceasignarInventarioC ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceasignarInventarioC ['enlace'], $directorio);
$enlaceasignarInventarioC ['nombre'] = "Asignación de  Elementos a Contratistas";

//modificar inventarios a Contratistas

$enlaceconsultarAsignacion ['enlace'] = "pagina=consultarAsignacion";
$enlaceconsultarAsignacion ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceconsultarAsignacion ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceconsultarAsignacion ['enlace'], $directorio);
$enlaceconsultarAsignacion ['nombre'] = "Modificar Asignación de  Elementos a Contratistas";

//descargar inventarios a Contratistas

$enlacedescargarInventario ['enlace'] = "pagina=descargarInventario";
$enlacedescargarInventario ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlacedescargarInventario ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlacedescargarInventario ['enlace'], $directorio);
$enlacedescargarInventario ['nombre'] = "Descargar  Elementos a Contratista";

// Reportico
$enlaceReportico ['enlace'] = "pagina=reportico";
$enlaceReportico ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceReportico ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceReportico ['enlace'], $directorio);
$enlaceReportico ['nombre'] = "Reportes Específicos";

//generar paz y salvo
$enlacegenerarPazSalvo ['enlace'] = "pagina=generarPazSalvo";
$enlacegenerarPazSalvo ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlacegenerarPazSalvo ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlacegenerarPazSalvo ['enlace'], $directorio);
$enlacegenerarPazSalvo ['nombre'] = "Generar Paz y Salvo Contratista";


//generar paz y salvo
$enlacegenerarPazSalvo ['enlace'] = "pagina=generarPazSalvo";
$enlacegenerarPazSalvo ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlacegenerarPazSalvo ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlacegenerarPazSalvo ['enlace'], $directorio);
$enlacegenerarPazSalvo ['nombre'] = "Generar Paz y Salvo Contratista";

//gestión depreciación - registro
$enlaceregistrarDepreciacion ['enlace'] = "pagina=registrarDepreciacion";
$enlaceregistrarDepreciacion ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceregistrarDepreciacion ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceregistrarDepreciacion ['enlace'], $directorio);
$enlaceregistrarDepreciacion ['nombre'] = "Generar Depreciación por Elemento";

//gestión depreciación - general
$enlacedepreciacionGeneral ['enlace'] = "pagina=depreciacionGeneral";
$enlacedepreciacionGeneral ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlacedepreciacionGeneral ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlacedepreciacionGeneral ['enlace'], $directorio);
$enlacedepreciacionGeneral ['nombre'] = "Generar Depreciación por Grupo ";

//gestión depreciación - modificación
$enlacemodificarDepreciacion ['enlace'] = "pagina=modificarDepreciacion";
$enlacemodificarDepreciacion ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlacemodificarDepreciacion ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlacemodificarDepreciacion ['enlace'], $directorio);
$enlacemodificarDepreciacion ['nombre'] = "Modificar Depreciación";

// gestion usuarios
$enlaceUsuarios ['enlace'] = "pagina=gestionUsuarios";
$enlaceUsuarios ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceUsuarios ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceUsuarios ['enlace'], $directorio);
$enlaceUsuarios ['nombre'] = "Gestión Usuarios";

//Administración Dependencias
$enlaceregistrarDependencia ['enlace'] = "pagina=agregarDependencia";
$enlaceregistrarDependencia['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceregistrarDependencia['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceregistrarDependencia['enlace'], $directorio);
$enlaceregistrarDependencia['nombre'] = "Dependencias";

// Bajas Elementos
$enlaceBajasElementos ['enlace'] = "pagina=registrarBajas";
$enlaceBajasElementos ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceBajasElementos ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceBajasElementos ['enlace'], $directorio);
$enlaceBajasElementos ['nombre'] = "Solicitar Bajas Elementos";



// Placas Elementos
$enlaceImpresionPlacas ['enlace'] = "pagina=impresionPlacas";
$enlaceImpresionPlacas ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceImpresionPlacas ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceImpresionPlacas ['enlace'], $directorio);
$enlaceImpresionPlacas ['nombre'] = "Placas Elementos";



// Aprobar Bajas Elementos
$enlaceAprobarBajas ['enlace'] = "pagina=aprobarBajas";
$enlaceAprobarBajas ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceAprobarBajas ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceAprobarBajas ['enlace'], $directorio);
$enlaceAprobarBajas ['nombre'] = "Aprobar Bajas Elementos";


// Radicacion movimientos  Elementos
$enlaceradicacionesElementos ['enlace'] = "pagina=radicacionesElementos";
$enlaceradicacionesElementos ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceradicacionesElementos ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceradicacionesElementos['enlace'], $directorio);
$enlaceradicacionesElementos['nombre'] = "Movimiento de Inventario";

// Cierre Contable
$enlaceCierreContable ['enlace'] = "pagina=cierreContable";
$enlaceCierreContable ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceCierreContable ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceCierreContable ['enlace'], $directorio);
$enlaceCierreContable ['nombre'] = "Registrar Cierre Contable";

// Reversa Contable
$enlaceReversaContable ['enlace'] = "pagina=reversaContable";
$enlaceReversaContable ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceReversaContable ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceReversaContable ['enlace'], $directorio);
$enlaceReversaContable ['nombre'] = "Consultar y Reversar Cierre Contable";


// Fin de la sesión
$enlaceFinSesion['enlace'] = "pagina=index";
$enlaceFinSesion['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceFinSesion['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceFinSesion['enlace'], $directorio);
$enlaceFinSesion['nombre'] = "Cerrar Sesión";

//------------------------------- Inicio del Menú-------------------------- //
//Full acceso
if ($nivel == '0') {
    ?>
  <nav id="cbp-hrmenu" class="cbp-hrmenu">
        <ul>
            <li style="font-family: Lato;color:#2c3670; font-weight: 700;" onclick="location.href ='<?php echo $enlacePrincipal['urlCodificada'] ?>'"><?php echo $enlacePrincipal['nombre'] ?></li>
            <li>
                <a href="#">Gestión de Compras</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Orden de Compra</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroOrdenCompra['urlCodificada'] ?>"><?php echo $enlaceRegistroOrdenCompra['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceConsultaOrdenCompra['urlCodificada'] ?>"><?php echo $enlaceConsultaOrdenCompra['nombre'] ?></a></li>
                            </ul>
                        </div>
                        <div>
                            <h4>Orden de Servicios</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroOrdenServicios['urlCodificada'] ?>"><?php echo $enlaceRegistroOrdenServicios['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceConsultaOrdenServicios['urlCodificada'] ?>"><?php echo $enlaceConsultaOrdenServicios['nombre'] ?></a></li>
                            </ul>
                        </div>
                        <div>
                            <h4>Contratos</h4>
                            <ul>
                                <li><a href="<?php echo $enlacegestionContrato['urlCodificada'] ?>"><?php echo $enlacegestionContrato['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Gestión Entrada y Salida</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner">
                        <div>
                            <h4>Acta de Recibido</h4>
                            <ul>
                                <li><a href="<?php echo $enlacegestionActa['urlCodificada'] ?>"><?php echo $enlacegestionActa['nombre'] ?></a></li>
                                <li><a href="<?php echo$enlaceconsultaActa['urlCodificada'] ?>"><?php echo $enlaceconsultaActa['nombre'] ?></a></li>
                                <li><a href="<?php echo$enlaceElementosActa['urlCodificada'] ?>"><?php echo $enlaceElementosActa['nombre'] ?></a></li>
                            </ul>
                        </div>

                        <div>
                            <h4>Entrada de Elementos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroEntradas['urlCodificada'] ?>"><?php echo $enlaceRegistroEntradas['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceConsultaEntradas['urlCodificada'] ?>"><?php echo $enlaceConsultaEntradas['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceModificarEntradas['urlCodificada'] ?>"><?php echo $enlaceModificarEntradas['nombre'] ?></a></li>  
                                <li><a href="<?php echo $enlaceActivarElementosActa['urlCodificada'] ?>"><?php echo $enlaceActivarElementosActa['nombre'] ?></a></li> 
                            </ul>
                        </div>

                        <div>
                            <h4>Salida de Elementos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroSalidas['urlCodificada'] ?>"><?php echo $enlaceRegistroSalidas['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceModificarSalidas['urlCodificada'] ?>"><?php echo $enlaceModificarSalidas['nombre'] ?></a></li>
                                  
                            </ul>
                        </div>

                        <div>
                            <h4>Gestión Contable</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceCierreContable['urlCodificada'] ?>"><?php echo $enlaceCierreContable['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceReversaContable['urlCodificada'] ?>"><?php echo $enlaceReversaContable['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Gestión de Elementos</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner">
                        <div>
                            <h4>Cargue de Elementos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroElementos['urlCodificada'] ?>"><?php echo $enlaceRegistroElementos['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceModificarElementos['urlCodificada'] ?>"><?php echo $enlaceModificarElementos['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceHojaVida['urlCodificada'] ?>"><?php echo $enlaceHojaVida['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceImpresionPlacas['urlCodificada'] ?>"><?php echo $enlaceImpresionPlacas['nombre'] ?></a></li> 
                            </ul>
                        </div>
                        <div>
                            <h4>Movimientos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceTrasladosElementos['urlCodificada'] ?>"><?php echo $enlaceTrasladosElementos['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceSobranteFlatanteElementos['urlCodificada'] ?>"><?php echo $enlaceSobranteFlatanteElementos['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceBajasElementos['urlCodificada'] ?>"><?php echo $enlaceBajasElementos['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceAprobarBajas['urlCodificada'] ?>"><?php echo $enlaceAprobarBajas['nombre'] ?></a></li>
								<li><a href="<?php echo $enlacereposicionElementos['urlCodificada'] ?>"><?php echo $enlacereposicionElementos['nombre'] ?></a></li>
								
                            </ul>
                        </div>

                        <div>
                          <h4>Levantamiento Físico</h4>
                            <ul>
                                <li><a href="<?php echo $enlacePeriodoLevantamiento['urlCodificada'] ?>"><?php echo $enlacePeriodoLevantamiento['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceFuncionarioElementos['urlCodificada'] ?>"><?php echo $enlaceFuncionarioElementos['nombre'] ?></a></li>
                        
                            </ul>
                        
                            <h4>Asignación de Elementos Contratistas</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceasignarInventarioC['urlCodificada'] ?>"><?php echo $enlaceasignarInventarioC['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceconsultarAsignacion['urlCodificada'] ?>"><?php echo $enlaceconsultarAsignacion['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlacedescargarInventario['urlCodificada'] ?>"><?php echo $enlacedescargarInventario['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlacegenerarPazSalvo['urlCodificada'] ?>"><?php echo $enlacegenerarPazSalvo['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Gestor Reportes</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Gestor Reportes</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceReportico['urlCodificada'] ?>"><?php echo $enlaceReportico['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceConsultaGeneral['urlCodificada'] ?>"><?php echo $enlaceConsultaGeneral['nombre'] ?></a></li>
                            </ul>
                        </div>
                        <div>
                            <h4>Reportes Depreciación</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceregistrarDepreciacion['urlCodificada'] ?>"><?php echo$enlaceregistrarDepreciacion['nombre'] ?></a></li>
                                <li><a href="<?php echo$enlacedepreciacionGeneral['urlCodificada'] ?>"><?php echo$enlacedepreciacionGeneral['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Radicación de Documentos</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Documentos Soporte</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRadicarAsignar['urlCodificada'] ?>"><?php echo $enlaceRadicarAsignar['nombre'] ?></a></li>
                                <li><a href="<?php echo$enlaceradicacionesElementos['urlCodificada'] ?>"><?php echo $enlaceradicacionesElementos['nombre'] ?></a></li>

                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Admin. Datos Básicos</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Gestión de Catálogos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceGestionarCatalogo['urlCodificada'] ?>"><?php echo $enlaceGestionarCatalogo['nombre'] ?></a></li>
                                <!--li><a href="<?php echo $enlaceregistrarDependencia['urlCodificada'] ?>"><?php echo $enlaceregistrarDependencia['nombre'] ?></a></li-->
                                <li><a href="<?php echo $enlaceGestionarGrupoC['urlCodificada'] ?>"><?php echo $enlaceGestionarGrupoC['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Mi Sesión</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Usuarios</h4>
                            <ul>
                                <!--li><a href="<?php echo $enlaceUsuarios['urlCodificada'] ?>"><?php echo ($enlaceUsuarios['nombre']) ?></a></li-->
                                <li><a href="<?php echo$enlaceFinSesion['urlCodificada'] ?>">Cerrar Sesión Administrador</a></li>
                                <li><a href="http://10.20.0.38/ws_arka_android/com.arkamovil.android-2%20(2).apk">Obtener ARKA MOVIL</a></li>
                            </ul>
                        </div>
    <div>
                            <h4>Ayuda</h4>
                            <ul>
                                <li><a target="_blank" href="https://drive.google.com/folderview?id=0BzG7rdBcnWhofk9Fa0lyZ1V5Zl83VF9DU2o3ZXZ1anhiS005aFdVUEpEX0VwcWhVSnNtZUU&usp=sharing_eid">Manuales de Usuario</a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
        </ul>
    </nav>
    <?php
}
//Perfil Jefe de Almacén
if ($nivel == '1') {
    ?>
<nav id="cbp-hrmenu" class="cbp-hrmenu">
        <ul>
            <li style="font-family: Lato;color:#2c3670; font-weight: 700;" onclick="location.href ='<?php echo $enlacePrincipal['urlCodificada'] ?>'"><?php echo $enlacePrincipal['nombre'] ?></li>
            <li>
                <a href="#">Gestión de Compras</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Orden de Compra</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroOrdenCompra['urlCodificada'] ?>"><?php echo $enlaceRegistroOrdenCompra['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceConsultaOrdenCompra['urlCodificada'] ?>"><?php echo $enlaceConsultaOrdenCompra['nombre'] ?></a></li>
                            </ul>
                        </div>
                        <div>
                            <h4>Orden de Servicios</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroOrdenServicios['urlCodificada'] ?>"><?php echo $enlaceRegistroOrdenServicios['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceConsultaOrdenServicios['urlCodificada'] ?>"><?php echo $enlaceConsultaOrdenServicios['nombre'] ?></a></li>
                            </ul>
                        </div>
                        <div>
                            <h4>Contratos Vicerrectoría</h4>
                            <ul>
                                <li><a href="<?php echo $enlacegestionContrato['urlCodificada'] ?>"><?php echo $enlacegestionContrato['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Gestión Entrada y Salida</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner">
                        <div>
                            <h4>Acta de Recibido</h4>
                            <ul>
                                <li><a href="<?php echo $enlacegestionActa['urlCodificada'] ?>"><?php echo $enlacegestionActa['nombre'] ?></a></li>
                                <li><a href="<?php echo$enlaceconsultaActa['urlCodificada'] ?>"><?php echo $enlaceconsultaActa['nombre'] ?></a></li>
                            </ul>
                        </div>

                        <div>
                            <h4>Entrada de Elementos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroEntradas['urlCodificada'] ?>"><?php echo $enlaceRegistroEntradas['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceConsultaEntradas['urlCodificada'] ?>"><?php echo $enlaceConsultaEntradas['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceModificarEntradas['urlCodificada'] ?>"><?php echo $enlaceModificarEntradas['nombre'] ?></a></li>  
                            </ul>
                        </div>

                        <div>
                            <h4>Salida de Elementos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroSalidas['urlCodificada'] ?>"><?php echo $enlaceRegistroSalidas['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceModificarSalidas['urlCodificada'] ?>"><?php echo $enlaceModificarSalidas['nombre'] ?></a></li>
                                  
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
            <li>
                <a href="#">Gestión de Elementos</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner">
                        <div>
                            <h4>Cargue de Elementos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroElementos['urlCodificada'] ?>"><?php echo $enlaceRegistroElementos['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceModificarElementos['urlCodificada'] ?>"><?php echo $enlaceModificarElementos['nombre'] ?></a></li> 
                                <li><a href="<?php echo $enlaceHojaVida['urlCodificada'] ?>"><?php echo $enlaceHojaVida['nombre'] ?></a></li>
                            </ul>
                        </div>
                        <div>
                            <h4>Movimientos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceTrasladosElementos['urlCodificada'] ?>"><?php echo $enlaceTrasladosElementos['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceSobranteFlatanteElementos['urlCodificada'] ?>"><?php echo $enlaceSobranteFlatanteElementos['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceBajasElementos['urlCodificada'] ?>"><?php echo $enlaceBajasElementos['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceAprobarBajas['urlCodificada'] ?>"><?php echo $enlaceAprobarBajas['nombre'] ?></a></li>
                            </ul>
                        </div>

                        <div>
                            <h4>Asignación de Elementos Contratistas</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceasignarInventarioC['urlCodificada'] ?>"><?php echo $enlaceasignarInventarioC['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceconsultarAsignacion['urlCodificada'] ?>"><?php echo $enlaceconsultarAsignacion['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlacedescargarInventario['urlCodificada'] ?>"><?php echo $enlacedescargarInventario['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlacegenerarPazSalvo['urlCodificada'] ?>"><?php echo $enlacegenerarPazSalvo['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Gestor Reportes</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Gestor Reportes</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceReportico['urlCodificada'] ?>"><?php echo $enlaceReportico['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceConsultaGeneral['urlCodificada'] ?>"><?php echo $enlaceConsultaGeneral['nombre'] ?></a></li>
                            </ul>
                        </div>
                        <div>
                            <h4>Reportes Depreciación</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceregistrarDepreciacion['urlCodificada'] ?>"><?php echo$enlaceregistrarDepreciacion['nombre'] ?></a></li>
                                <li><a href="<?php echo$enlacedepreciacionGeneral['urlCodificada'] ?>"><?php echo$enlacedepreciacionGeneral['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Radicación de Documentos</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Documentos Soporte</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRadicarAsignar['urlCodificada'] ?>"><?php echo $enlaceRadicarAsignar['nombre'] ?></a></li>
                                <li><a href="<?php echo$enlaceradicacionesElementos['urlCodificada'] ?>"><?php echo $enlaceradicacionesElementos['nombre'] ?></a></li>

                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Admin. Datos Básicos</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Gestión de Catálogos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceGestionarCatalogo['urlCodificada'] ?>"><?php echo $enlaceGestionarCatalogo['nombre'] ?></a></li>
                                <!--li><a href="<?php echo $enlaceregistrarDependencia['urlCodificada'] ?>"><?php echo $enlaceregistrarDependencia['nombre'] ?></a></li-->
                                <li><a href="<?php echo $enlaceGestionarGrupoC['urlCodificada'] ?>"><?php echo $enlaceGestionarGrupoC['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Mi Sesión</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Usuarios</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceFinSesion['urlCodificada'] ?>">Cerrar Sesión Jefe Almacén</a></li>
                                <li><a href="http://10.20.0.38/ws_arka_android/com.arkamovil.android-2%20(2).apk">Obtener ARKA MOVIL</a></li>
                            </ul>
                        </div>
    <div>
                            <h4>Ayuda</h4>
                            <ul>
                                <li><a target="_blank" href="https://drive.google.com/folderview?id=0BzG7rdBcnWhofk9Fa0lyZ1V5Zl83VF9DU2o3ZXZ1anhiS005aFdVUEpEX0VwcWhVSnNtZUU&usp=sharing_eid">Manuales de Usuario</a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
        </ul>
    </nav>
    <?php
}
//Perfil Contabilidad
if ($nivel == '3') {
    ?>
<nav id="cbp-hrmenu" class="cbp-hrmenu">
        <ul>
            <li style="font-family: Lato;color:#2c3670; font-weight: 700;" onclick="location.href ='<?php echo $enlacePrincipal['urlCodificada'] ?>'"><?php echo $enlacePrincipal['nombre'] ?></li>
            <li>
                <a href="#">Gestión Entrada y Salida</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner">
                        <div>
                            <h4>Gestión Contable</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceCierreContable['urlCodificada'] ?>"><?php echo $enlaceCierreContable['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceReversaContable['urlCodificada'] ?>"><?php echo $enlaceReversaContable['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
            <li>
                <a href="#">Gestor Reportes</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Gestor Reportes</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceReportico['urlCodificada'] ?>"><?php echo $enlaceReportico['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceConsultaGeneral['urlCodificada'] ?>"><?php echo $enlaceConsultaGeneral['nombre'] ?></a></li>
                            </ul>
                        </div>
                        <div>
                            <h4>Reportes Depreciación</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceregistrarDepreciacion['urlCodificada'] ?>"><?php echo$enlaceregistrarDepreciacion['nombre'] ?></a></li>
                                <li><a href="<?php echo$enlacedepreciacionGeneral['urlCodificada'] ?>"><?php echo$enlacedepreciacionGeneral['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
            <li>
                <a href="#">Admin. Datos Básicos</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Gestión de Catálogos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceGestionarGrupoC['urlCodificada'] ?>"><?php echo $enlaceGestionarGrupoC['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
            <li>
                <a href="#">Mi Sesión</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Usuarios</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceFinSesion['urlCodificada'] ?>">Cerrar Sesión Contabilidad</a></li>
                            </ul>
                        </div>
    <div>
                            <h4>Ayuda</h4>
                            <ul>
                                <li><a target="_blank" href="https://drive.google.com/folderview?id=0BzG7rdBcnWhofk9Fa0lyZ1V5Zl83VF9DU2o3ZXZ1anhiS005aFdVUEpEX0VwcWhVSnNtZUU&usp=sharing_eid">Manuales de Usuario</a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

        </ul>
    </nav>
    <?php
}
//Perfil Compras
if ($nivel == '2') {
    ?>
    <nav id="cbp-hrmenu" class="cbp-hrmenu">
        <ul>
            <li style="font-family: Lato;color:#2c3670; font-weight: 700;" onclick="location.href ='<?php echo $enlacePrincipal['urlCodificada'] ?>'"><?php echo $enlacePrincipal['nombre'] ?></li>
            <li>
                <a href="#">Gestión de Compras</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Orden de Compra</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroOrdenCompra['urlCodificada'] ?>"><?php echo $enlaceRegistroOrdenCompra['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceConsultaOrdenCompra['urlCodificada'] ?>"><?php echo $enlaceConsultaOrdenCompra['nombre'] ?></a></li>
                            </ul>
                        </div>
                        <div>
                            <h4>Orden de Servicios</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroOrdenServicios['urlCodificada'] ?>"><?php echo $enlaceRegistroOrdenServicios['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceConsultaOrdenServicios['urlCodificada'] ?>"><?php echo $enlaceConsultaOrdenServicios['nombre'] ?></a></li>
                            </ul>
                        </div>
                        <div>
                            <h4>Contratos Vicerrectoría</h4>
                            <ul>
                                <li><a href="<?php echo $enlacegestionContrato['urlCodificada'] ?>"><?php echo $enlacegestionContrato['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Gestión Entrada y Salida</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner">
                        <div>
                            <h4>Acta de Recibido</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceconsultaActa['urlCodificada'] ?>"><?php echo $enlaceconsultaActa['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>


            <li>
                <a href="#">Mi Sesión</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Usuarios</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceFinSesion['urlCodificada'] ?>">Cerrar Sesión Asistente Compras</a></li>
                            </ul>
                        </div>
    <div>
                            <h4>Ayuda</h4>
                            <ul>
                                <li><a target="_blank" href="https://drive.google.com/folderview?id=0BzG7rdBcnWhofk9Fa0lyZ1V5Zl83VF9DU2o3ZXZ1anhiS005aFdVUEpEX0VwcWhVSnNtZUU&usp=sharing_eid">Manuales de Usuario</a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
        </ul>
    </nav>
    <?php
}
//Perfil Asistente Almacén
if ($nivel == '4') {
    ?>
   <nav id="cbp-hrmenu" class="cbp-hrmenu">
        <ul>
            <li style="font-family: Lato;color:#2c3670; font-weight: 700;" onclick="location.href ='<?php echo $enlacePrincipal['urlCodificada'] ?>'"><?php echo $enlacePrincipal['nombre'] ?></li>

            <li>
                <a href="#">Gestión Entrada y Salida</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner">
                        <div>
                            <h4>Acta de Recibido</h4>
                            <ul>
                                <li><a href="<?php echo $enlacegestionActa['urlCodificada'] ?>"><?php echo $enlacegestionActa['nombre'] ?></a></li>
                                <li><a href="<?php echo$enlaceconsultaActa['urlCodificada'] ?>"><?php echo $enlaceconsultaActa['nombre'] ?></a></li>
                            </ul>
                        </div>

                        <div>
                            <h4>Entrada de Elementos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroEntradas['urlCodificada'] ?>"><?php echo $enlaceRegistroEntradas['nombre'] ?></a></li>
                                <!--li><a href="<?php echo $enlaceConsultaEntradas['urlCodificada'] ?>"><?php echo $enlaceConsultaEntradas['nombre'] ?></a></li-->
                                <li><a href="<?php echo $enlaceModificarEntradas['urlCodificada'] ?>"><?php echo $enlaceModificarEntradas['nombre'] ?></a></li>  
                            </ul>
                        </div>

                        <div>
                            <h4>Salida de Elementos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroSalidas['urlCodificada'] ?>"><?php echo $enlaceRegistroSalidas['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceModificarSalidas['urlCodificada'] ?>"><?php echo $enlaceModificarSalidas['nombre'] ?></a></li>
                                
                                  
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Gestión de Elementos</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner">
                        <div>
                            <h4>Cargue de Elementos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRegistroElementos['urlCodificada'] ?>"><?php echo $enlaceRegistroElementos['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceModificarElementos['urlCodificada'] ?>"><?php echo $enlaceModificarElementos['nombre'] ?></a></li> 
                                <li><a href="<?php echo $enlaceHojaVida['urlCodificada'] ?>"><?php echo $enlaceHojaVida['nombre'] ?></a></li>
                            </ul>
                        </div>
                        <div>
                            <h4>Movimientos</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceTrasladosElementos['urlCodificada'] ?>"><?php echo $enlaceTrasladosElementos['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceSobranteFlatanteElementos['urlCodificada'] ?>"><?php echo $enlaceSobranteFlatanteElementos['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceBajasElementos['urlCodificada'] ?>"><?php echo $enlaceBajasElementos['nombre'] ?></a></li>
                                <!--li><a href="<?php echo $enlaceAprobarBajas['urlCodificada'] ?>"><?php echo $enlaceAprobarBajas['nombre'] ?></a></li-->
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Gestor Reportes</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Gestor Reportes</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceReportico['urlCodificada'] ?>"><?php echo $enlaceReportico['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlacegenerarPazSalvo['urlCodificada'] ?>"><?php echo $enlacegenerarPazSalvo['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceConsultaGeneral['urlCodificada'] ?>"><?php echo $enlaceConsultaGeneral['nombre'] ?></a></li>
                            </ul>
                        </div>
                        <div>
                            <h4>Reportes Depreciación</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceregistrarDepreciacion['urlCodificada'] ?>"><?php echo$enlaceregistrarDepreciacion['nombre'] ?></a></li>
                                <li><a href="<?php echo$enlacedepreciacionGeneral['urlCodificada'] ?>"><?php echo$enlacedepreciacionGeneral['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Radicación de Documentos</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Documentos Soporte</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceRadicarAsignar['urlCodificada'] ?>"><?php echo $enlaceRadicarAsignar['nombre'] ?></a></li>
                                <li><a href="<?php echo$enlaceradicacionesElementos['urlCodificada'] ?>"><?php echo $enlaceradicacionesElementos['nombre'] ?></a></li>

                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Mi Sesión</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Usuarios</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceFinSesion['urlCodificada'] ?>">Cerrar Sesión Asistente Almacén</a></li>
                                <li><a href="http://10.20.0.38/ws_arka_android/com.arkamovil.android-2%20(2).apk">Obtener ARKA MOVIL</a></li>
                            </ul>
                        </div>
    <div>
                            <h4>Ayuda</h4>
                            <ul>
                                <li><a target="_blank" href="https://drive.google.com/folderview?id=0BzG7rdBcnWhofk9Fa0lyZ1V5Zl83VF9DU2o3ZXZ1anhiS005aFdVUEpEX0VwcWhVSnNtZUU&usp=sharing_eid">Manuales de Usuario</a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
        </ul>
    </nav>
    <?php
}
//Perfil Asistente Jurídica
if ($nivel == '5') {
    ?>
<nav id="cbp-hrmenu" class="cbp-hrmenu">
        <ul>
            <li style="font-family: Lato;color:#2c3670; font-weight: 700;" onclick="location.href ='<?php echo $enlacePrincipal['urlCodificada'] ?>'"><?php echo $enlacePrincipal['nombre'] ?></li>
            <li>
                <a href="#">Gestión de Compras</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Contratos Vicerrectoría</h4>
                            <ul>
                                <li><a href="<?php echo $enlacegestionContrato['urlCodificada'] ?>"><?php echo $enlacegestionContrato['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
            <li>
                <a href="#">Mi Sesión</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Usuarios</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceFinSesion['urlCodificada'] ?>">Cerrar Sesión Asistente Jurídica</a></li>
                            </ul>
                        </div>
    <div>
                            <h4>Ayuda</h4>
                            <ul>
                                <li><a target="_blank" href="https://drive.google.com/folderview?id=0BzG7rdBcnWhofk9Fa0lyZ1V5Zl83VF9DU2o3ZXZ1anhiS005aFdVUEpEX0VwcWhVSnNtZUU&usp=sharing_eid">Manuales de Usuario</a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
        </ul>
    </nav>
    <?php
}
//Perfil de Analista
if ($nivel == '6') {
    ?>
    <nav id="cbp-hrmenu" class="cbp-hrmenu">
        <ul>
            <li>
                <a href="#">Gestor Reportes</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Gestor Reportes</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceReportico['urlCodificada'] ?>"><?php echo $enlaceReportico['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlacegenerarPazSalvo['urlCodificada'] ?>"><?php echo $enlacegenerarPazSalvo['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceConsultaGeneral['urlCodificada'] ?>"><?php echo $enlaceConsultaGeneral['nombre'] ?></a></li>
                            </ul>
                        </div>
                        <div>
                            <h4>Reportes Depreciación</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceregistrarDepreciacion['urlCodificada'] ?>"><?php echo$enlaceregistrarDepreciacion['nombre'] ?></a></li>
                                <li><a href="<?php echo$enlacedepreciacionGeneral['urlCodificada'] ?>"><?php echo$enlacedepreciacionGeneral['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
            <li>
                <a href="#">Mi Sesión</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Usuarios</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceFinSesion['urlCodificada'] ?>">Cerrar Sesión Analista</a></li>
                            </ul>
                        </div>
    <div>
                            <h4>Ayuda</h4>
                            <ul>
                                <li><a target="_blank" href="https://drive.google.com/folderview?id=0BzG7rdBcnWhofk9Fa0lyZ1V5Zl83VF9DU2o3ZXZ1anhiS005aFdVUEpEX0VwcWhVSnNtZUU&usp=sharing_eid">Manuales de Usuario</a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
        </ul>
    </nav>
    <?php
}
//Perfil Supervisor
if ($nivel == '7') {
    ?>
<nav id="cbp-hrmenu" class="cbp-hrmenu">
        <ul>
            <li style="font-family: Lato;color:#2c3670; font-weight: 700;" onclick="location.href ='<?php echo $enlacePrincipal['urlCodificada'] ?>'"><?php echo $enlacePrincipal['nombre'] ?></li>
            <li>
                <a href="#">Gestión de Elementos</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner">
                        <div>
                            <h4>Asignación de Elementos Contratistas</h4>
                            <ul>
                                <li><a href="<?php echo $enlaceasignarInventarioC['urlCodificada'] ?>"><?php echo $enlaceasignarInventarioC['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlaceconsultarAsignacion['urlCodificada'] ?>"><?php echo $enlaceconsultarAsignacion['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlacedescargarInventario['urlCodificada'] ?>"><?php echo $enlacedescargarInventario['nombre'] ?></a></li>

                                <li><a href="<?php echo $enlacegenerarPazSalvo['urlCodificada'] ?>"><?php echo $enlacegenerarPazSalvo['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Gestor Reportes</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Gestor Reportes</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceReportico['urlCodificada'] ?>"><?php echo $enlaceReportico['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Mi Sesión</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Usuarios</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceFinSesion['urlCodificada'] ?>">Cerrar Sesión Supervisor</a></li>
                            </ul>
                        </div>
    <div>
                            <h4>Ayuda</h4>
                            <ul>
                                <li><a target="_blank" href="https://drive.google.com/folderview?id=0BzG7rdBcnWhofk9Fa0lyZ1V5Zl83VF9DU2o3ZXZ1anhiS005aFdVUEpEX0VwcWhVSnNtZUU&usp=sharing_eid">Manuales de Usuario</a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
        </ul>
    </nav>
    <?php
}
//Perfil Contratista
if ($nivel == '8') {
    ?>
 <nav id="cbp-hrmenu" class="cbp-hrmenu">
        <ul>
            <li style="font-family: Lato;color:#2c3670; font-weight: 700;" onclick="location.href ='<?php echo $enlacePrincipal['urlCodificada'] ?>'"><?php echo $enlacePrincipal['nombre'] ?></li>
            <li>
                <a href="#">Gestor Reportes</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Gestor Reportes</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceReportico['urlCodificada'] ?>"><?php echo $enlaceReportico['nombre'] ?></a></li>
                                <li><a href="<?php echo $enlacegenerarPazSalvo['urlCodificada'] ?>"><?php echo $enlacegenerarPazSalvo['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Mi Sesión</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Usuarios</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceFinSesion['urlCodificada'] ?>">Cerrar Sesión Contratista</a></li>
                            </ul>
                        </div>
    <div>
                            <h4>Ayuda</h4>
                            <ul>
                                <li><a target="_blank" href="https://drive.google.com/folderview?id=0BzG7rdBcnWhofk9Fa0lyZ1V5Zl83VF9DU2o3ZXZ1anhiS005aFdVUEpEX0VwcWhVSnNtZUU&usp=sharing_eid">Manuales de Usuario</a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
        </ul>
    </nav>
    <?php
}
//Perfil Funcionario
if ($nivel == '9') {
    ?>
<nav id="cbp-hrmenu" class="cbp-hrmenu">
        <ul>
            <li style="font-family: Lato;color:#2c3670; font-weight: 700;" onclick="location.href ='<?php echo $enlacePrincipal['urlCodificada'] ?>'"><?php echo $enlacePrincipal['nombre'] ?></li>
            <li>
                <a href="#">Gestor Reportes</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Gestor Reportes</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceReportico['urlCodificada'] ?>"><?php echo $enlaceReportico['nombre'] ?></a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>

            <li>
                <a href="#">Mi Sesión</a>
                <div class="cbp-hrsub">
                    <div class="cbp-hrsub-inner"> 
                        <div>
                            <h4>Usuarios</h4>
                            <ul>
                                <li><a href="<?php echo$enlaceFinSesion['urlCodificada'] ?>">Cerrar Sesión Funcionario</a></li>
                            </ul>
                        </div>
    <div>
                            <h4>Ayuda</h4>
                            <ul>
                                <li><a target="_blank" href="https://drive.google.com/folderview?id=0BzG7rdBcnWhofk9Fa0lyZ1V5Zl83VF9DU2o3ZXZ1anhiS005aFdVUEpEX0VwcWhVSnNtZUU&usp=sharing_eid">Manuales de Usuario</a></li>
                            </ul>
                        </div>
                    </div><!-- /cbp-hrsub-inner -->
                </div><!-- /cbp-hrsub -->
            </li>
        </ul>
    </nav>
    <?php
}
