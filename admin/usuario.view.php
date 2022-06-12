    <?php 

    require_once __DIR__ . '/../views/header.view.php';

    $errorIntereses = $errorIntereses == '' ? 'desactivado' : $errorIntereses;
    $errorAptitudes = $errorAptitudes == '' ? 'desactivado' : $errorAptitudes;
    
    ?>

    <div id="area" class="contenedor">
        <h1 class="titulo">Resultados Pruebas</h1>
        <div class="caja caja-mediana fondo">  
            <h2>Datos Personales</h2>
            <form class="formulario resul-categorias" id="formUsuario" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre" id="nombre" class="ancho desactivado" value="<?php echo $datosPersonales['nombre']; ?>" maxlength="98" readonly>
                <label for="apellido1">Primer Apellido: </label>
                <input type="text" name="apellido1" id="apellido1" class="ancho desactivado" value="<?php echo $datosPersonales['apellido1']; ?>" maxlength="49" readonly>
                <label for="apellido2">Segundo Apellido</label>
                <input type="text" name="apellido2" id="apellido2" class="ancho desactivado" value="<?php echo $datosPersonales['apellido2']; ?>" maxlength="49" readonly>

                <div>
                    <button id="mostrarDetallesUsuario">Mostrar detalles <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                </div>

                <div id="datosPersonales" class="esconder resaltar-fondo">
                    <label for="nacimiento">Fecha de Nacimiento: </label>
                    <input type="text" name="nacimiento" id="nacimiento" class="ancho desactivado" value="<?php echo $datosPersonales['nacimiento']; ?>" readonly>
                    <label for="telefono">Teléfono: </label>
                    <input type="text" name="telefono" id="telefono" class="ancho desactivado" value="<?php echo $datosPersonales['telefono']; ?>" maxlength="19" readonly>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" class="ancho desactivado" value="<?php echo $datosPersonales['email']; ?>" readonly>
                </div>

                <label for="intereses">Prueba de Intereses</label>
                <input type="text" name="intereses" id="" class="ancho <?php echo $errorIntereses; ?>" value="<?php echo $datosPersonales['Intereses']['fecha']; ?>" readonly>
                <label for="aptitudes">Prueba de Aptitudes</label>
                <input type="text" name="aptitudes" id="" class="ancho <?php echo $errorAptitudes; ?>" value="<?php echo $datosPersonales['Aptitudes']['fecha']; ?>" readonly>

                <div>
                    <input type="button" value="Notas" onclick="javascript:mostrarFormulario('notas', 'notas')">
                    <!-- <input type="button" value="Notas" onclick="javascript:esconderPanel('notas')">  -->
                </div>
                
                <textarea name="notas" class="ancho esconder" id="notas" cols="30" rows="7" placeholder="Notas..." readonly ><?php echo $datosPersonales['notas']; ?></textarea>
                <p id="errorDatos" class=""></p>

                <div class="contenedor-flex">
                    <div class="ancho-50">
                        <input id="editarGuardarInfo" class="" type="button" value="Editar Información">
                    </div>
                    <div class="ancho-50 esconder" id="cancelarEdicion">
                        <input id="cancelarEditarInfo" class="rojo" type="button" value="Cancelar">
                    </div>
                </div>
            </form>
        </div>

        <!-- Mostrar grafico general -->
        <div class="grafico-general" id="grafico-general">
        </div>

        <?php if(!$datosPersonales['Intereses']['Prueba'] || !$datosPersonales['Aptitudes']['Prueba']): ?>
            <div class="caja-mediana errores">
                Las pruebas No han sido completadas. No hay datos que mostrar!!
            </div>

        <?php else : ?>
            <div class="resul-categorias" >
                <div class="cuadroConvenciones" onclick="javascript:mostrarCategoriasGeneral()">
                    <h3><u>Categorias: Area <?php echo INTERESES; ?></u></h3>
                    <ol id="catIntereses">

                        <?php foreach ($catIntereses as $key => $value) : ?>
                        <li><strong><?php echo $value['catTipo'] ;?></strong> => <?php echo $value['catNombre']; ?></li>

                        <?php if ($value['catId'] == $maxIntereses[0]) {
                            $catInteresesAlta_1 = $value['catNombre'];
                        } else if($value['catId'] == $maxIntereses[1]) {
                            $catInteresesAlta_2 = $value['catNombre'];
                        } ?>
                        
                        <?php endforeach; ?>

                    </ol>
                </div>

                <div class="cuadroConvenciones" onclick="javascript:mostrarCategoriasGeneral()">
                    <h3><u>Categorias: Area <?php echo APTITUDES; ?></u></h3>
                    <ol id="catAptitudes">

                        <?php foreach ($catAptitudes as $key => $value) : ?>
                        <li><strong><?php echo $value['catTipo'] ;?></strong> => <?php echo $value['catNombre']; ?></li>
                        <?php if ($value['catId'] == $maxAptitudes[0]) {
                            $catAptitudesAlta = $value['catNombre'];
                        } ?>
                        <?php endforeach; ?>

                    </ol>
                </div>
            </div>

            <h2>Area <?php echo INTERESES; ?></h2>
            <p><strong>Categorias: </strong><?php echo $catInteresesAlta_1 . ' - ' . $catInteresesAlta_2; ?></p>
            <p><?php echo $conclIntereses; ?></p>
            <h2>Area <?php echo APTITUDES; ?></h2>
            <p><Strong>Categoria: </strong><?php echo $catAptitudesAlta; ?></p>
            <p><?php echo $conclAptitudesExpli; ?></p>
            <p><strong>Carreras: </strong><?php echo $conclAptitudestexto; ?></p>
        <?php endif; ?>

        <!-- Caja pequeña para botones -->
        <div class="<?php echo $claseCajaBoton; ?>">
            <input class="boton " id="bCerrarDetalleUsuario" type="button" value="Cerrar ventana" >
            <!-- <input class="boton" type="button" value="Ver Respuestas" onclick="javascript:nuevaVentana()"> -->
        </div>
    </div>

    <?php
        if (isset($grafico_script)) {
            require_once $grafico_script; 
        }
        require_once __DIR__ . '/../views/footer.view.php';

    ?>
    <script src="<?php echo RUTA; ?>js/busquedas.js"></script>
    <script src="<?php echo RUTA; ?>js/adminUsuario.js"></script>


    </body>
    </html>