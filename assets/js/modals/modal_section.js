
/*Action to call all classes to active the section modal*/
if (document.getElementById('add-section-button')) {
    const addSectionModalOpenButton = document.getElementById('add-section-button');
    const addSectionModal = document.getElementById('add-section-modal');
    const sectionDraggableHandle = document.getElementById('section-draggable-handle');
    const FullScreenSectionModalClose = document.getElementById('full-screen-section-modal-close');
    const sectionModalCloseButton = document.getElementById('section-modal-close');
    const inputSectionTitle = document.getElementById('input-section-title');
    const addSectionName = document.getElementById('section-name');
    const body = document.getElementById('body');
    const draggable = require('draggable');
    const draggableOptions = {handle: sectionDraggableHandle}

    // Function used to open the modal
    addSectionModalOpenButton.addEventListener('click', () => {
        FullScreenSectionModalClose.classList.add('full-screen-section-modal-display');
        body.classList.add('hide-body-overflow-section');
        addSectionName.setAttribute('name', 'name');
        new draggable(addSectionModal, draggableOptions);
        // Function used to close the modal when click outside of the modal
        window.onclick = function(event) {
            if (event.target == FullScreenSectionModalClose) {
                FullScreenSectionModalClose.classList.remove('full-screen-section-modal-display');
                body.classList.remove('hide-body-overflow-section');
                addSectionName.setAttribute('name', '');
            }
        };
    });

    // Function used to close the modal when click on close button and initialise values
    sectionModalCloseButton.addEventListener('click', () => {
        inputSectionTitle.value = '';
        FullScreenSectionModalClose.classList.remove('full-screen-section-modal-display');
        body.classList.remove('hide-body-overflow-section');
        addSectionName.setAttribute('name', '');
    });    
}