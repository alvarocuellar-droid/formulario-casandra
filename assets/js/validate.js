document.addEventListener('DOMContentLoaded', () => {
    // Seleccionamos todos los botones que deben disparar la validación
    const validationButtons = document.querySelectorAll('.btn-validate');

    validationButtons.forEach(btn => {
        // IMPORTANTE: Este listener debe registrarse antes que los de "siguiente paso"
        btn.addEventListener('click', (e) => {
            // 1. Encontrar el contenedor .step más cercano al botón
            const currentStep = btn.closest('.step');

            if (!currentStep) return;

            // 2. Obtener todos los campos que requieren validación dentro de este paso
            // (Inputs, selectores y textareas que no estén deshabilitados)
            const inputs = Array.from(currentStep.querySelectorAll('input, select, textarea'))
                .filter(input => !input.disabled);

            // 3. Validar. reportValidity() devuelve false si algún campo falla.
            // Usamos .every para comprobar todos, pero reportValidity activará el error en el primero que encuentre.
            const isStepValid = inputs.every(input => input.reportValidity());

            if (!isStepValid) {
                // 4. EL TRUCO: Detenemos cualquier otro evento click programado en este mismo botón
                e.preventDefault();
                e.stopImmediatePropagation();

                console.warn("Validación fallida: Se ha detenido la navegación al siguiente paso.");
            }
        }, { capture: true });
        // Usamos 'capture: true' para asegurarnos de interceptar el evento lo antes posible
    });
});