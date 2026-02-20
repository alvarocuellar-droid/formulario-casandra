<?php
/*
Plugin Name: casandraformulario
Description: Un formulario de contacto básico creado manualmente.
Version: 1.0
Author: Alvaro Cuellar
*/


/**
 * Función para generar el formulario
 * @return false|string
 */
function casandraformulario_shortcode()
{
    ob_start();
    $imgUrl = plugin_dir_url(__FILE__) . 'assets/img/';
?>
    <div class="contenedor-formulario">
        <form class="multi-step-form" action="javascript:" method="POST" id="cf-form">

            <div class="step active visible" id="fc-step-inicio">
                <h2 class="cf-form-title">PIDE CITA</h2>
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
                        <button type="button" id="cf-btn-disponibilidad" class="cf-btn-main btn-validate" data-goto="fc-step-disponibilidad">Ver disponibilidad</button>
                    </div>
                    <div class="cf-action-group" data-toggle-id="motivo_consulta" data-toggle-show-if-value="1">
                        <button type="button" id="cf-btn-test" class="cf-btn-main btn-validate" data-goto="fc-step-test-1">Test de compatibilidad</button>
                    </div>
                </div>
            </div>

            <!-- Pantalla 2 -->
            <div class="step" id="fc-step-test-1">
                <h3 class="cf-form-subtitle">2. Situación Actual</h3>
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

                <button type="button" class="cf-btn-main" data-goto="fc-step-inicio">Anterior</button>
                <button type="button" class="cf-btn-main btn-validate" data-goto="fc-step-test-2">Siguiente</button>

            </div>
            <!-- Pantalla 3 -->
            <div class="step" id="fc-step-test-2">
                <h3 class="cf-form-subtitle">3. Salud general</h3>
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
                    <input class="cf-input-sub" type="text" name="cf_tabaco_cantidad" placeholder="Cantidad/duración" value="">
                </div>
                <br>
                <label for="cf_peso">Peso (Kg)</label>
                <input type="number" name="cf_peso" id="cf_peso" placeholder="Peso (Kg)" min="20" max="300" value="" required><br>

                <label for="cf_altura">Altura (cm)</label>
                <input type="number" name="cf_altura" id="cf_altura" placeholder="Altura (cm)" min="100" max="250" value="" required><br>
                <br>
                <span>Tu IMC es de: <strong id="cf_imc">-</strong></span>
                <br>
                <br>


                <button type="button" class="cf-btn-main" data-goto="fc-step-test-1">Anterior</button>
                <button type="button" class="cf-btn-main btn-validate" data-goto="fc-step-test-3">Siguiente</button>

            </div>
            <!-- Pantalla 4 -->
            <div class="step" id="fc-step-test-3">

                <div class="cf-step" id="step-antecedentes">
                    <h3 class="cf-form-subtitle">4. Antecedentes personales de importancia</h3>

                    <div class="cf-section">
                        <p class="cf-sub-title">¿Padeces alguna enfermedad?</p>

                        <div class="cf-question-group">
                            <label class="cf-checkbox-modern">
                                <input type="checkbox" name="cf_hipertension" id="cf_hipertension" value="1">
                                <span class="cf-checkmark"></span>
                                <span class="cf-question-text">Hipertensión</span>
                            </label>
                            <div class="cf-toggle" data-toggle-id="cf_hipertension" data-toggle-show-if-value="1">

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
                            <div class="cf-toggle" data-toggle-id="cf_diabetes" data-toggle-show-if-value="1">
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
                            <div class="cf-toggle" data-toggle-id="cf_cancer_mama" data-toggle-show-if-value="1">

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
                <button type="button" class="cf-btn-main" data-goto="fc-step-test-2">Anterior</button>
                <button type="button" class="cf-btn-main btn-validate" data-goto="fc-step-test-4">Siguiente</button>

            </div>
            <!-- Pantalla 5 -->
            <div class="step" id="fc-step-test-4">
                <h3 class="cf-form-subtitle">5. ¿Cuáles serían tus objetivos con nosotros?</h3>
                <label>
                    <textarea class="cf-input-sub" name="cf_objetivos" placeholder="Objetivo 1"></textarea>
                </label>
                <label>
                    <textarea class="cf-input-sub" name="cf_objetivos" placeholder="Objetivo 2"></textarea>
                </label>
                <label>
                    <textarea class="cf-input-sub" name="cf_objetivos" placeholder="Objetivo 3"></textarea>
                </label>
                <label>
                    <textarea class="cf-input-sub" name="cf_objetivos" placeholder="Objetivo 4"></textarea>
                </label>
                <label>
                    <textarea class="cf-input-sub" name="cf_objetivos" placeholder="Objetivo 5"></textarea>
                </label>


                <button type="button" class="cf-btn-main" data-goto="fc-step-test-3">Anterior</button>
                <button type="button" class="cf-btn-main btn-validate" data-goto="fc-step-test-5">Siguiente</button>
            </div>
            <!-- Pantalla 6 -->
            <div class="step" id="fc-step-test-5">
                <h3 class="cf-form-subtitle">6. Confirmación</h3>
                <div class="cf-step5-label">
                    <label>
                        <input type="checkbox" name="cf_confimo_info" value="1" required>
                        Confirmo que la información es correcta y entiendo que este cuestionario no sustituye la valoración médica.
                    </label>
                </div>
                <button type="button" class="cf-btn-main" data-goto="fc-step-test-4">Anterior</button>
                <button type="button" class="cf-btn-main btn-validate" data-goto="fc-step-test-6">Terminar</button>
            </div>

            <!-- Pantalla 7 -->
            <div class="step" id="fc-step-test-6">
                <div class="cf-msg">
                    <img class="cf-img-check" src="<?= $imgUrl ?>check.svg" alt="Check">
                    <p>Has realizado exitosamente el test de compatibilidad. Según tus respuestas podrían ser candidata para realizar un tratamiento de restitución hormonal.</p>

                </div>
                <div class="cf-actions-final">
                    <button type="button" class="cf-btn-main">Quiero que me llamen</button>
                    <button type="button" class="cf-btn-main btn-validate" data-goto="fc-step-disponibilidad">Agendar una cita</button>

                </div>
            </div>
            <!-- Apartado de disponibilidad con las fechas y horas disponibles -->
            <div class="step cf-pill-selector-group" id="fc-step-disponibilidad">
                <h2 class="cf-form-title">PIDE CITA</h2>

                <div class="cf-slot">
                    <h3 class="cf-slot__titulo">Lunes, 16 de febrero</h3>
                    <div class="cf-slot__horas">
                        <div class="cf-pill-selector-container" data-options='[
                            {"label": "10:00", "value": "2026-02-16 10:00"},
                            {"label": "11:00", "value": "2026-02-16 11:00"},
                            {"label": "12:00", "value": "2026-02-16 12:00"},
                            {"label": "13:00", "value": "2026-02-16 13:00"},
                            {"label": "14:00", "value": "2026-02-16 14:00"},
                            {"label": "15:00", "value": "2026-02-16 15:00"},
                            {"label": "16:00", "value": "2026-02-16 16:00"},
                            {"label": "17:00", "value": "2026-02-16 17:00"},
                            {"label": "18:00", "value": "2026-02-16 18:00"}
                        ]'>
                            <input type="hidden" class="cf-pill-selector-value" name="slot">
                        </div>
                    </div>
                </div>
                <div class="cf-slot">
                    <h3 class="cf-slot__titulo">Martes, 17 de febrero</h3>
                    <div class="cf-slot__horas">
                        <div class="cf-pill-selector-container" data-options='[
                            {"label": "10:00", "value": "2026-02-17 10:00"},
                            {"label": "11:00", "value": "2026-02-17 11:00"},
                            {"label": "12:00", "value": "2026-02-17 12:00"},
                            {"label": "13:00", "value": "2026-02-17 13:00"},
                            {"label": "14:00", "value": "2026-02-17 14:00"},
                            {"label": "15:00", "value": "2026-02-17 15:00"},
                            {"label": "16:00", "value": "2026-02-17 16:00"},
                            {"label": "17:00", "value": "2026-02-17 17:00"},
                            {"label": "18:00", "value": "2026-02-17 18:00"}
                        ]'>
                            <input type="hidden" class="cf-pill-selector-value" name="slot">
                        </div>
                    </div>
                </div>

                <label>
                    <input type="checkbox" name="cf_is_trh">
                    Tratamiento restitución hormonal
                </label>
                <br>
                <div class="cf-btn-btn-final">
                    <button class="cf-btn-cita">Confirmar cita</button>
                    <button class="cf-btn-call" type="button">Solicitar llamada</button>
                    <button class="cf-btn-date" type="button">Elegir otro día</button>
                </div>
            </div>

        </form>
    </div>

<?php
    return ob_get_clean();
}


/**
 * Función para cargar los estilos CSS
 * @return void
 */
function casandra_cargar_estilos()
{
    $assetsUrl = plugin_dir_url(__FILE__) . 'assets/';
    wp_enqueue_style('casandraformulario-style', $assetsUrl . 'css/style.css');

    wp_enqueue_script('cf-validate', $assetsUrl . 'js/validate.js', [], '1.0', true);
    wp_enqueue_script('cf-pills', $assetsUrl . 'js/pills.js', [], '1.0', true);
    wp_enqueue_script('cf-steps', $assetsUrl . 'js/steps.js', [], '1.0', true);
    wp_enqueue_script('cf-toggle', $assetsUrl . 'js/toggle.js', [], '1.0', true);
    wp_enqueue_script('cf-imc-calculator', $assetsUrl . 'js/imc-calculator.js', [], '1.0', true);
}


/**
 * Función para procesar el formulario cuando se envía
 * @return void
 */
function casandra_procesar_formulario()
{
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