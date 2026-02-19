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
        const inputId = div.dataset.toggleId;
        const targetValue = div.dataset.toggleShowIfValue;
        const input = document.getElementById(inputId);

        if (!input) return;

        const isCheckbox = input.type === 'checkbox';
        const customEvent = 'jschange';

        // Interceptamos la propiedad adecuada según el tipo de input
        if (isCheckbox) {
            setupPropertyInterceptor(input, 'checked', customEvent);
        } else {
            setupPropertyInterceptor(input, 'value', customEvent);
        }

        const toggleVisibility = () => {
            // Lógica de comparación:
            // Si es checkbox, comparamos si 'checked' coincide con el string 'true'/'false'
            // o simplemente si está marcado (si no se definió un valor específico).
            const currentValue = isCheckbox ? (input.checked ? input.value : '') : input.value;

            if (currentValue === targetValue) {
                div.classList.remove('cf-hidden');
            } else {
                div.classList.add('cf-hidden');
            }
        };

        // Eventos estándar + nuestro evento personalizado
        const events = ['input', 'change', customEvent];
        events.forEach(evt => input.addEventListener(evt, toggleVisibility));

        // Ejecución inicial
        toggleVisibility();
    });
};

document.addEventListener('DOMContentLoaded', setupToggleDivs);