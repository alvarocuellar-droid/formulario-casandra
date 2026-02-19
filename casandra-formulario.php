<?php
/*
Plugin Name: casandraformulario
Description: Un formulario de contacto básico creado manualmente.
Version: 1.0
Author: Alvaro Cuellar
*/


function casandraformulario_shortcode()
{ // Función para generar el formulario
    ob_start();
    ?>
    <!--<div class="contenedor-formulario">
        
        <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" id="cf-form">
            <h3>PIDE CITA</h3>

            <div class="cf-section cf-personal-data">
                <input type="text" class="cf-input" id="cf-name" name="cf-name" placeholder="NOMBRE Y APELLIDOS" required><br>
                <input type="tel" class="cf-input" id="cf-telephone" name="cf-telephone" placeholder="TELÉFONO" required><br>
                <input type="email" class="cf-input" id="cf-email" name="cf-email" placeholder="EMAIL" required><br>
            </div>
            <div class="cf-section cf-services">
                <button type="button" class="cf-btn-service">TERAPIA HORMONAL integral</button><br>
                <button type="button" class="cf-btn-service">consultar mi caso</button><br>
                <button type="button" class="cf-btn-service">CASANDRA CARE</button><br>
                <button type="button" class="cf-btn-service">lorem ipsum</button><br>
            </div>
            <div class="cf-section cf-legal">
                <div class="cf-checkbox-group">
                    <input type="checkbox" name="cf-terms" id="cf-terms" required>
                    <label for="cf-terms">Acepto la política de privacidady de proteccion de datos</label>
                </div>
                <div class="cf-checkbox-group">
                    <input type="checkbox" name="cf-newsletter" id="cf-newsletter">
                    <label for="cf-newsletter">Suscribirse a la newsletter</label>
                </div>

            </div>
            <div class="cf-section cf-actions">
                <div class="cf-action-group">
                    <button type="button" id="cf-date" class="cf-btn-main">SELECCIONAR FECHA</button>
                    <label for="cf-date">Elige tú misma la fecha y hora que prefieras</label>
                </div>

                <div class="cf-action-group">
                    <button type="button" id="cf-call" class="cf-btn-main">TE LLAMAMOS</button>
                    <label for="cf-call">Te llamamos para acordar la fecha y hora de tu visita</label>
                </div>
            </div>
            <hr>
            <div class="cf-footer-links">
                <label class="cf-footer-links"><a href="#">Ver política de privacidad y protección de datos</a></label><br>
                <label class="cf-footer-links"><a href="#">Ver Suscripción a la Newsletter</a></label>
            </div>
        </form>
    </div>
        -->
    <div class="contenedor-formulario">
        <form class="multi-step-form" action="javascript:" method="POST" id="cf-form">

            <div class="step active visible" id="fc-step-inicio">

                <div class="cf-section cf-personal-data">
                    <input type="text" class="cf-input" id="cf-name" name="cf-name" placeholder="NOMBRE Y APELLIDOS" required><br>
                    <input type="tel" class="cf-input" id="cf-telephone" name="cf-telephone" placeholder="TELÉFONO" required><br>
                    <input type="email" class="cf-input" id="cf-email" name="cf-email" placeholder="EMAIL" required><br>
                </div>
                <div class="cf-section cf-services">
                    <div class="cf-pill-selector-container" data-options='[
                            {"label": "Terapia hormonal integral", "value": "1", "data-goto": "fc-step-test-1"},
                            {"label": "Consultar mi caso", "value": "2", "data-goto": "fc-step-disponibilidad"},
                            {"label": "Casandra CARE", "value": "3", "data-goto": "fc-step-disponibilidad"},
                            {"label": "Lorem ipsum", "value": "4", "data-goto": "fc-step-disponibilidad"}
                        ]'>
                        <input type="hidden" class="cf-pill-selector-value" name="motivo_consulta" value="">
                    </div>
                </div>
                <div class="cf-section cf-legal">
                    <div class="cf-checkbox-group">
                        <input type="checkbox" name="cf-terms" id="cf-terms" required>
                        <label for="cf-terms">Acepto la política de privacidady de proteccion de datos</label>
                    </div>
                    <div class="cf-checkbox-group">
                        <input type="checkbox" name="cf-newsletter" id="cf-newsletter">
                        <label for="cf-newsletter">Suscribirse a la newsletter</label>
                    </div>

                </div>
                <div class="cf-section cf-actions">
                    <div class="cf-action-group">
                        <button type="button" id="cf-date" class="cf-btn-main" data-goto="fc-step-disponibilidad">Ver disponibilidad</button>
                    </div>
                    <div class="cf-action-group">
                        <button type="button" id="cf-call" class="cf-btn-main" data-goto="fc-step-test-1">Test de compatibilidad</button>
                    </div>
                </div>
                <div class="cf-footer-links">
                    <label class="cf-footer-links"><a href="#">Ver política de privacidad y protección de datos</a></label><br>
                    <label class="cf-footer-links"><a href="#">Ver Suscripción a la Newsletter</a></label>
                </div>
            </div>
            <!-- Pantalla 2 -->
            <div class="step" id="fc-step-test-1">
                <h3 id="cf-test1-title">2.Situación Actual</h3>
                <div class="cf-step" id="step-situacion">
                    <h3>SITUACIÓN ACTUAL</h3>
                    <p class="cf-quote">"El equilibrio hormonal es la base de tu bienestar renovado."</p>

                    <div class="cf-section">
                        <div class="cf-question-row">
                            <label class="cf-checkbox-modern">
                                <input type="checkbox" name="cf_embarazada" value="si">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">¿Podrías estar embarazada?</span>
                            </label>
                        </div>

                        <div class="cf-question-row">
                            <label class="cf-checkbox-modern">
                                <input type="checkbox" name="cf_pecho" value="si">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">¿Estás dando el pecho?</span>
                            </label>
                        </div>

                        <div class="cf-question-row">
                            <label class="cf-checkbox-modern">
                                <input type="checkbox" name="cf_cirugia" id="cf_cirugia_trigger">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">¿Tienes cirugía ginecológica?</span>
                            </label>
                            <input type="text" name="cf_cirugia_cual" id="cf_cirugia_input" class="cf-input-sub" placeholder="¿Cuál?">
                        </div>
                    </div>

                    <div class="cf-section">
                        <h4>Última regla:</h4>
                        <div class="cf-question-row">
                            <label class="cf-checkbox-modern">
                                <input type="checkbox" name="cf_regla_12" id="cf_regla_trigger">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">Menos de 12 meses</span>
                            </label>
                            <input type="date" name="cf_regla_fecha" id="cf_regla_fecha" class="cf-input-sub">
                        </div>

                        <div class="cf-question-row">
                            <label class="cf-checkbox-modern">
                                <input type="checkbox" name="cf_regla_mas_12">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">Más de 12 meses</span>
                            </label>
                        </div>

                        <div class="cf-question-row">
                            <label class="cf-checkbox-modern">
                                <input type="checkbox" name="cf_regla_nose">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">No lo sé</span>
                            </label>
                        </div>
                    </div>

                    <div class="cf-section">
                        <h4>¿Tienes alguno de los siguientes síntomas?:</h4>
                        <?php
                        $sintomas = ["Sofocos y sudoraciones nocturnas", "Problemas de sueño", "Cambios de ánimo", "Sequedad vaginal", "Dolor durante las relaciones sexuales", "Disminución del deseo sexual", "Fatiga o falta de energía", "Ninguno"];
                        foreach ($sintomas as $s) {
                            echo '<div class="cf-question-row">
                    <label class="cf-checkbox-modern">
                        <input type="checkbox" name="cf_sintomas[]" value="' . $s . '">
                        <span class="cf-checkmark"></span>
                        <span class="cf-question-text">' . $s . '</span>
                    </label>
                  </div>';
                        }
                        ?>
                    </div>

                    <div class="cf-navigation">
                        <button type="button" class="cf-btn-next" data-next="step-final">CONTINUAR</button>
                    </div>
                </div>

                <button type="button" class="cf-btn-main" data-goto="fc-step-inicio">Volver</button>
                <button type="button" class="cf-btn-main" data-goto="fc-step-test-2">Siguiente</button>

            </div>
            <!-- Pantalla 3 -->
            <div class="step" id="fc-step-test-2">
                <h3>Test 2</h3>
                <button type="button" class="cf-btn-main" data-goto="fc-step-test-1">Volver</button>
                <button type="button" class="cf-btn-main" data-goto="fc-step-test-3">Siguiente</button>

            </div>
            <!-- Pantalla 4 -->
            <div class="step" id="fc-step-test-3">
                <h3>Test 3</h3>
                <button type="button" class="cf-btn-main" data-goto="fc-step-test-2">Volver</button>
                <button type="button" class="cf-btn-main" data-goto="fc-step-disponibilidad">Ver disponibilidad</button>

            </div>
            <!-- Apartado de disponibilidad con las fechas y horas dispopnibles -->
            <div class="step" id="fc-step-disponibilidad">
                DISPONIBILIDAD
            </div>

        </form>
    </div>

    <?php
    return ob_get_clean();
}

function casandra_cargar_estilos()
{ // Función para cargar los estilos CSS
    wp_enqueue_style('casandraformulario-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_script(
            'cf-pills',
            plugin_dir_url(__FILE__) . 'assets/js/pills.js',
            array(),
            '1.0',
            true
    );
    wp_enqueue_script(
            'cf-steps',
            plugin_dir_url(__FILE__) . 'assets/js/steps.js',
            array(), // Dependencias (ninguna por ahora)
            '1.0',
            true     // Cargar en el footer para que no ralentice la web
    );
}

function casandra_procesar_formulario()
{ // Función para procesar el formulario cuando se envía
    if (isset($_POST['cf-submitted'])) {
        $name = sanitize_text_field($_POST['cf-name']);
        $email = sanitize_email($_POST['cf-email']);
        $message = sanitize_textarea_field($_POST['cf-message']);

        // Aquí puedes agregar la lógica para procesar el formulario, como enviar un correo electrónico o guardar los datos en la base de datos.

        echo '<div class="cf-success">¡Gracias por tu mensaje!</div>';
    }
}

add_shortcode('casandraformulario', 'casandraformulario_shortcode');
add_action('wp_enqueue_scripts', 'casandra_cargar_estilos');
add_action('init', 'casandra_procesar_formulario');


?>