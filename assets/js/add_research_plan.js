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
    const selectedWorkshopDescritionTextarea = document.getElementById('selected-workshop-description-edit');
    const selectedWorkshopEditIcon = document.getElementById('research-plan-workshop-select-edit-icon');


    assignWorkshopLink.addEventListener('click', () => {
        availableWorkshopModal.classList.add('research-plan-available-workshops-display');
    });

    availableWorkshopModalCloseButton.addEventListener('click', () => {
        availableWorkshopModal.classList.remove('research-plan-available-workshops-display');
        workshopSearchbar.value = '';
        availableWorkshopsCard.forEach(card => {
            card.classList.remove('available-workshops-card-disabled');
        })
    });

    // Function used to capture the enter keytouch and simulate it as a button click.
    workshopSearchbar.addEventListener("keyup", function(e) {
        if (e.code === 'Enter') {
            availableWorkshopSearchButton.click();
        }
    });

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
            selectedWorkshopDescritionTextarea.innerHTML = workshopCardDescription[i].innerHTML.replace(/\s+/g, " ");
            availableWorkshopModal.classList.remove('research-plan-available-workshops-display');
        });
    }

    // Function used to open a textarea when the description needs to be edited
    selectedWorkshopEditIcon.addEventListener('click', () => {
        selectedWorkshopEditIcon.classList.add('research-plan-workshop-select-edit-icon-display-none');
        selectedWorkshopDescription.classList.add('research-plan-workshop-selected-description-display-none');
        selectedWorkshopDescritionTextarea.classList.add('selected-workshop-description-edit-display-block');
    });

    // Function used to close the textarea and modify the description.
    window.addEventListener("keydown", function(event) {
        if (event.key == "Enter") {
            selectedWorkshopDescriptionInput.value = selectedWorkshopDescritionTextarea.value;
            selectedWorkshopDescription.innerHTML = selectedWorkshopDescritionTextarea.value;
            selectedWorkshopEditIcon.classList.remove('research-plan-workshop-select-edit-icon-display-none');
            selectedWorkshopDescription.classList.remove('research-plan-workshop-selected-description-display-none');
            selectedWorkshopDescritionTextarea.classList.remove('selected-workshop-description-edit-display-block');    
        } else if (event.key == "Escape") {
            selectedWorkshopDescritionTextarea.value = selectedWorkshopDescription.innerHTML.replace(/\s+/g, " ");
            selectedWorkshopEditIcon.classList.remove('research-plan-workshop-select-edit-icon-display-none');
            selectedWorkshopDescription.classList.remove('research-plan-workshop-selected-description-display-none');
            selectedWorkshopDescritionTextarea.classList.remove('selected-workshop-description-edit-display-block');
        }
    }, true);

    // Function used to resize auto the height of the textarea.
    selectedWorkshopDescritionTextarea.addEventListener('keydown', () => {
        setTimeout(function() {
            selectedWorkshopDescritionTextarea.style.cssText = 'height:' + selectedWorkshopDescritionTextarea.scrollHeight + 'px';
        });
    });

}
