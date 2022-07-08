const buttonListCardOptions = document.getElementById('action_modal');
const actionsMenuContainer = document.getElementById('modal_delete_template');
const fullScreenActionMenuContainerModalClose = document.getElementById('no_keep_the_template');

buttonListCardOptions.addEventListener('click', function () {
    actionsMenuContainer.classList.add('actions-menu-container-flex');
    fullScreenActionMenuContainerModalClose.classList.add('full-screen-action-menu-container-modal-close-display');
    
    window.onclick = function (e) {
        if (e.target == fullScreenActionMenuContainerModalClose) {
            actionsMenuContainer.classList.remove('actions-menu-container-flex');
            fullScreenActionMenuContainerModalClose.classList.remove('full-screen-action-menu-container-modal-close-display');
        }
    }
});
