/*Action to call all classes to active the section modal*/
if (document.getElementById('evaluation-scale-button')) {
    const evaluationScaleButton = document.getElementById('evaluation-scale-button')
    const FullScreenEvaluationScaleModalClose = document.getElementById('full-screen-evaluation-scale-modal-close');
    const addEvaluationScaleModal = document.getElementById('add-evaluation-scale-modal');
    const evaluationScaleModalCloseButton = document.getElementById('evaluation-scale-modal-close');
    const inputAnswers = document.getElementsByTagName('input');
    const inputMandatoryEvaluationScale = document.getElementById('evaluation-scale-checkbox-mandatory');
    const evaluationScaleDraggableHandle = document.getElementById('evaluation-scale-draggable-handle');
    const addEvaluationScaleName = document.getElementById('evaluation-scale-name');
    const body = document.getElementById('body');
    const draggable = require('draggable');
    const draggableOptions = {handle: evaluationScaleDraggableHandle}

    //function used to open evaluation scale creation modal
    evaluationScaleButton.addEventListener('click', () => {
        FullScreenEvaluationScaleModalClose.classList.add('full-screen-evaluation-scale-modal-display');
        body.classList.add('hide-body-overflow-evaluation-scale');
        addEvaluationScaleName.setAttribute('name','name');
        new draggable(addEvaluationScaleModal, draggableOptions);
        // Function used to close the modal when click outside of the modal
        window.onclick = function(event) {
            if (event.target == FullScreenEvaluationScaleModalClose) {
                FullScreenEvaluationScaleModalClose.classList.remove('full-screen-evaluation-scale-modal-display');
                body.classList.remove('hide-body-overflow-evaluation-scale');
                addEvaluationScaleName.setAttribute('name','');
            }
        };
    });

    // Function used to close the modal when click on close button and initialise values
    evaluationScaleModalCloseButton.addEventListener('click', () => {
        for (const inputAnswer of inputAnswers) {
            inputAnswer.value = '';
        }
        FullScreenEvaluationScaleModalClose.classList.remove('full-screen-evaluation-scale-modal-display');
        body.classList.remove('hide-body-overflow-evaluation-scale');
        addEvaluationScaleName.setAttribute('name','');
        inputMandatoryEvaluationScale.checked = false;
    });  
}