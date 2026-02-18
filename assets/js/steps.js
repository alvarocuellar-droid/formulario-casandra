document.addEventListener("DOMContentLoaded", () => {
    const formAll = document.querySelectorAll('.multi-step-form');

    formAll.forEach(form => {
        // --- CONFIGURACIÓN AUTOMÁTICA ---
        // Buscamos cuál es el paso inicial que has puesto en el HTML
        const firstStep = form.querySelector(".step.active");
        let history = firstStep ? [firstStep.id] : [];

        function goToStep(targetId, isBack = false) {
            const currentStepId = history[history.length - 1];
            const currentStep = document.getElementById(currentStepId);
            const nextStep = document.getElementById(targetId);

            if (!nextStep || currentStep === nextStep) return;

            currentStep.classList.remove("visible");

            setTimeout(() => {
                currentStep.classList.remove("active");
                nextStep.classList.add("active");

                if (!isBack) history.push(targetId);

                setTimeout(() => {
                    nextStep.classList.add("visible");
                }, 50);
            }, 400);
        }

        // Delegación de eventos para clics
        form.addEventListener("click", (e) => {
            const btn = e.target.closest("[data-goto]");
            if (btn) {
                goToStep(btn.dataset.goto);
            }
        });

        // Caso 3: Cambios en Radios
        form.addEventListener("change", (e) => {
            if (e.target.dataset.goto) {
                goToStep(e.target.dataset.goto);
            }
        });

        // Bloquear submit accidental con Enter
        form.addEventListener("keydown", (e) => {
            if (e.key === "Enter" && e.target.tagName !== "TEXTAREA") e.preventDefault();
        });
    });
});