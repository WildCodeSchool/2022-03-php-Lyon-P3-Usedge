// Careful : for first const, check real button id when integration !

if (document.getElementById('button_answer_multiple_choice')) {

    /*Action to insert an input when the user click on the button + in the modal*/
    const multipleButton = document.getElementById('button_answer_multiple_choice');
    const multipleAnswerContainer = document.getElementById('multiple_answer_container');
    const addmultipleChoiceModalOpenButton = document.getElementById('add-multiple-choice-button');
    const addmultipleChoiceModal = document.getElementById('add-multiple-choice-modal');
    const addFullScreenMultipleContainerModalClose = document.getElementById('full-screen-multiple-container-modal-close');
    const addMultipleChoiceName = document.getElementById('multiple-choice-name');
    const bodyMultiple = document.getElementById('body');
    const multipleChoiceModalCloseButton = document.getElementById('multiple-choice-modal-close');
    const multipleChoiceDraggableHandle = document.getElementById('multiple-choice-handle-draggable');
    const draggable = require('draggable');
    const draggableOptions = {handle: multipleChoiceDraggableHandle}

    // Function used to open the modal
    addmultipleChoiceModalOpenButton.addEventListener('click', () => {
        addmultipleChoiceModal.classList.add('add-multiple-choice-modal-display');
        addFullScreenMultipleContainerModalClose.classList.add('full-screen-multiple-container-modal-close-display');
        bodyMultiple.classList.add('hide-body-multiple-overflow');
        addMultipleChoiceName.setAttribute('name','name');
        new draggable(addmultipleChoiceModal, draggableOptions);

        // Function used to close the modal when click outside the modal
        window.onclick = function (event) {
            if (event.target == addFullScreenMultipleContainerModalClose) {
                addmultipleChoiceModal.classList.remove('add-multiple-choice-modal-display');
                addFullScreenMultipleContainerModalClose.classList.remove('full-screen-multiple-container-modal-close-display');
                bodyMultiple.classList.remove('hide-body-multiple-overflow');
                addMultipleChoiceName.setAttribute('name','');
            }
        };
    });

    // Function used to close the modal when click on close button and initialise values
    multipleChoiceModalCloseButton.addEventListener('click', () => {
        addFullScreenMultipleContainerModalClose.classList.remove('full-screen-multiple-container-modal-close-display');
        bodyMultiple.classList.remove('hide-body-multiple-overflow');
        document.getElementById('input_add_multiple_question').value = '';
        if (document.getElementsByClassName('delete-input-multiple-answer')) {
            const deleteInputAnswers = document.querySelectorAll('.delete-input-answer');
            const multipleAnswerNumber = document.getElementById('input-answer-number');
            const inputMandatoryMultipleChoice = document.getElementById('input-mandatory-multiple-choice');
            multipleAnswerNumber.value = '';
            deleteInputAnswers.forEach(inputAnswer => {
                inputAnswer.remove();
            });
            inputMandatoryMultipleChoice.checked = false;
        }
    }); 

    // function to create div and input
    multipleButton.addEventListener('click', function () {
        const newInputAnswer = document.createElement('input');
        const deleteInputAnswer = document.createElement('div');
        const dragAndDrop = document.createElement('div');
        newInputAnswer.classList.add('input_answer');
        deleteInputAnswer.classList.add('delete-input-answer');
        dragAndDrop.classList.add('drag-and-drop');
        newInputAnswer.type = 'text';
        newInputAnswer.setAttribute('required', 'required');
        newInputAnswer.setAttribute('placeholder', 'Answer');
        deleteInputAnswer.appendChild(dragAndDrop);
        deleteInputAnswer.appendChild(newInputAnswer);
        multipleAnswerContainer.appendChild(deleteInputAnswer);
        // function to delete input
        const deleteInputAnswers = document.getElementsByClassName('delete-input-answer');

        const inputAnswers = document.getElementsByClassName('input_answer');
        const inputAnswerNumber = document.getElementById('input-answer-number-multiple');
        inputAnswerNumber.value = inputAnswers.length;
        for (let i = 0; i < deleteInputAnswers.length; i++) {
            const deleteInputAnswer = deleteInputAnswers[i];
            deleteInputAnswer.onclick = function(event) {
                let target =  event.target;
                if (target === deleteInputAnswer){
                    target.remove();
                    const inputAnswers = document.getElementsByClassName('input_answer');
                    for (let i = 0; i < inputAnswers.length; i++) {
                        const inputAnswer = inputAnswers[i];
                        inputAnswer.setAttribute('name', 'answer' + i);
                        inputAnswer.setAttribute('id', 'input_answer' + i);
                        inputAnswerNumber.value = inputAnswers.length;
                    }
                }
            }

            for (let i = 0; i < inputAnswers.length; i++) {
                const inputAnswer = inputAnswers[i];
                inputAnswer.setAttribute('name', 'answer' + i);
                inputAnswer.setAttribute('id', 'input_answer' + i);
            }
        }
    });
}
