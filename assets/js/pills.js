class PillSelector {
    constructor(container) {
        this.container = container;
        // Guardamos la instancia en el elemento DOM para que otros puedan acceder a ella
        this.container.pillSelectorInstance = this;

        this.options = JSON.parse(container.dataset.options);
        this.hiddenInput = container.querySelector('.cf-pill-selector-value');
        this.selectedOption = null;
        this.group = container.closest('.cf-pill-selector-group');

        this.render();
    }

    render() {
        const selectorDiv = document.createElement('div');
        selectorDiv.className = 'cf-pill-selector';

        this.options.forEach(option => {
            const pill = document.createElement('button');
            pill.type = 'button';
            pill.className = 'cf-pill';
            pill.textContent = option.label;
            pill.dataset.value = option.value;

            for (const key in option) {
                if (key.startsWith('data-')) {
                    const datasetKey = key.replace('data-', '');
                    pill.dataset[datasetKey] = option[key];
                }
            }

            pill.addEventListener('click', () => {
                this.handleSelection(option.value);
            });

            selectorDiv.appendChild(pill);
        });

        this.container.insertBefore(selectorDiv, this.hiddenInput);
    }

    handleSelection(value) {
        // Ahora comprobamos el valor real del input además de la memoria interna
        if (this.selectedOption === value && this.hiddenInput.value === value) return;

        if (this.group) {
            this.clearGroupSelection();
        }

        this.selectedOption = value;
        this.hiddenInput.value = value;
        this.updateSelection();
    }

    // Resetea esta instancia específica
    reset() {
        this.selectedOption = null;
        this.hiddenInput.value = '';
        this.updateSelection();
    }

    clearGroupSelection() {
        const siblingContainers = this.group.querySelectorAll('.cf-pill-selector-container');

        siblingContainers.forEach(container => {
            // Accedemos a la instancia de la clase a través del elemento DOM
            const instance = container.pillSelectorInstance;

            // Si existe la instancia y no es la actual, la reseteamos por completo
            if (instance && instance !== this) {
                instance.reset();
            }
        });
    }

    updateSelection() {
        const pills = this.container.querySelectorAll('.cf-pill');
        pills.forEach(pill => {
            pill.classList.remove('selected');
            if (pill.dataset.value === this.selectedOption) {
                pill.classList.add('selected');
            }
        });
    }
}

// Inicialización
document.querySelectorAll('.cf-pill-selector-container').forEach(container => {
    new PillSelector(container);
});