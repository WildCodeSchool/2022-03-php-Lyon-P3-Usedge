if (document.getElementById('button-add-section')) {
    const buttonAddSection = document.getElementById('button-add-section');
    const planSection = document.getElementById('plan-section');
    const planSectionContainer = document.getElementById('plan-section-container');

    buttonAddSection.addEventListener('click', () => {

        const PlanSectionClone = planSection.cloneNode(true);
        planSectionContainer.appendChild(PlanSectionClone);
    });
}