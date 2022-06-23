// Careful : for first const, check real button id when integration !

if (document.getElementById('button_answer_select')) {

    /*Action to insert an input when the user click on the button + in the modal*/
    const selectButton = document.getElementById('button_answer_select');
    const selectAnswerContainer = document.getElementById('select_answer_container');
    const addSelectModalOpenButton = document.getElementById('add-select-button');
    const addSelectModal = document.getElementById('add-select-modal');
    const selectModalCloseButton = document.getElementById('select-component-modal-close');
    const datePickerDraggableHandle = document.getElementById('select-draggable-handle');
    const fullScreenSelectModalClose = document.getElementById('full-screen-select-modal-close');
    const body = document.getElementById('body');
    const draggable = require('draggable');
    const draggableOptions = {handle: datePickerDraggableHandle}
    
    // Function used to open the modal
    addSelectModalOpenButton.addEventListener('click', () => {

        fullScreenSelectModalClose.classList.add('full-screen-select-modal-display');
        body.classList.add('hide-body-overflow-select');
        new draggable(addSelectModal, draggableOptions);
        // Function used to close the modal when click outside the modal
        window.onclick = function(event) {
            if (event.target == fullScreenSelectModalClose) {
                fullScreenSelectModalClose.classList.remove('full-screen-select-modal-display');
                body.classList.remove('hide-body-overflow-select');
            }
        };
    });
   
    // Function used to close the modal and initialize the datas
    selectModalCloseButton.addEventListener('click', () => {
        fullScreenSelectModalClose.classList.remove('full-screen-select-modal-display');
        body.classList.remove('hide-body-overflow-select');
        document.getElementById('input_add_select_title').value = '';
        if (document.getElementsByClassName('delete-input-select-answer')) {
            const deleteInputAnswers = document.querySelectorAll('.delete-input-select-answer');
            const selectAnswerNumber = document.getElementById('select-answer-number');
            const inputMandatorySelect = document.getElementById('input-mandatory-select');
            selectAnswerNumber.value = '';
            deleteInputAnswers.forEach(inputAnswer => {
                inputAnswer.remove();
            })
            inputMandatorySelect.checked = false;
        }
    });
    
    // function to create div and input
    selectButton.addEventListener('click', function() {
        const newInputAnswer = document.createElement('input');
        const deleteInputAnswer = document.createElement('div');
        const dragAndDrop = document.createElement('div');
        newInputAnswer.classList.add('input_select_answer');
        deleteInputAnswer.classList.add('delete-input-select-answer');
        dragAndDrop.classList.add('drag-and-drop');
        newInputAnswer.type = 'text';
        newInputAnswer.setAttribute('required', 'required');
        newInputAnswer.setAttribute('placeholder', 'Answer');
        deleteInputAnswer.appendChild(dragAndDrop);
        deleteInputAnswer.appendChild(newInputAnswer);
        selectAnswerContainer.appendChild(deleteInputAnswer);
        // function to delete input
        const deleteInputAnswers = document.getElementsByClassName('delete-input-select-answer');
        const inputSelectAnswers = document.getElementsByClassName('input_select_answer');
        const selectAnswerNumber = document.getElementById('select-answer-number');
        selectAnswerNumber.value = inputSelectAnswers.length;
        for (let i = 0; i < deleteInputAnswers.length; i++) {
            const deleteInputAnswer = deleteInputAnswers[i];
            deleteInputAnswer.onclick = function(event) {
                let target =  event.target;
                if (target === deleteInputAnswer){
                    target.remove();
                    const inputSelectAnswers = document.getElementsByClassName('input_select_answer');
                    for (let i = 0; i < inputSelectAnswers.length; i++) {
                        const inputAnswer = inputSelectAnswers[i];
                        inputAnswer.setAttribute('name', 'select_answer' + i);
                        inputAnswer.setAttribute('id', 'input_select_answer' + i);
                    }
                }        
            }
            for (let i = 0; i < inputSelectAnswers.length; i++) {
                const inputAnswer = inputSelectAnswers[i];
                inputAnswer.setAttribute('name', 'select_answer' + i );
                inputAnswer.setAttribute('id', 'input_select_answer' + i);
            }
        }
    });
}