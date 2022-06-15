// Careful : for first const, check real button id when integration !

const { eventListeners } = require("@popperjs/core");

if (document.getElementById('button_answer_multiple_choice')) {

    /*Action to insert an input when the user click on the button + in the modal*/
    const button = document.getElementById('button_answer_multiple_choice');
    const multipleAnswerContainer = document.getElementById('multiple_answer_container');
    const addmultipleChoiceModalOpenButton = document.getElementById('add-multiple-choice-button');
    const addmultipleChoiceModal = document.getElementById('add-multiple-choice-modal');
    const addFullScreenContainerModalClose= document.getElementById('full-screen-container-modal-close');
    const newComponentmultipleChoiceForm = document.getElementById('new-component-multiple-choice-form');
    const body = document.getElementById('body');

    /* newComponentmultipleChoiceForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const form = new FormData(newComponentmultipleChoiceForm);
        fetch('/research-template/add/{id}',{
        method: 'POST',
        body: form
        })
    }) */

    // Function used to open the modal
    addmultipleChoiceModalOpenButton.addEventListener('click', () => {
        addmultipleChoiceModal.classList.add('add-multiple-choice-modal-display');
        addFullScreenContainerModalClose.classList.add('full-screen-container-modal-close-display');
        body.classList.add('hide-body-overflow');
    });
 
    // Function used to close the modal when click outside the modal
    window.onclick = function(event) {
        if (event.target == addFullScreenContainerModalClose) {
            addmultipleChoiceModal.classList.remove('add-multiple-choice-modal-display'); 
            addFullScreenContainerModalClose.classList.remove('full-screen-container-modal-close-display');
            body.classList.remove('hide-body-overflow');
        }
    }; 
    // function to create div and input
    button.addEventListener('click', function() {
        const newInputAnswer = document.createElement('input');
        const deleteInputAnswer = document.createElement('div');
        const dragAndDrop = document.createElement('div');
        newInputAnswer.classList.add('input_answer');
        deleteInputAnswer.classList.add('delete-input-answer');
        dragAndDrop.classList.add('drag-and-drop');
        newInputAnswer.type = 'text';
        deleteInputAnswer.appendChild(dragAndDrop);
        deleteInputAnswer.appendChild(newInputAnswer);
        multipleAnswerContainer.appendChild(deleteInputAnswer);
        // function to delete input
        const deleteInputAnswers = document.getElementsByClassName('delete-input-answer');
        const inputAnswers = document.getElementsByClassName('input_answer');
        const inputAnswerNumber = document.getElementById('input-answer-number');
        inputAnswerNumber.value = inputAnswers.length;
        for (const deleteInputAnswer of deleteInputAnswers) {
            deleteInputAnswer.onclick = function(event) {
                let target =  event.target;
                if (target === deleteInputAnswer){
                    target.remove();
                    for (let i = 0; i < inputAnswers.length; i++) {
                        const inputAnswer = inputAnswers[i];
                        inputAnswer.setAttribute('name', 'answer' + i);
                        inputAnswer.setAttribute('id', 'input_answer' + i);
                    }
                }        
            }
            for (let i = 0; i < inputAnswers.length; i++) {
                const inputAnswer = inputAnswers[i];
                inputAnswer.setAttribute('name', 'answer' + i );
                inputAnswer.setAttribute('id', 'input_answer' + i);
            }

        }
    });
}
