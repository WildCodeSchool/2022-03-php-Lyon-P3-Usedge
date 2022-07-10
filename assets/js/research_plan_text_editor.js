
if (document.getElementById('text-editor-button')) {
    
    const textEditorButton = document.getElementById('text-editor-button');
    const editTextButton = document.getElementById('edit-recommandation-icon-container');
    const createRecommandationContainer = document.getElementById('create-recommandation-container');
    const validateRecommandationButton = document.getElementById('validate-recommandation-button');
    const recommandationDetails = document.getElementById('recommandation-details');
    const recommandationDetailsContainer = document.getElementById('recommandation-details-container');
    const FroalaEditor = require('froala-editor');

    textEditorButton.addEventListener('click', () => {

        textEditorButton.classList.add('create-recommandation-none');
        textEditorButton.classList.remove('create-recommandation');
        createRecommandationContainer.classList.add('create-recommandation-container');
        createRecommandationContainer.classList.remove('create-recommandation-container-none');
        new FroalaEditor('#create-recommandation-text');
    });

    editTextButton.addEventListener('click', () => {
        const recommandationDetailsParagraphs = document.querySelectorAll('.recommandation-details-paragraph');
        for (const recommandationDetailsParagraph of recommandationDetailsParagraphs) {
            recommandationDetailsParagraph.remove();
        }
        const recommandationInputs = document.querySelectorAll('.recommandation-input');
        for (const recommandationInput of recommandationInputs) {
            recommandationInput.remove();
        }
        recommandationDetails.classList.add('recommandation-details-none');
        recommandationDetails.classList.remove('recommandation-details');
        createRecommandationContainer.classList.add('create-recommandation-container');
        createRecommandationContainer.classList.remove('create-recommandation-container-none');
        new FroalaEditor('#create-recommandation-text');
    });

    validateRecommandationButton.addEventListener('click', () =>{
        const editorBody = document.querySelector('.fr-wrapper');
        const texts = editorBody.querySelectorAll('.fr-element > p');
        let i = 1;
        for (const text of texts) {
            const newRecommandationDetailsParagraph = document.createElement('p');
            const recommandationInput = document.createElement('input');
            recommandationInput.type = 'hidden'
            recommandationInput.value = text.textContent;
            recommandationInput.setAttribute('name', 'recommandation' + i++)
            recommandationInput.classList.add('recommandation-input');
            newRecommandationDetailsParagraph.classList.add('recommandation-details-paragraph');
            recommandationDetailsContainer.appendChild(newRecommandationDetailsParagraph);
            recommandationDetailsContainer.appendChild(recommandationInput);
            newRecommandationDetailsParagraph.innerHTML = text.textContent;
            if(text.textContent === "") {
                newRecommandationDetailsParagraph.remove();
            }
        }
        

        recommandationDetails.classList.add('recommandation-details');
        recommandationDetails.classList.remove('recommandation-details-none');
        createRecommandationContainer.classList.add('create-recommandation-container-none');
        createRecommandationContainer.classList.remove('create-recommandation-container');
    });
    
        
    
    

}