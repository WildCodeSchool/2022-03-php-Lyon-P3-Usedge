

if (document.getElementById('text-editor-button')) {
    
    const textEditorButton = document.getElementById('text-editor-button');
    const editTextButton = document.getElementById('edit-recommandation-icon-container');
    const createRecommandationContainer = document.getElementById('create-recommandation-container');
    const validateRecommandationButton = document.getElementById('validate-recommandation-button');
    const recommandationDetails = document.getElementById('recommandation-details');
    const recommandationDetailsContainer = document.getElementById('recommandation-details-container');
    const sendResearchPlanButton = document.getElementById('send-research-plan');
    const buttonAddObjectives = document.getElementById('button-add-objectives');
    const recommandationInput = document.getElementById('recommandation-input');
    
    const FroalaEditor = require('froala-editor');
    
    
    textEditorButton.addEventListener('click', () => {
        
        textEditorButton.classList.add('create-recommandation-none');
        textEditorButton.classList.remove('create-recommandation');
        createRecommandationContainer.classList.add('create-recommandation-container');
        createRecommandationContainer.classList.remove('create-recommandation-container-none');
        sendResearchPlanButton.classList.add('send-research-plan-disabled');
        sendResearchPlanButton.classList.remove('send-research-plan');
        sendResearchPlanButton.setAttribute('disabled', 'disabled');
        buttonAddObjectives.classList.add('button-add-objectives-disabled');
        buttonAddObjectives.classList.remove('button-add-objectives');
        buttonAddObjectives.setAttribute('disabled', 'disabled');
        new FroalaEditor('#create-recommandation-text');
    });

    editTextButton.addEventListener('click', () => {
        const recommandationDetailsParagraphs = document.querySelectorAll('.recommandation-details-paragraph');
        
        for (const recommandationDetailsParagraph of recommandationDetailsParagraphs) {
            recommandationDetailsParagraph.remove();
        }
        sendResearchPlanButton.classList.add('send-research-plan-disabled');
        sendResearchPlanButton.classList.remove('send-research-plan');
        sendResearchPlanButton.setAttribute('disabled', 'disabled');
        buttonAddObjectives.classList.add('button-add-objectives-disabled');
        buttonAddObjectives.classList.remove('button-add-objectives');
        buttonAddObjectives.setAttribute('disabled', 'disabled');
        recommandationDetails.classList.add('recommandation-details-none');
        recommandationDetails.classList.remove('recommandation-details');
        createRecommandationContainer.classList.add('create-recommandation-container');
        createRecommandationContainer.classList.remove('create-recommandation-container-none');
        new FroalaEditor('#create-recommandation-text');
    });
    
    validateRecommandationButton.addEventListener('click', () =>{
        const editorBody = document.querySelector('.fr-wrapper');
        recommandationInput.value = "";
        const newRecommandationDetailsParagraph = editorBody.cloneNode(true);
        if (document.querySelector('.fr-placeholder')) {
            const placholder = document.querySelector('.fr-placeholder');
            placholder.remove();
            recommandationInput.value = editorBody.innerHTML;
        }
        newRecommandationDetailsParagraph.classList.add('recommandation-details-paragraph');
        recommandationDetailsContainer.appendChild(newRecommandationDetailsParagraph);
        recommandationDetailsContainer.appendChild(recommandationInput);
        newRecommandationDetailsParagraph.innerHTML = editorBody.innerHTML;
        if(editorBody.innerHTML === "") {
            newRecommandationDetailsParagraph.remove();
        }
        sendResearchPlanButton.classList.remove('send-research-plan-disabled');
        sendResearchPlanButton.classList.add('send-research-plan');
        sendResearchPlanButton.removeAttribute('disabled');
        buttonAddObjectives.classList.remove('button-add-objectives-disabled');
        buttonAddObjectives.classList.add('button-add-objectives');
        buttonAddObjectives.removeAttribute('disabled');
        recommandationDetails.classList.add('recommandation-details');
        recommandationDetails.classList.remove('recommandation-details-none');
        createRecommandationContainer.classList.add('create-recommandation-container-none');
        createRecommandationContainer.classList.remove('create-recommandation-container');
    });
}