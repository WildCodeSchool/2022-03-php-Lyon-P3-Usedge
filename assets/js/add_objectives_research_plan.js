if (document.getElementById('button-select-objectives')) {

    const buttonAddObjectives = document.getElementById('button-select-objectives');
    const sendResearchPlanButton = document.getElementById('send-research-plan');

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

            inputCheckbox.value = '';
            
        }
    }, true);

    const buttonSaveObjectives = document.getElementById('button-save-objectives');

    buttonSaveObjectives.addEventListener('click', () => {
        alert('hello');
    });

}