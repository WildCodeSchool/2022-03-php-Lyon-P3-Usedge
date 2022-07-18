// Careful : for first const, check real button id when integration !
if (document.getElementById('research-template-list-card')) {

    const researchTemplateListCards = document.getElementsByClassName('research-template-list-card');

    let i = 1;

    for (const researchTemplateListCard of researchTemplateListCards) {
        if (document.getElementById('research-template-list-card-options' + i)) {
            
            const buttonListCardOptions = document.getElementById('research-template-list-card-options' + i);
            const actionsMenuContainer = document.getElementById('actions-menu-container' + i);
            const fullScreenActionMenuContainerModalClose = document.getElementById('full-screen-action-menu-container-modal-close' + i);
            const actionsMenuContainerArchives = document.getElementsByClassName("modal_delete_template");
            // Open the modal actionsMenuContainer when click on buttonListCardOptions
            buttonListCardOptions.addEventListener('click', function () {
                actionsMenuContainer.classList.add('actions-menu-container-flex');
                fullScreenActionMenuContainerModalClose.classList.add('full-screen-action-menu-container-modal-close-display');

                // Function used to close the modal when click outside the modal

                window.onclick = function (e) {
                    if (e.target == fullScreenActionMenuContainerModalClose) {
                        for (const actionsMenuContainerArchive of actionsMenuContainerArchives) {
                            actionsMenuContainerArchive.classList.remove("actions-menu-container-flex_archive");
                        }
                        actionsMenuContainer.classList.remove('actions-menu-container-flex');
                        fullScreenActionMenuContainerModalClose.classList.remove('full-screen-action-menu-container-modal-close-display');
                    }
                }
            
            });
       
        }
        i++;
    }
}



