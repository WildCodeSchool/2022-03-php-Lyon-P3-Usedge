// Careful : for first const, check real button id when integration !
if (document.getElementById('research-template-list-card')) {

    const researchTemplateListCards = document.getElementsByClassName('research-template-list-card');

    let i = 1;

    for (const researchTemplateListCard of researchTemplateListCards) {

        const buttonListCardOptions = document.getElementById('research-template-list-card-options' + i);
        const actionsMenuContainer = document.getElementById('actions-menu-container' + i);
        const fullScreenActionMenuContainerModalClose = document.getElementById('full-screen-action-menu-container-modal-close' + i);

        // Open the modal actionsMenuContainer when click on buttonListCardOptions
        buttonListCardOptions.addEventListener('click', function () {
            actionsMenuContainer.classList.add('actions-menu-container-flex');
            fullScreenActionMenuContainerModalClose.classList.add('full-screen-action-menu-container-modal-close-display');

            // Function used to close the modal when click outside the modal

            window.onclick = function (e) {
                if (e.target == fullScreenActionMenuContainerModalClose) {
                    actionsMenuContainer.classList.remove('actions-menu-container-flex');
                    fullScreenActionMenuContainerModalClose.classList.remove('full-screen-action-menu-container-modal-close-display');
                }
            }
        });
        i++;
    }
}
