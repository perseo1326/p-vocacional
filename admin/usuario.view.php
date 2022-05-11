    <?php 

    require_once '../views/header.view.php';

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
                <input type="text" name="nombre" id="nombre" class="desactivado" value="<?php echo $datosPersonales['nombre']; ?>" onblur="javascript:validarTextosEdicion('nombre', false)" maxlength="98" readonly>
                <label for="apellido1">Primer Apellido: </label>
                <input type="text" name="apellido1" id="apellido1" class="desactivado" value="<?php echo $datosPersonales['apellido1']; ?>" onblur="javascript:validarTextosEdicion('apellido1', false)" maxlength="49" readonly>
                <label for="apellido2">Segundo Apellido</label>
                <input type="text" name="apellido2" id="apellido2" class="desactivado" value="<?php echo $datosPersonales['apellido2']; ?>" onblur="javascript:validarTextosEdicion('apellido2', false)"  maxlength="49" readonly>
                <label for="nacimiento">Fecha de Nacimiento: </label>
                <input type="text" name="nacimiento" id="nacimiento" class="desactivado" value="<?php echo $datosPersonales['nacimiento']; ?>" readonly>
                <label for="telefono">Teléfono: </label>
                <input type="text" name="telefono" id="telefono" class="desactivado" value="<?php echo $datosPersonales['telefono']; ?>" onblur="javascript:validarNumerosTelEdicion('telefono', false)"  maxlength="19" readonly>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" class="desactivado" value="<?php echo $datosPersonales['email']; ?>" onblur="javascript:validarEmailFormularioEdicion('email')" readonly>
                <label for="intereses">Prueba de Intereses</label>
                <input type="text" name="intereses" id="" class="<?php echo $errorIntereses; ?>" value="<?php echo $datosPersonales['Intereses']['fecha']; ?>" readonly>
                <label for="aptitudes">Prueba de Aptitudes</label>
                <input type="text" name="aptitudes" id="" class="<?php echo $errorAptitudes; ?>" value="<?php echo $datosPersonales['Aptitudes']['fecha']; ?>" readonly>
                <div>
                <input type="button" value="Notas" onclick="javascript:mostrarFormulario('notas', 'notas')">
                </div>
                <textarea name="notas" id="notas" cols="30" rows="7" placeholder="Notas..." readonly ><?php echo $datosPersonales['notas']; ?></textarea>
                <p id="errorDatos" class=""></p>
                <input class="verde" id="editarGuardarInfo" type="button" value="Editar Información" onclick="javascript:editarInformacion('editarGuardarInfo')">
            </form>
        </div>

        <!-- Mostrar grafico general -->
        <div class="grafico-general" id="grafico-general">
        </div>

        <?php if(!$datosPersonales['Intereses']['Prueba'] || !$datosPersonales['Aptitudes']['Prueba']): ?>
            <div class="caja-mediana error">
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
            <input class="boton " type="button" value="Cerrar ventana" onclick="javascript:cerrarDetalleUsuario()">
            <input class="boton derecha" type="button" value="Ver Respuestas" onclick="javascript:nuevaVentana()">
        </div>
    </div>

    <?php
    if (isset($grafico_script)) {
        require_once $grafico_script; 
    }
    require_once '../views/footer.view.php';

    ?>
    <!-- <script src="../js/busquedas.js"></script> -->
    <script src="<?php echo RUTA; ?>js/busquedas.js"></script>

    <script>
        var ventanaDetallePreguntas = null;

        function nuevaVentana() {
        let alto = screen.availHeight;
        let ancho = screen.availWidth;
        ancho = Math.round(ancho / 3);
        alto = Math.round(alto / 6);

        console.log(ventanaDetallePreguntas);
        if (ventanaDetallePreguntas == null || ventanaDetallePreguntas.closed) {
            ventanaDetallePreguntas = window.open('<?php echo RUTA; ?>admin/preguntas.php?id=<?php echo $id; ?>', 'detallePreguntas', 'fullscreen=1,left=' + ancho + ',top=' + alto +',width=' + (2*ancho) + ',height=' + (5*alto) + ',location=0,titlebar=0,menubar=0,scrollbars=1,status=1,resizable=1');
            ventanaDetallePreguntas.focus();
        } else {
            ventanaDetallePreguntas.focus();
        }
        }

        function cerrarDetalleUsuario() {
        if (ventanaDetallePreguntas == null || ventanaDetallePreguntas.closed) {
            window.close();
        } else {
            ventanaDetallePreguntas.close();
            window.opener.focus();
            window.close();
        }

        }

        // variable permite controlar las clases segun este en modo edicion o solo lectura
        var modoEdicion = false;
        var campos = [];
        var valoresOriginales = [];
        campos[0] = document.getElementById('nombre');
        campos[1] = document.getElementById('apellido1');
        campos[2] = document.getElementById('apellido2');
        campos[3] = document.getElementById('telefono');
        campos[4] = document.getElementById('email');
        campos[5] = document.getElementById('notas');
        
        // copiar los valores actuales de las variables para comparar mas adelante
        valoresOriginales[0] = campos[0].value;
        valoresOriginales[1] = campos[1].value;
        valoresOriginales[2] = campos[2].value;
        valoresOriginales[3] = campos[3].value;
        valoresOriginales[4] = campos[4].value;
        valoresOriginales[5] = campos[5].value;
    
    </script>

    </body>
    </html>