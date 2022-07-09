if (document.querySelector('.assign-workshop')) {

    const assignWorkshopLink = document.querySelector('.assign-workshop');
    const availableWorkshopModalCloseButton = document.getElementById('research-plan-available-workshops-modal-close');
    const availableWorkshopModal = document.getElementById('research-plan-available-workshops-modal');

    assignWorkshopLink.addEventListener('click', () => {
        availableWorkshopModal.classList.add('research-plan-available-workshops-display');
    });

    availableWorkshopModalCloseButton.addEventListener('click', () => {
        availableWorkshopModal.classList.remove('research-plan-available-workshops-display');
    })

}