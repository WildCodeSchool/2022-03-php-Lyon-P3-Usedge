if (document.getElementById('button-add-objectives')) {

    //Function to open the modal for add objectives
    const buttonAddObjectives = document.getElementById('button-add-objectives');
    const sendResearchPlanButton = document.getElementById('send-research-plan');
    const addObjectivesPandSave = document.getElementById('add-objectives-p-and-save');
    const objectivesCount = document.getElementById('objectives-count');
    
    buttonAddObjectives.addEventListener('click', () => {

        buttonAddObjectives.classList.remove('button-add-objectives');
        buttonAddObjectives.classList.add('button-select-objectives-display');
        
        const addObjectives = document.getElementById('add-objectives');
        addObjectives.classList.remove('add-objectives');
        addObjectives.classList.add('add-section-new-objectives');

        sendResearchPlanButton.classList.add('send-research-plan-disabled');
        sendResearchPlanButton.classList.remove('send-research-plan');
        sendResearchPlanButton.setAttribute('disabled', 'disabled');
    });

    //Function to add objectives in checkbox when the coach clic on enter
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
 
            let newButtonRemove = document.createElement("button");
            newButtonRemove.setAttribute('type', 'hidden');
            newButtonRemove.setAttribute('class', 'remove-objectives');
 
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
            newDivParagraph.appendChild(newButtonRemove);

            inputCheckbox.value = '';
        }
    }, true);

    //Function to validate all objectives
    const buttonSaveObjectives = document.getElementById('button-save-objectives');
    const addObjectivesP = document.getElementById('add-objectives-p');
    
    buttonSaveObjectives.addEventListener('click', () => {
        const allInputHiddenSelected = document.querySelectorAll('.all-input-hidden');

        let objectives = 1;
        objectivesCount.value = 0;
        allInputHiddenSelected.forEach(input => {
            input.setAttribute('name', 'research-plan-objectives-' + objectives);
            objectivesCount.value = objectives;
            objectives++;
        });

        addObjectivesP.classList.remove('add-objectives-p');
        addObjectivesP.classList.add('add-objectives-p-none');
        addObjectivesPandSave.classList.remove('add-objectives-p-and-save-display');
        addObjectivesPandSave.classList.add('add-objectives-p-and-save');
        inputCheckbox.classList.remove('input-objectives');
        inputCheckbox.classList.add('input-objectives-display');
        buttonSaveObjectives.classList.remove('button-save-objectives');
        buttonSaveObjectives.classList.add('button-save-objectives-display');

        sendResearchPlanButton.classList.remove('send-research-plan-disabled');
        sendResearchPlanButton.classList.add('send-research-plan');
        sendResearchPlanButton.removeAttribute('disabled');
    });

    //Function to edit the objectives
    const editButton = document.getElementById('edit-objectives-icon');
    

    editButton.addEventListener('click', () => {

        const allRemoveObjectives = document.querySelectorAll('.remove-objectives');
        const addObjectives = document.getElementById('add-objectives');
        const allLabel = document.querySelectorAll('.newDivLabel');
        const allInputHiddenSelected = document.querySelectorAll('.all-input-hidden');

        sendResearchPlanButton.classList.add('send-research-plan-disabled');
        sendResearchPlanButton.classList.remove('send-research-plan');
        sendResearchPlanButton.setAttribute('disabled', 'disabled');

        addObjectives.classList.remove('add-objectives');
        addObjectives.classList.add('add-section-new-objectives');
    
        for (const item of allRemoveObjectives) {
            item.classList.remove('remove-objectives');
            item.classList.add('remove-objectives-display');
        }

        for (const label of allLabel) {
            label.classList.remove('newDivLabel');
            label.classList.add('newDivLabelDisplay');
        }

        allInputHiddenSelected.forEach(input => {
            input.setAttribute('type', "text");
        });

        buttonSaveObjectives.classList.remove('button-save-objectives-display');
        buttonSaveObjectives.classList.add('button-save-objectives');

        buttonSaveObjectives.addEventListener('click', () => {

            buttonSaveObjectives.classList.remove('button-save-objectives');
            buttonSaveObjectives.classList.add('button-save-objectives-display');

            allInputHiddenSelected.forEach(input => {
                input.setAttribute('class', "all-input-hidden-validate");
            });

            for (const item of allRemoveObjectives) {
                item.classList.add('remove-objectives');
                item.classList.remove('remove-objectives-display');
            }

            sendResearchPlanButton.classList.remove('send-research-plan-disabled');
            sendResearchPlanButton.classList.add('send-research-plan');
            sendResearchPlanButton.removeAttribute('disabled');
        });
    });
}