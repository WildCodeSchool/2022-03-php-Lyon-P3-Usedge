if (document.getElementById('button-add-section')) {
    const buttonAddSection = document.getElementById('button-add-section');
    const sectionForm = document.getElementById('section-form');
    const planSection = document.getElementById('plan-section');

    buttonAddSection.addEventListener('click', () => {

        const PlanSectionClone = planSection.cloneNode(true);
        sectionForm.appendChild(PlanSectionClone);
    });
}