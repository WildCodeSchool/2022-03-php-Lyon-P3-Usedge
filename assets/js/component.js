/*Action to insert an input when the user click on the button + in the modal*/
const button = document.getElementById('button_answer');
button.addEventListener('click', function() {
    const divAnswer = document.getElementById('form_answer');
    let newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.placeholder = 'Answer';
    newInput.className = 'form_answer';
    newInput.name = 'form_answer';
    newInput.style.width = '100%';
    newInput.style.height = '42px';
    newInput.style.border = '1px solid #ECEFFF';
    newInput.style.borderRadius = '8px';
    newInput.style.marginBottom = '20px';
    newInput.style.display = 'flex';
    newInput.style.flexDirection = 'column';
    divAnswer.appendChild(newInput);
});

/*Action to send all informations in the modal to the div Add Elements */
const buttonActionComponent = document.getElementById('button_action_component');

const buttonModal = document.getElementById('button_action_modal');
    
buttonActionComponent.addEventListener('click', function() {

    const modal = document.getElementById('modal');
    const inputQuestion = document.getElementById('input_question').value;
    const displayFormBuilder = document.getElementById('display_form_builder');
    const formAnswers = document.getElementsByClassName('form_answer');

    displayFormBuilder.innerHTML = displayFormBuilder.innerHTML + "<input type='hidden' name='input_question' value=" + inputQuestion + ">" + inputQuestion + "</br>";
    document.getElementById('input_question').value = ''; 

    for (let i = 0; i < formAnswers.length; i++) {
        const formAnswer = formAnswers[i].value;
        displayFormBuilder.innerHTML = displayFormBuilder.innerHTML + "<input type='checkbox' class='checkboxAnswer' name='form_answer' value=" + formAnswer + [i] + ">" + formAnswer;
        document.getElementById('form_answer').value = '';
    }
    modal.style.visibility = 'hidden';
});