if (document.querySelector('.assign-workshop')) {

    const assignWorkshopLink = document.querySelector('.assign-workshop');
    const availableWorkshopModalCloseButton = document.getElementById('research-plan-available-workshops-modal-close');
    const availableWorkshopModal = document.getElementById('research-plan-available-workshops-modal');
    const workshopSearchbar = document.getElementById('research-plan-available-workshops-searchbar-input');
    const availableWorkshopsCard = document.querySelectorAll('.available-workshops-card');
    const workshopCardTitle = document.querySelectorAll('.available-workshop-name');
    const workshopCardDescription = document.querySelectorAll('.available-workshop-description');
    const availableWorkshopSearchButton = document.getElementById('research-plan-available-workshops-searchbar-button');
    const availableWorkshopSelectButton = document.querySelectorAll('.available-workshop-button');
    const selectedWorkshopNameInput = document.getElementById('selected-workshop-name');
    const selectedWorkshopDescriptionInput = document.getElementById('selected-workshop-description');
    const selectedWorkshopIdInput = document.getElementById('selected-worshop-id');
    const selectedWorkshopBuilder = document.getElementById('research-plan-workshop-selected-content');
    const selectedWorkshopName = document.querySelector('.research-plan-workshop-selected-name');
    const selectedWorkshopDescription = document.querySelector('.research-plan-workshop-selected-description');
    const availableWorkshopIdInput = document.querySelector('.available-workshop-id');

    assignWorkshopLink.addEventListener('click', () => {
        availableWorkshopModal.classList.add('research-plan-available-workshops-display');
    });

    availableWorkshopModalCloseButton.addEventListener('click', () => {
        availableWorkshopModal.classList.remove('research-plan-available-workshops-display');
    })

    // Function used to sort the workshop by searchbar keywords
    availableWorkshopSearchButton.addEventListener('click', () => {
        let search = workshopSearchbar.value.toLowerCase();
        let arraySearch = search.split(' ');
        for (let i = 0; i < availableWorkshopsCard.length; i++) {
            availableWorkshopsCard[i].classList.add('available-workshops-card-disabled');
        }
        arraySearch.forEach(word => {
            for (let i = 0; i < availableWorkshopsCard.length; i++) {
                let workshopName = workshopCardTitle[i].innerHTML.toLowerCase();
                let workshopDescription = workshopCardDescription[i].innerHTML.toLowerCase();
                if (workshopName.includes(word) || workshopDescription.includes(word)) {
                    availableWorkshopsCard[i].classList.remove('available-workshops-card-disabled');
                }
            }
        })
    });

    // Function used to send name + description of the workshop selected to the builder.
    for (let i = 0; i < availableWorkshopSelectButton.length; i++) {
        availableWorkshopSelectButton[i].addEventListener('click', () => {
            assignWorkshopLink.classList.add('assign-workshop-display-none');
            selectedWorkshopBuilder.classList.add('research-plan-workshop-selected-display-flex');
            selectedWorkshopName.innerHTML = workshopCardTitle[i].innerHTML;
            selectedWorkshopDescription.innerHTML = workshopCardDescription[i].innerHTML;
            selectedWorkshopNameInput.value = workshopCardTitle[i].innerHTML;
            selectedWorkshopDescriptionInput.value = workshopCardDescription[i].innerHTML;
            selectedWorkshopIdInput.value = availableWorkshopIdInput.value;
            availableWorkshopModal.classList.remove('research-plan-available-workshops-display');
        });
    }
}