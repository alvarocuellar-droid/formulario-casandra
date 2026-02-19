// Función para sobrescribir el setter de 'value' en un input
const setupInputValueInterceptor = (input) => {
    let originalValueDescriptor = Object.getOwnPropertyDescriptor(HTMLInputElement.prototype, 'value');

    Object.defineProperty(input, 'value', {
        get: function() {
            return originalValueDescriptor.get.call(this);
        },
        set: function(val) {
            originalValueDescriptor.set.call(this, val);
            // Disparar un evento personalizado
            this.dispatchEvent(new Event('jschange', { bubbles: true }));
        }
    });
};

// Modificar setupToggleDivs para escuchar también el evento 'jschange'
const setupToggleDivs = () => {
    const divs = document.querySelectorAll('[data-toggle-id]');

    divs.forEach(div => {
        const inputId = div.dataset.toggleId;
        const targetValue = div.dataset.toggleShowIfValue;
        const input = document.getElementById(inputId);

        if (!input) return;

        // Interceptar cambios en 'value' vía JS
        setupInputValueInterceptor(input);

        const toggleVisibility = () => {
            if (input.value == targetValue) {
                div.classList.remove('cf-hidden');
            } else {
                div.classList.add('cf-hidden');
            }
        };

        // Escuchar eventos: 'input', 'change' y 'jschange'
        input.addEventListener('input', toggleVisibility);
        input.addEventListener('change', toggleVisibility);
        input.addEventListener('jschange', toggleVisibility);

        toggleVisibility();
    });
};

document.addEventListener('DOMContentLoaded', setupToggleDivs);
