
if (document.getElementById('evaluation-scale-button')) {
    
    const evaluationScaleButton = document.getElementById('evaluation-scale-button')
    const evaluationScaleModal = document.getElementById('evaluation-scale-creation-modal');
    const evaluationScaleCreateButton = document.getElementById('evaluation-scale-modal-button');
    const formBuilder = document.getElementById('display_form_builder');
    let idComponent = 0;

    //function used to open evaluation scale creation modal
    evaluationScaleButton.addEventListener('click', () => {
        evaluationScaleModal.classList.add('evaluation-scale-creation-modal-display');
    });
    /*
    //function used to create multiples template componants with different id's
    evaluationScaleCreateButton.addEventListener('click', () => {
        const evaluationScaleModalQuestion = document.getElementById('evaluation-scale-question-input').value;
        const evaluationScaleModalLowLabel = document.getElementById('evaluation-scale-low-level-input').value;
        const evaluationScaleModalHighLabel = document.getElementById('evaluation-scale-high-level-input').value;
        const evaluationScaleModalMandatory = document.getElementById('evaluation-scale-checkbox-mandatory').checked;    
        const evaluationScaleComponent = document.getElementById('evaluation-scale-template-creation');
        const cloneComponent = evaluationScaleComponent.cloneNode(true);
        const idElements = [...cloneComponent.querySelectorAll('[id]')];
        if (cloneComponent.matches('[id]')) {
            idElements.push(cloneComponent);
        }
        idElements.forEach((e) => {
            e.id += '-' + idComponent;
        })
        cloneComponent.querySelector('.evaluation-scale-template-question').innerHTML = `${evaluationScaleModalQuestion}`;
        cloneComponent.querySelector('.evaluation-scale-template-low-label').innerHTML = `${evaluationScaleModalLowLabel}`;
        cloneComponent.querySelector('.evaluation-scale-template-high-label').innerHTML = `${evaluationScaleModalHighLabel}`;
        if (evaluationScaleModalMandatory === true) {
            cloneComponent.querySelector('.evaluation-scale-template-question').innerHTML = `${evaluationScaleModalQuestion}<span class="evaluation-scale-red-star" id="evaluation-scale-red-star">*</span>`;
        }
        cloneComponent.classList.add('evaluation-scale-template-display');
        formBuilder.appendChild(cloneComponent);
        evaluationScaleModal.classList.remove('evaluation-scale-creation-modal-display');
        document.getElementById('evaluation-scale-question-input').value = "";
        document.getElementById('evaluation-scale-low-level-input').value = "";
        document.getElementById('evaluation-scale-high-level-input').value = "";
        document.getElementById('evaluation-scale-checkbox-mandatory').checked = false;
        idComponent++;
    })*/
}