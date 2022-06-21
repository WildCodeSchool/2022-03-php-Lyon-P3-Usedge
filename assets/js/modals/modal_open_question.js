
if (document.getElementById('open-question-button')) {

    const button = document.getElementById('open-question-button');
    const openQuestionButton = document.getElementById('open-question-button');
    const openQuestionCreationModal = document.getElementById('open-question-creation-modal');
    const addFullScreenContainerModalCloseOpenQuestion= document.getElementById('full-screen-container-modal-close-open-question');
    const body = document.getElementById('body');

    // Function used to open the modal
    openQuestionButton.addEventListener('click', () => {
        addFullScreenContainerModalCloseOpenQuestion.classList.add('full-screen-open-question-container-modal-close-display');
        body.classList.add('hide-body-overflow');

        // Function used to close the modal when click outside the modal
        window.onclick = function(event) {
            if (event.target ==  addFullScreenContainerModalCloseOpenQuestion) { 
                addFullScreenContainerModalCloseOpenQuestion.classList.remove('full-screen-open-question-container-modal-close-display');
                body.classList.remove('hide-body-overflow');
            }
        };
    });
}