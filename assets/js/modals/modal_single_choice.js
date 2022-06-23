// Careful : for first const, check real button id when integration !
if (document.getElementById('button_answer_single_choice')) {

    /*Action to insert an input when the user click on the button + in the modal*/
    const singleButton = document.getElementById('button_answer_single_choice');
    const singleAnswerContainer = document.getElementById('single_answer_container');
    const addSingleChoiceModalOpenButton = document.getElementById('add-single-choice-button');
    const addSingleChoiceModal = document.getElementById('add-single-choice-modal');
    const addFullScreenSingleContainerModalClose = document.getElementById('full-screen-single-container-modal-close');
    const addsingleChoiceName = document.getElementById('single-choice-name');
    const bodySingle = document.getElementById('body');
    const singleChoiceModalCloseButton = document.getElementById('single-choice-modal-close');
    const singleChoiceDraggableHandle = document.getElementById('single-choice-handle-draggable');
    const draggable = require('draggable');
    const draggableOptions = {handle: singleChoiceDraggableHandle}


    // Function used to open the modal
    addSingleChoiceModalOpenButton.addEventListener('click', () => {
        addSingleChoiceModal.classList.add('add-single-choice-modal-display');
        addFullScreenSingleContainerModalClose.classList.add('full-screen-single-container-modal-close-display');
        addsingleChoiceName.setAttribute('name','name');
        bodySingle.classList.add('hide-body-single-overflow');
        new draggable(addSingleChoiceModal, draggableOptions);

        // Function used to close the modal when click outside the modal
        window.onclick = function (event) {
            if (event.target == addFullScreenSingleContainerModalClose) {
                addSingleChoiceModal.classList.remove('add-single-choice-modal-display');
                addFullScreenSingleContainerModalClose.classList.remove('full-screen-single-container-modal-close-display');
                addsingleChoiceName.setAttribute('name','');
                bodySingle.classList.remove('hide-body-single-overflow');
            }
        };
    });

    // Function used to close the modal when click on close button and initialise values
    singleChoiceModalCloseButton.addEventListener('click', () => {
        addFullScreenSingleContainerModalClose.classList.remove('full-screen-single-container-modal-close-display');
        bodySingle.classList.remove('hide-body-single-overflow');
        document.getElementById('input_add_single_question').value = '';
        if (document.getElementsByClassName('delete-input-single-answer')) {
            const deleteInputAnswers = document.querySelectorAll('.delete-input-answer');
            const singleAnswerNumber = document.getElementById('input-answer-number');
            const inputMandatorySingleChoice = document.getElementById('input-mandatory-single-choice');
            singleAnswerNumber.value = '';
            deleteInputAnswers.forEach(inputAnswer => {
                inputAnswer.remove();
            });
            inputMandatorySingleChoice.checked = false;
        }
        
        
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
        newInputAnswer.setAttribute('required', 'required');

        deleteInputAnswer.appendChild(dragAndDrop);
        deleteInputAnswer.appendChild(newInputAnswer);
        singleAnswerContainer.appendChild(deleteInputAnswer);

        // function to delete input
        const deleteInputAnswers = document.getElementsByClassName('delete-input-answer');
        const inputAnswers = document.getElementsByClassName('input_answer');
        const inputAnswerNumber = document.getElementById('input-answer-number');

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
