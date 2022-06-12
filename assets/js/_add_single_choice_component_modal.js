// Careful : for first const, check real button id when integration !

if (document.getElementById('button_answer_single_choice')) {

    /*Action to insert an input when the user click on the button + in the modal*/
    const button = document.getElementById('button_answer_single_choice');
    const singleAnswerContainer = document.getElementById('single_answer_container');
    const displayFormBuilder = document.getElementById('display_form_builder');
    const addSingleChoiceModalOpenButton = document.getElementById('add-single-choice-button');
    const addSingleChoiceModal = document.getElementById('add-single-choice-modal');
    const addFullScreenContainerModalClose= document.getElementById('full-screen-container-modal-close');
    const buttonActionComponentSingleChoice = document.getElementById('button_action_component_single_choice');
    const body = document.getElementById('body');

    // Function used to open the modal
    addSingleChoiceModalOpenButton.addEventListener('click', () => {
        addSingleChoiceModal.classList.add('add-single-choice-modal-display');
        addFullScreenContainerModalClose.classList.add('full-screen-container-modal-close-display');
        body.classList.add('hide-body-overflow');
    });
 
    // Function used to close the modal when click outside the modal
    window.onclick = function(event) {
        if (event.target == addFullScreenContainerModalClose) {
            addSingleChoiceModal.classList.remove('add-single-choice-modal-display'); 
            addFullScreenContainerModalClose.classList.remove('full-screen-container-modal-close-display');
            body.classList.remove('hide-body-overflow');
        }
    }; 
    // function to clone div contain input and img
    button.addEventListener('click', function() {
        const deleteInputAnswerHidden = document.getElementById('delete-input-answer-hidden');
        const deleteInputAnswerHiddenClone = deleteInputAnswerHidden.cloneNode(true);
        singleAnswerContainer.appendChild(deleteInputAnswerHiddenClone);
        const deleteInputAnswershidden = document.getElementsByClassName('delete-input-answer-hidden');
        for (let i = 1; i < deleteInputAnswershidden.length; i++) {
            const deleteInputsAnswer = deleteInputAnswershidden[i];
            deleteInputsAnswer.classList.remove('delete-input-answer-hidden')
            deleteInputsAnswer.classList.add('delete-input-answer')
        }
        // function to delete the first input
        const deleteInputAnswers = document.getElementsByClassName('delete-input-answer');
        for (const deleteInputAnswer of deleteInputAnswers) {
            deleteInputAnswer.onclick = function(event) {
                let target =  event.target;
                if (target === deleteInputAnswer){
                    target.remove(); 
                }
                        
            } 
        } 
    });
    

    /*Action to send all informations in the modal to the div Add Elements */ 
    buttonActionComponentSingleChoice.addEventListener('click', function() {
        const inputQuestion = document.getElementById('input_add_single_question').value;
        const inputAnswers = document.getElementsByClassName('input_answer');
        const deleteInputAnswers = document.querySelectorAll('#single_answer_container .delete-input-answer');
        const allInputAnswers = document.querySelectorAll('#single_answer_container .delete-input-answer .input_answer');
        // check before send value
        if(document.getElementsByClassName('delete-input-answer').length !== 0) {
            for (const oneInputAnswer of allInputAnswers) {
                if (oneInputAnswer.value === "") {
                    return false;
                } 
            }
            if (inputQuestion === "") {
                return false;
            } else {
                displayFormBuilder.innerHTML = displayFormBuilder.innerHTML + "<input type='hidden' name='input_question' value=" + inputQuestion + ">" + inputQuestion + "</br>";
                document.getElementById('input_add_single_question').value = '';
            }
            for (let i = 1; i < inputAnswers.length; i++) {
                const inputAnswer = inputAnswers[i].value;
                displayFormBuilder.innerHTML = displayFormBuilder.innerHTML + "<input type='radio' class='checkboxAnswer' name='form_answer' value=" + inputAnswer + ">" + inputAnswer; 
            }
            displayFormBuilder.innerHTML = displayFormBuilder.innerHTML + "<br><br>";
            // delete all clone after they was submitted
            for (const deleteInputAnswer of deleteInputAnswers) {
                deleteInputAnswer.remove();
            }

            addFullScreenContainerModalClose.classList.remove('full-screen-container-modal-close-display'); 
        } 
    });
}
