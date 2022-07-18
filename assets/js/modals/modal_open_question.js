
if (document.getElementById('open-question-button')) {

    const button = document.getElementById('open-question-button');
    const openQuestionButton = document.getElementById('open-question-button');
    const openQuestionCreationModal = document.getElementById('open-question-creation-modal');
    const addFullScreenContainerModalCloseOpenQuestion= document.getElementById('full-screen-container-modal-close-open-question');
    const openQuestionModalCloseButton = document.getElementById('open-question-modal-close');
    const openQuestionDraggableHandle = document.getElementById('open-question-draggable-handle');
    const inputMandatoryOpenQuestion = document.getElementById('isMandatory');
    const allInputOpenQuestions = document.getElementsByClassName('open-question-input');
    const checkboxHelpertext = document.getElementById('addAHelpertext');
    const newAddtHelperText = document.getElementById('checkbox-helper-text-open-question');
    const body = document.getElementById('body');
    const draggable = require('draggable');
    const draggableOptions = {
        handle: openQuestionDraggableHandle,
        limit: {x: [340,1755],y: [0, 620]}
    };

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
        inputMandatoryOpenQuestion.checked = false;
        checkboxHelpertext.checked = false ;
        for (const allInputOpenQuestion of allInputOpenQuestions) {
            allInputOpenQuestion.value = '';
        }
        addFullScreenContainerModalCloseOpenQuestion.classList.remove('full-screen-open-question-container-modal-close-display');
        body.classList.remove('hide-body-overflow-open-question');
    }); 
    // Function used to open and close the checkbox helperText
    checkboxHelpertext.addEventListener('click', function(){
        if (checkboxHelpertext.checked){

            const newInputHelperText = document.createElement('input');
            
            newInputHelperText.classList.add('open-question-input');

            newInputHelperText.type = 'text';
            newInputHelperText.setAttribute('required', 'required');
            newInputHelperText.setAttribute('placeholder', 'HelperText');
            newInputHelperText.setAttribute('id', 'open-question-helperText');
            newInputHelperText.setAttribute('name', 'helperText');

            newAddtHelperText.appendChild(newInputHelperText);

            
        }else {
            const helperText = document.getElementById('open-question-helperText');
            helperText.remove();

        }

    });
}
