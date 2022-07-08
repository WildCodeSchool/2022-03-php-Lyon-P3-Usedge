if (document.getElementById('create-plans')) {

    const createPlansButton = document.getElementById('create-plans');
    const addFullScreenRequestContainerModalClose = document.getElementById('full-screen-request-container-modal-close');
    const requestDetailsCloseButton = document.getElementById('request-details-close');
    const body = document.getElementById('body');

    createPlansButton.addEventListener('click', () => {

        addFullScreenRequestContainerModalClose.classList.add('full-screen-request-container-modal-display');
        body.classList.add('hide-body-request-overflow');

        window.onclick = function (event) {
            if (event.target == addFullScreenRequestContainerModalClose) {
                addFullScreenRequestContainerModalClose.classList.remove('full-screen-request-container-modal-display');
                body.classList.remove('hide-body-request-overflow');
            }
        };
    });
    requestDetailsCloseButton.addEventListener('click', () => {
        addFullScreenRequestContainerModalClose.classList.remove('full-screen-request-container-modal-display');
        body.classList.remove('hide-body-request-overflow');
    })

    
}