// Función para interceptar setters de propiedades específicas (value o checked)
const setupPropertyInterceptor = (element, propName, eventName) => {
    // Obtenemos el descriptor del prototipo (HTMLInputElement)
    let descriptor = Object.getOwnPropertyDescriptor(HTMLInputElement.prototype, propName);

    Object.defineProperty(element, propName, {
        get: function() {
            return descriptor.get.call(this);
        },
        set: function(val) {
            descriptor.set.call(this, val);
            // Disparar evento personalizado cuando la propiedad cambia vía JS
            this.dispatchEvent(new Event(eventName, { bubbles: true }));
        },
        configurable: true
    });
};

const setupToggleDivs = () => {
    const divs = document.querySelectorAll('[data-toggle-id]');

    divs.forEach(div => {
        const identifier = div.dataset.toggleId; // Puede ser ID o Name
        const targetValue = div.dataset.toggleShowIfValue;

        // Intentamos obtener por ID primero (retrocompatibilidad)
        let inputs = document.getElementById(identifier) ? [document.getElementById(identifier)] : [];

        // Si no hay resultados por ID, buscamos por atributo name (para radios)
        if (inputs.length === 0) {
            inputs = Array.from(document.querySelectorAll(`input[name="${identifier}"]`));
        }

        if (inputs.length === 0) return;

        const customEvent = 'jschange';

        const toggleVisibility = () => {
            let isVisible = false;

            // Evaluamos el estado basado en el tipo de los inputs encontrados
            inputs.forEach(input => {
                if (input.type === 'checkbox' || input.type === 'radio') {
                    // Si está marcado y su valor coincide con el objetivo
                    if (input.checked && input.value === targetValue) {
                        isVisible = true;
                    }
                } else {
                    // Para text, select, etc.
                    if (input.value === targetValue) {
                        isVisible = true;
                    }
                }
            });

            if (isVisible) {
                div.classList.remove('cf-hidden');
            } else {
                div.classList.add('cf-hidden');
            }
        };

        // Configuramos cada input del grupo (o el input único)
        inputs.forEach(input => {
            const isCheckable = input.type === 'checkbox' || input.type === 'radio';
            const propToIntercept = isCheckable ? 'checked' : 'value';

            setupPropertyInterceptor(input, propToIntercept, customEvent);

            const events = ['input', 'change', customEvent];
            events.forEach(evt => input.addEventListener(evt, toggleVisibility));
        });

        // Ejecución inicial
        toggleVisibility();
    });
};

document.addEventListener('DOMContentLoaded', setupToggleDivs);