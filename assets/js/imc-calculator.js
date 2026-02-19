class CalculadoraIMC {
    constructor(idPeso, idAltura, idIMC) {
        this.pesoInput = document.querySelector(idPeso);
        this.alturaInput = document.querySelector(idAltura);
        this.imcInput = document.querySelector(idIMC);

        // Asignar eventos para calcular automáticamente
        this.pesoInput.addEventListener('input', () => this.calcularIMC());
        this.alturaInput.addEventListener('input', () => this.calcularIMC());
    }

    calcularIMC() {
        const peso = parseFloat(this.pesoInput.value);
        let altura = parseFloat(this.alturaInput.value);
        altura /= 100;

        if (!isNaN(peso) && !isNaN(altura) && altura > 0) {
            const imc = peso / (altura * altura);
            this.imcInput.innerHTML = imc.toFixed(2).replace('.', ',');

            // Opcional: Devolver el nivel de IMC como objeto
            return this.obtenerNivelIMC(imc);
        } else {
            this.imcInput.innerHTML = "-";
            return null;
        }
    }

    obtenerNivelIMC(imc) {
        if (imc < 18.5) {
            return { imc, nivel: "Bajo peso" };
        } else if (imc >= 18.5 && imc < 25) {
            return { imc, nivel: "Peso normal" };
        } else if (imc >= 25 && imc < 30) {
            return { imc, nivel: "Sobrepeso" };
        } else {
            return { imc, nivel: "Obesidad" };
        }
    }
}

new CalculadoraIMC('#cf_peso', '#cf_altura', '#cf_imc');
