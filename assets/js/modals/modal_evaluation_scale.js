
if (document.getElementById('evaluation-scale-button')) {
    
    const evaluationScaleButton = document.getElementById('evaluation-scale-button')
    const evaluationScaleModal = document.getElementById('evaluation-scale-creation-modal');
    const evaluationScaleCreateButton = document.getElementById('evaluation-scale-modal-button');
    //const formBuilder = document.getElementById('display_form_builder');
    const evaluationScaleDraggableHandle = document.getElementById('evaluation-scale-draggable-handle');
    const body = document.getElementById('body');
    const draggable = require('draggable');
    const draggableOptions = {handle: evaluationScaleDraggableHandle}

    //function used to open evaluation scale creation modal
    evaluationScaleButton.addEventListener('click', () => {
        evaluationScaleModal.classList.add('evaluation-scale-creation-modal-display');
        new draggable(evaluationScaleModal, draggableOptions);
    });
}
