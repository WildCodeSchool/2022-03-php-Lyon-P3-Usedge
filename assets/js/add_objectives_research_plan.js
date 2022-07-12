if (document.getElementById('button-select-objectives')) {

    const buttonAddObjectives = document.getElementById('button-select-objectives');
    const sendResearchPlanButton = document.getElementById('send-research-plan');
    const addObjectivesPandSave = document.getElementById('add-objectives-p-and-save');

    buttonAddObjectives.addEventListener('click', () => {

        buttonAddObjectives.classList.remove('button-select-objectives');
        buttonAddObjectives.classList.add('button-select-objectives-display');
        
        const addObjectives = document.getElementById('add-objectives');
        addObjectives.classList.remove('add-objectives');
        addObjectives.classList.add('add-section-new-objectives');

        sendResearchPlanButton.setAttribute('disabled', 'disabled');

    });

    const inputCheckbox = document.getElementById('input-objectives');
    
    inputCheckbox.addEventListener("keydown", function(event) {

        if (event.key === "Enter") {

            const inputCheckbox = document.getElementById('input-objectives');
            const checkboxCase = document.getElementById('input-checkbox-objectives');
            const checkboxValue = document.getElementById('input-checkbox-text-objectives');
            const divCheckbox = document.getElementById('new-input-checkbox');

            event.preventDefault();
            let valueInput = inputCheckbox.value;
            let newDivParagraph = document.createElement("p");
            let newInputHidden = document.createElement("input");
            newInputHidden.setAttribute('type', 'hidden');
            newInputHidden.setAttribute('class', 'all-input-hidden');
            newInputHidden.setAttribute('value', valueInput);

            checkboxCase.classList.add('input-example-display');
            checkboxValue.classList.add('input-example-display');

            let newCheckbox = document.createElement("input");
            newCheckbox.setAttribute("type", "checkbox");
            newCheckbox.setAttribute("class", "newDivCheck");

            let newLabel = document.createElement("label");
            newLabel.setAttribute("for", "checkbox");
            newLabel.setAttribute("class", "newDivLabel");
        
            newLabel.innerHTML = valueInput;

            divCheckbox.appendChild(newDivParagraph);

            newDivParagraph.appendChild(newCheckbox);
            newDivParagraph.appendChild(newLabel);
            newDivParagraph.appendChild(newInputHidden);

            inputCheckbox.value = '';

            const allInputHiddenSelected = document.querySelectorAll('.all-input-hidden');

            let i = 0;
            allInputHiddenSelected.forEach(input => {
                input.setAttribute('name', 'research-plan-objectives-' + i);
                i++;
            });
        }   
    }, true);



    const buttonSaveObjectives = document.getElementById('button-save-objectives');
    const addObjectivesP = document.getElementById('add-objectives-p');

    buttonSaveObjectives.addEventListener('click', () => {
        addObjectivesP.classList.remove('add-objectives-p');
        addObjectivesP.classList.add('add-objectives-p-none');
        addObjectivesPandSave.classList.remove('add-objectives-p-and-save-display');
        addObjectivesPandSave.classList.add('add-objectives-p-and-save');
        inputCheckbox.classList.remove('input-objectives');
        inputCheckbox.classList.add('input-objectives-display');
        buttonSaveObjectives.style.display = "none";
        buttonSaveObjectives.classList.remove('button-save-objectives');
        buttonSaveObjectives.classList.add('button-save-objectives-display');

        sendResearchPlanButton.classList.remove('send-research-plan-disabled');
        sendResearchPlanButton.classList.add('send-research-plan');
    });

}