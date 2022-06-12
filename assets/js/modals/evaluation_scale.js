if (document.getElementById('evaluation-scale-button')) {
    
    const evaluationScaleButton = document.getElementById('evaluation-scale-button')
    const evaluationScaleModal = document.getElementById('evaluation-scale-creation-modal');

    //function used to open evaluation scale creation modal
    evaluationScaleButton.addEventListener('click', () => {
        evaluationScaleModal.classList.add('evaluation-scale-creation-modal-display');
    })

}