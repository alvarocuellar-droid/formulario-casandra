// Pills
class PillSelector {
    constructor(container) {
        this.container = container;
        this.options = JSON.parse(container.dataset.options);
        this.hiddenInput = container.querySelector('.cf-pill-selector-value');
        this.selectedOption = null;
        this.render();
    }

    render() {
        const selectorDiv = document.createElement('div');
        selectorDiv.className = 'cf-pill-selector';

        this.options.forEach(option => {
            const pill = document.createElement('button');
            pill.className = 'cf-pill';
            pill.textContent = option.label;
            pill.dataset.value = option.value;

            pill.addEventListener('click', () => {
                if (this.selectedOption !== option.value) {
                    this.selectedOption = option.value;
                    this.hiddenInput.value = this.selectedOption;
                    this.updateSelection();
                    console.log('Opción seleccionada:', this.selectedOption);
                }
            });

            selectorDiv.appendChild(pill);
        });

        this.container.insertBefore(selectorDiv, this.hiddenInput);
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

// Inicializa todos los selectores en la página
document.querySelectorAll('.cf-pill-selector-container').forEach(container => {
    new PillSelector(container);
});