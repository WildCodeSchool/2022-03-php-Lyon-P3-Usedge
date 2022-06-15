
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
}
