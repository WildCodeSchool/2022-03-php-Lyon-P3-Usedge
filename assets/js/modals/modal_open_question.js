
if (document.getElementById('open-question-button')) {

    const button = document.getElementById('open-question-button');
    const openQuestionButton = document.getElementById('open-question-button');
    const openQuestionCreationModal = document.getElementById('open-question-creation-modal');
    const addFullScreenContainerModalCloseOpenQuestion= document.getElementById('full-screen-container-modal-close-open-question');
    const openQuestionModalCloseButton = document.getElementById('open-question-modal-close');
    const openQuestionDraggableHandle = document.getElementById('open-question-draggable-handle');
    const inputMandatoryOpenQuestion = document.getElementById('open-question-modal-mandatory');
    const allInputOpenQuestions = document.getElementsByClassName('open-question-input');
    const checkboxHelpertext = document.getElementById('checkbox-helper-text-open-question');
    const body = document.getElementById('body');
    const draggable = require('draggable');
    const draggableOptions = {handle: openQuestionDraggableHandle}

    // Function used to open the modal
    openQuestionButton.addEventListener('click', () => {
        openQuestionCreationModal.classList.add('add-single-choice-modal-display');
        addFullScreenContainerModalCloseOpenQuestion.classList.add('full-screen-open-question-container-modal-close-display');
        body.classList.add('hide-body-overflow');
        new draggable(openQuestionCreationModal, draggableOptions);

        // Function used to close the modal when click outside the modal
        window.onclick = function(event) {
            if (event.target ==  addFullScreenContainerModalCloseOpenQuestion) { 
                addFullScreenContainerModalCloseOpenQuestion.classList.remove('full-screen-open-question-container-modal-close-display');
                body.classList.remove('hide-body-overflow');
            }
        };
    });


    // Function used to close the modal when click on close button and initialise values
    openQuestionModalCloseButton.addEventListener('click', () => {
        openQuestionCreationModal.value = '';
        for (const allInputOpenQuestion of allInputOpenQuestions) {
            allInputOpenQuestion.value = '';
        }
        addFullScreenContainerModalCloseOpenQuestion.classList.remove('full-screen-open-question-container-modal-close-display');
        body.classList.remove('hide-body-overflow-open-question');
        inputMandatoryOpenQuestion.checked = false;
        checkboxHelpertext.checked = false ;
    }); 
}