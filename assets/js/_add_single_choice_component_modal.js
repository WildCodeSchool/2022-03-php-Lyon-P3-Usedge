// Careful : for first const, check real button id when integration !

const { eventListeners } = require("@popperjs/core");

if (document.getElementById('button_answer_single_choice')) {

    /*Action to insert an input when the user click on the button + in the modal*/
    const singleButton = document.getElementById('button_answer_single_choice');
    const singleAnswerContainer = document.getElementById('single_answer_container');
    const addSingleChoiceModalOpenButton = document.getElementById('add-single-choice-button');
    const addSingleChoiceModal = document.getElementById('add-single-choice-modal');
    const addFullScreenSingleContainerModalClose = document.getElementById('full-screen-single-container-modal-close');
    const newComponentSingleChoiceForm = document.getElementById('new-component-single-choice-form');
    const bodySingle = document.getElementById('body');

    /* newComponentSingleChoiceForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const form = new FormData(newComponentSingleChoiceForm);
        fetch('/research-template/add/{id}',{
        method: 'POST',
        body: form
        })
    }) */

    // Function used to open the modal
    addSingleChoiceModalOpenButton.addEventListener('click', () => {
        addSingleChoiceModal.classList.add('add-single-choice-modal-display');
        addFullScreenSingleContainerModalClose.classList.add('full-screen-single-container-modal-close-display');
        bodySingle.classList.add('hide-body-single-overflow');

        // Function used to close the modal when click outside the modal
        window.onclick = function (event) {
            if (event.target == addFullScreenSingleContainerModalClose) {
                addSingleChoiceModal.classList.remove('add-single-choice-modal-display');
                addFullScreenSingleContainerModalClose.classList.remove('full-screen-single-container-modal-close-display');
                bodySingle.classList.remove('hide-body-single-overflow');
            }
        };
    });

    // function to create div and input
    singleButton.addEventListener('click', function () {
        const newInputAnswer = document.createElement('input');
        const deleteInputAnswer = document.createElement('div');
        const dragAndDrop = document.createElement('div');
        newInputAnswer.classList.add('input_answer');
        deleteInputAnswer.classList.add('delete-input-answer');
        dragAndDrop.classList.add('drag-and-drop');
        newInputAnswer.type = 'text';
        deleteInputAnswer.appendChild(dragAndDrop);
        deleteInputAnswer.appendChild(newInputAnswer);
        singleAnswerContainer.appendChild(deleteInputAnswer);
        // function to delete input
        const deleteInputAnswers = document.getElementsByClassName('delete-input-answer');
        const inputAnswers = document.getElementsByClassName('input_answer');
        const inputAnswerNumber = document.getElementById('input-answer-number');
        inputAnswerNumber.value = inputAnswers.length;
        for (const deleteInputAnswer of deleteInputAnswers) {
            deleteInputAnswer.onclick = function (event) {
                let target = event.target;
                if (target === deleteInputAnswer) {
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
                inputAnswer.setAttribute('name', 'answer' + i);
                inputAnswer.setAttribute('id', 'input_answer' + i);
            }
        }
    });
}
