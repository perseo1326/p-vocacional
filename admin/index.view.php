    <?php 

    require_once __DIR__ . '/../views/header.view.php';
    $contador = 1;

    ?>
    <div id="area" class="contenedor body-color">
        <h1 class="titulo">Panel de Consulta</h1>
        <form class="formulario clearfix" id="formBuscar" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="javascript:return validarFormBusqueda()" method="post">
            <div class='caja-mediana'>
                <h2 class="">Buscar usuario por:</h2>
                <div class="subseccion">
                    <label for="nombre">Nombre(s):</label>
                    <input class="ancho" type="text" name="nombre" id="nombre" title="Solo letras de la A a la Z" onblur="javascript:validarTextos('nombre', 'ancho', true)" maxlength="98" value="<?php echo (isset($nombre)) ? $nombre : ''; ?>" >
                    <label for="apellido1">Primer Apellido:</label>
                    <input class="ancho" type="text" name="apellido1" id="apellido1" title="Solo letras de la A a la Z" onblur="javascript:validarTextos('apellido1', 'ancho', true)" maxlength="49" value="<?php echo (isset($apellido1)) ? $apellido1 : ''; ?>">
                    <label for="apellido2">Segundo Apellido</label>
                    <input class="ancho" type="text" name="apellido2" id="apellido2" title="Solo letras de la A a la Z" onblur="javascript:validarTextos('apellido2', 'ancho', true)" maxlength="49" value="<?php echo (isset($apellido2)) ? $apellido2 : ''; ?>">
                </div>

                <h3>Búsqueda por intervalos de fechas</h3>
                <div class="subseccion">
                    <input type="radio" id="noFecha" name="tipoFecha" value="noFecha" checked >
                    <label class="radioBut" for="noFecha" onclick="javascript:activarFechas(false)" >No usar fechas</label><br />
                    <input type="radio" id="nacimiento" name="tipoFecha" value="nacimiento" >
                    <label class="radioBut" for="nacimiento" onclick="javascript:activarFechas(true)" >Por fecha de Nacimiento</label><br />
                    <input type="radio" id="examen" name="tipoFecha" value="examen" >
                    <label class="radioBut" for="examen" onclick="javascript:activarFechas(true)">Por fecha de Exámen</label><br />
                    
                    <div class="contenedor-fecha" id="contenedorFecha">
                    
                        <div class="subseccion" >
                            <label for="fechaDesde">Desde:</label>
                            <input class="ancho" type="date" name="fechaDesde" id="fechaDesde" title="Formato para la fecha DD-MM-AAAA" placeholder="DD-MM-AAAA" onblur="javascript:validarEventoFecha('fechaDesde', 'ancho')" disabled value="<?php echo (isset($fechaDesde)) ? $fechaDesde : ''; ?>">
                            <label for="fechaHasta">Hasta</label>
                            <input class="ancho" type="date" name="fechaHasta" id="fechaHasta" title="Formato para la fecha DD-MM-AAAA" placeholder="DD-MM-AAAA" onblur="javascript:validarEventoFecha('fechaHasta', 'ancho')" disabled value="<?php echo (isset($fechaHasta)) ? $fechaHasta : ''; ?>">
                        </div>
                    </div> 
                </div>
                <div class="contenedor-flex">
                    <input class="ancho-25" type="submit" value="Buscar" >
                    <input class="ancho-25" type="button" value="Limpiar" onclick="javascript:limpiarFormulario()">
                </div>
            </div>
        </form>

        <?php regLog(__FILE__, __LINE__, "Index.view - L43 - 'revisar estructura de tabla'"); ?>

        <div id="resultados" class="<?php echo $claseError; ?>" tabindex="0">
            <h2 class="margen-bajo" ><?php echo $busqueda; ?></h2>
            <h3 class="margen-bajo" ><?php echo $mensaje; ?></h3>
            <?php if(!empty($resultados)) : ?>
                <table class="margen-bajo" id="tablaResultados" tabindex="0">
                    <thead>
                        <tr>
                            <th class="centrado tablaNumero" id="col1">#</th>
                            <th class="tablaNombre" id="col2">Nombres</th>
                            <th class="tablaApellido1" id="col3" title="1er Apellido" >1er Apellido</th>
                            <th class="tablaApellido2" id="col4" title="2do Apellido" >2do Apellido</th>

                            <?php if($tipoFecha == 'nacimiento') : ?>
                                <th class="tablaNacimiento" id="col5" title="Nacimiento" >Nacimiento</th>                                
                            <?php endif; ?>

                            <th class="centrado tablaPrueba" id="col5" title="Prueba Interéses" >P. Interéses</th>
                            <th class="centrado tablaPrueba" id="col5" title="Prueba Aptitudes" >P. Aptitudes</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $persona => $value) : ?>
                            <tr class="cursor" onclick="javascript:abrirVentanadetalle('<?php echo RUTA . 'admin/usuario.php?id=' . $value['id']; ?>')" >
                                    <td class="centrado"><?php echo $contador; ?>.</td>
                                    <td title="<?php echo $value['nombre']; ?>"><?php echo $value['nombre'];?></td>
                                    <td title="<?php echo $value['apellido1']; ?>"><?php echo $value['apellido1']; ?></td>
                                    <td title="<?php echo $value['apellido2']; ?>"><?php echo $value['apellido2']; ?></td>

                                    <?php if($tipoFecha == 'nacimiento') : ?>                        
                                        <td class="centrado" title="<?php echo $value['nacimiento']; ?>"><?php echo fechaFormato($value['nacimiento']); ?></td>
                                    <?php endif; ?>

                                    <td class="centrado" title="Prueba Intereses"><?php echo fechaFormato($value['fExamenIntereses']); ?></td>
                                    <td class="centrado" title="Prueba Aptitudes"><?php echo fechaFormato($value['fExamenAptitudes']); ?></td>
                            </tr>
                            <?php $contador++; ?>
                        <?php endforeach; ?>
                    </tbody>

                </table>
                <h3 class="margen-bajo"><?php echo $mensaje; ?></h3>
            <?php endif; ?>

        </div>
    </div>

    <?php
    require_once __DIR__ . '/../views/footer.view.php';
    ?>

    <!-- <script src="../js/busquedas.js"></script> -->
    <script src="<?php echo RUTA; ?>js/busquedas.js"></script>
    <script>
        // debugger;
        var ventanaDetalle = null;
        let x = document.getElementById('resultados');
        
        function abrirVentanadetalle(url) {
            console.log("URL= " + url);
            ventanaDetalle = window.open(url, 'ventanaDetalle', 'fullscreen=1,location=1,titlebar=1,menubar=1,scrollbars=1,status=1,resizable=1');
        }

        if (x.innerText != '') {
            x.focus();
        }

    </script>

    </body>
    </html>

