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
    <div class="contenedor-formulario">
        <form class="multi-step-form" action="javascript:" method="POST" id="cf-form">

            <div class="step active visible" id="fc-step-inicio">
                <h2>PIDE CITA</h2>
                <div class="cf-section cf-personal-data">
                    <input type="text" class="cf-input" id="cf-name" name="cf-name" placeholder="NOMBRE Y APELLIDOS" required><br>
                    <input type="tel" class="cf-input" id="cf-telephone" name="cf-telephone" placeholder="TELÉFONO" required><br>
                    <input type="email" class="cf-input" id="cf-email" name="cf-email" placeholder="EMAIL" required><br>
                </div>
                <div class="cf-section cf-services">
                    <div class="cf-pill-selector-container" data-options='[
                            {"label": "Terapia hormonal integral", "value": "1"},
                            {"label": "Consultar mi caso", "value": "2"},
                            {"label": "Casandra CARE", "value": "3"},
                            {"label": "Lorem ipsum", "value": "4"}
                        ]'>
                        <input type="hidden" class="cf-pill-selector-value" name="motivo_consulta" value="" id="motivo_consulta">
                    </div>
                </div>
                <div class="cf-section cf-legal">
                    <div class="cf-checkbox-group">
                        <input type="checkbox" name="cf-terms" id="cf-terms" required>
                        <label for="cf-terms">Acepto la política de privacidad de proteccion de datos</label>
                        <a href="#">[LEER]</a>
                    </div>
                    <div class="cf-checkbox-group">
                        <input type="checkbox" name="cf-newsletter" id="cf-newsletter">
                        <label for="cf-newsletter">Suscribirse a la newsletter</label>
                        <a href="#">[LEER]</a>
                    </div>

                </div>
                <div class="cf-section cf-actions">
                    <div class="cf-action-group">
                        <button type="button" id="cf-date" class="cf-btn-main" data-goto="fc-step-disponibilidad">Ver disponibilidad</button>
                    </div>
                    <div class="cf-action-group" data-toggle-id="motivo_consulta" data-toggle-show-if-value="1">
                        <button type="button" id="cf-call" class="cf-btn-main" data-goto="fc-step-test-1">Test de compatibilidad</button>
                    </div>
                </div>
            </div>

            <!-- Pantalla 2 -->
            <div class="step" id="fc-step-test-1">
                <h3 id="cf-test1-title">2.Situación Actual</h3>
                <div class="cf-step" id="step-situacion">


                    <div class="cf-section">
                        <div class="cf-question-row">
                            <label class="cf-checkbox-modern">
                                <input type="checkbox" name="cf_embarazada" value="si">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">Creo que estoy embarazada</span>
                            </label>
                        </div>

                        <div class="cf-question-row">
                            <label class="cf-checkbox-modern">
                                <input type="checkbox" name="cf_pecho" value="si">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">Estoy dando el pecho</span>
                            </label>
                        </div>

                        <div class="cf-question-row">
                            <label class="cf-checkbox-modern">
                                <input type="checkbox" name="cf_cirugia" id="cf_cirugia" value="1">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">Tengo cirugía ginecológica</span>
                            </label>
                            <div data-toggle-id="cf_cirugia" data-toggle-show-if-value="1">
                                <input type="text" name="cf_cirugia_cual" id="cf_cirugia_input" class="cf-input-sub" placeholder="¿Cuál?">
                            </div>
                        </div>
                    </div>

                    <div class="cf-section">
                        <h4>Última regla:</h4>
                        <div class="cf-question-row">
                            <label class="cf-checkbox-modern">
                                <input type="radio" name="cf_regla" id="cf_regla_trigger">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">Menos de 12 meses</span>
                            </label>
                        </div>

                        <div class="cf-question-row">
                            <label class="cf-checkbox-modern">
                                <input type="radio" name="cf_regla">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">Más de 12 meses</span>
                            </label>
                        </div>

                        <div class="cf-question-row">
                            <label class="cf-checkbox-modern">
                                <input type="radio" name="cf_regla">
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
                    </div><br>

                </div>

                <button type="button" class="cf-btn-main" data-goto="fc-step-inicio">Volver</button>
                <button type="button" class="cf-btn-main" data-goto="fc-step-test-2">Siguiente</button>

            </div>
            <!-- Pantalla 3 -->
            <div class="step" id="fc-step-test-2">
                <h3>3. Salud general</h3>
                <span>¿Fumas?</span>
                <label>
                    <input type="radio" name="cf_tabaco" value="1" />
                    Sí
                </label>
                <label>
                    <input type="radio" name="cf_tabaco" value="0" />
                    No
                </label>
                <div data-toggle-id="cf_tabaco" data-toggle-show-if-value="1">
                    <input type="text" name="cf_tabaco_cantidad" placeholder="Cantidad/duración" value="" />
                </div>

                <label for="cf_peso">Peso (Kg)</label>
                <input type="number" name="cf_peso" id="cf_peso" placeholder="Peso (Kg)" value="" /><br>

                <label for="cf_altura">Altura (com)</label>
                <input type="number" name="cf_altura" id="cf_altura" placeholder="Altura (com)" value="" /><br>
                <br>
                <span>Tu IMC es de: <strong id="cf_imc">-</strong></span>


                <button type="button" class="cf-btn-main" data-goto="fc-step-test-1">Volver</button>
                <button type="button" class="cf-btn-main" data-goto="fc-step-test-3">Siguiente</button>

            </div>
            <!-- Pantalla 4 -->
            <div class="step" id="fc-step-test-3">

                <div class="cf-step" id="step-antecedentes">
                    <p class="cf-fake-h3">4. ANTECEDENTES PERSONALES DE IMPORTANCIA</p>

                    <div class="cf-section">
                        <p class="cf-sub-title">¿Padeces alguna enfermedad?</p>

                        <div class="cf-question-group">
                            <label class="cf-checkbox-modern">
                                <input type="checkbox" name="cf_hipertension" id="cf_hipertension" value="1">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">Hipertensión</span>
                            </label>
                            <div data-toggle-id="cf_hipertension" data-toggle-show-if-value="1">

                                <span class="cf-question-text">¿Estable con medicación?</span>
                                <div class="cf-radio-wrapper">
                                    <label class="cf-checkbox-modern">
                                        <input type="radio" name="cf_hipertension_estable" value="si">
                                        <span class="cf-checkmark cf-radio-mark"></span>
                                        <span class="cf-question-text">Sí</span>
                                    </label>

                                    <label class="cf-checkbox-modern">
                                        <input type="radio" name="cf_hipertension_estable" value="no">
                                        <span class="cf-checkmark cf-radio-mark"></span>
                                        <span class="cf-question-text">No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="cf-question-group">
                            <label class="cf-checkbox-modern">
                                <input type="checkbox" name="cf_diabetes" id="cf_diabetes" value="1">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">Diabetes</span>
                            </label>
                            <div data-toggle-id="cf_diabetes" data-toggle-show-if-value="1">
                                <span class="cf-question-text">¿Estable con medicación?</span>
                                <div class="cf-radio-wrapper">
                                    <label class="cf-checkbox-modern">
                                        <input type="radio" name="cf_diabetes_estable" value="si">
                                        <span class="cf-checkmark cf-radio-mark"></span>
                                        <span class="cf-question-text">Sí</span>
                                    </label>

                                    <label class="cf-checkbox-modern">
                                        <input type="radio" name="cf_diabetes_estable" value="no">
                                        <span class="cf-checkmark cf-radio-mark"></span>
                                        <span class="cf-question-text">No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="cf-question-group">
                            <label class="cf-checkbox-modern">
                                <input type="checkbox" name="cf_coagulacion" id="cf_coagulacion" value="1">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">Alteración de la coagulación diagnosticada</span>
                            </label>
                            <div data-toggle-id="cf_coagulacion" data-toggle-show-if-value="1">
                                <input type="text" name="cf_coagulacion_cual" id="cf_coagulacion_input" class="cf-input-sub" placeholder="¿Cuál?">
                            </div>
                        </div>
                    </div>

                    <div class="cf-section">
                        <p class="cf-sub-title">¿Tienes o has tenido alguna vez?</p>

                        <label class="cf-checkbox-modern">
                            <input type="checkbox" name="cf_migrana">
                            <span class="cf-checkmark"></span>
                            <span class="cf-question-text">Migraña con aura</span>
                        </label>
                        <br>
                        <label class="cf-checkbox-modern">
                            <input type="checkbox" name="cf_hepatica">
                            <span class="cf-checkmark"></span>
                            <span class="cf-question-text">Enfermedad hepática grave</span>
                        </label>
                        <br>
                        <label class="cf-checkbox-modern">
                            <input type="checkbox" name="cf_sangrado">
                            <span class="cf-checkmark"></span>
                            <span class="cf-question-text">Sangrado vaginal sin diagnóstico</span>
                        </label>
                        <br>
                        <label class="cf-checkbox-modern">
                            <input type="checkbox" name="cf_endometriosis">
                            <span class="cf-checkmark"></span>
                            <span class="cf-question-text">Endometriosis</span>
                        </label>
                        <br>
                        <div class="cf-question-group">
                            <label class="cf-checkbox-modern">
                                <input type="checkbox" name="cf_cancer_mama" id="cf_cancer_mama" value="1">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">Cáncer de mama</span>
                            </label>
                            <div data-toggle-id="cf_cancer_mama" data-toggle-show-if-value="1">
                                
                                    <span class="cf-question-text">¿Con receptores positivos?</span>
                                     <div class="cf-radio-wrapper">
                                    <label class="cf-checkbox-modern">
                                        <input type="radio" name="cf_diabetes_estable" value="si">
                                        <span class="cf-checkmark cf-radio-mark"></span>
                                        <span class="cf-question-text">Sí</span>
                                    </label>

                                    <label class="cf-checkbox-modern">
                                        <input type="radio" name="cf_diabetes_estable" value="no">
                                        <span class="cf-checkmark cf-radio-mark"></span>
                                        <span class="cf-question-text">No</span>
                                    </label>
                                </div>
                                
                            </div>
                        </div>

                        <label class="cf-checkbox-modern">
                            <input type="checkbox" name="cf_cancer_gine">
                            <span class="cf-checkmark"></span>
                            <span class="cf-question-text">Cáncer ginecológico (útero, endometrio u ovario)</span>
                        </label>
                        <br>
                        <label class="cf-checkbox-modern">
                            <input type="checkbox" name="cf_cancer_activo">
                            <span class="cf-checkmark"></span>
                            <span class="cf-question-text">Cáncer activo actualmente</span>
                        </label>
                        <br>
                        <label class="cf-checkbox-modern">
                            <input type="checkbox" name="cf_trombosis">
                            <span class="cf-checkmark"></span>
                            <span class="cf-question-text">Trombosis venosa o embolia pulmonar</span>
                        </label>
                        <br>
                        <label class="cf-checkbox-modern">
                            <input type="checkbox" name="cf_ictus">
                            <span class="cf-checkmark"></span>
                            <span class="cf-question-text">Infarto o ictus</span>
                        </label>
                    </div>
                    <br>

                </div>
                <button type="button" class="cf-btn-main" data-goto="fc-step-test-2">Volver</button>
                <button type="button" class="cf-btn-main" data-goto="fc-step-test-4">Siguiente</button>

            </div>
            <!-- Pantalla 5 -->
            <div class="step" id="fc-step-test-4">
                <h3>5. ¿Cuáles serían tus objetivos con nosotros?</h3>
                <label>
                    <input type="radio" name="cf_objetivos" value="1">
                    Objetivo 1
                </label>
                <label>
                    <input type="radio" name="cf_objetivos" value="2">
                    Objetivo 2
                </label>
                <label>
                    <input type="radio" name="cf_objetivos" value="3">
                    Objetivo 3
                </label>
                <label>
                    <input type="radio" name="cf_objetivos" value="4">
                    Objetivo 4
                </label>
                <label>
                    <input type="radio" name="cf_objetivos" value="5">
                    Objetivo 5
                </label>

                <button type="button" class="cf-btn-main" data-goto="fc-step-test-3">Volver</button>
                <button type="button" class="cf-btn-main" data-goto="fc-step-test-5">Siguiente</button>
            </div>
            <!-- Pantalla 6 -->
            <div class="step" id="fc-step-test-5">
                <h3>6. Confirmación</h3>
                <label>
                    <input type="checkbox" name="cf_confimo_info" value="1" required>
                    Confirmo que la información es correcta y entiendo que este cuestionario no sustituye la valoración médica.
                </label>
                <button type="button" class="cf-btn-main" data-goto="fc-step-test-4">Volver</button>
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
    wp_enqueue_script(
        'cf-toggle',
        plugin_dir_url(__FILE__) . 'assets/js/toggle.js',
        array(), // Dependencias (ninguna por ahora)
        '1.0',
        true     // Cargar en el footer para que no ralentice la web
    );
    wp_enqueue_script(
        'cf-imc-calculator',
        plugin_dir_url(__FILE__) . 'assets/js/imc-calculator.js',
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