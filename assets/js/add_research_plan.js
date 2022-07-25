if (document.getElementById('title-section-research-plan')) {

    const titleSection = document.getElementById('title-section-research-plan');
    const inputTitleSectionPlan = document.getElementById('title-section-research-plan');
    const assignWorkshopLink = document.querySelector('.assign-workshop');
    const availableWorkshopModalCloseButton = document.getElementById('research-plan-available-workshops-modal-close');
    const availableWorkshopModal = document.getElementById('research-plan-available-workshops-modal');
    const workshopSearchbar = document.getElementById('research-plan-available-workshops-searchbar-input');
    const availableWorkshopsCard = document.querySelectorAll('.available-workshops-card');
    const workshopCardTitle = document.querySelectorAll('.available-workshop-name');
    const workshopCardDescription = document.querySelectorAll('.available-workshop-description');
    const availableWorkshopSearchButton = document.getElementById('research-plan-available-workshops-searchbar-button');
    const availableWorkshopSelectButton = document.querySelectorAll('.available-workshop-button');
    //const availableWorkshopSelectEditButton = document.querySelectorAll('.available-workshop-edit-button')
    const selectedWorkshopNameInput = document.getElementById('selected-workshop-name');
    const selectedWorkshopDescriptionInput = document.getElementById('selected-workshop-description');
    //const selectedWorkshopBuilder = document.getElementById('research-plan-workshop-selected-content');
    const selectedWorkshopName = document.querySelector('.research-plan-workshop-selected-name');
    const selectedWorkshopDescription = document.querySelector('.research-plan-workshop-selected-description');
    const selectedWorkshopDescritionTextarea = document.getElementById('selected-workshop-description-edit');
    const selectedWorkshopEditIcon = document.getElementById('research-plan-workshop-select-edit-icon');
    const linkViewRequest = document.getElementById('link-view-request');
    const modalInterviewPlanningRequest = document.getElementById('modal-interview-planning-request');
    const interviewPlanningHeaderClose = document.getElementById('interview-planning-header-close');
    

    titleSection.addEventListener('click', function () {
        inputTitleSectionPlan.type = "text";
    });

    const buttonUntitled = document.getElementById('button-untitled');
    inputTitleSectionPlan.addEventListener("keydown", function (event) {
        if (event.key == "Enter") {
            event.preventDefault();
            const valueInput = inputTitleSectionPlan.value;
            buttonUntitled.value = valueInput;
            inputTitleSectionPlan.classList.remove('title-section-research-plan');
            inputTitleSectionPlan.classList.add("newTitleSection");
            event.preventDefault();
        }
    }, true);

    const buttonRemoveTitle = document.getElementById('button-basket');
    buttonRemoveTitle.addEventListener('click', function () {
        inputTitleSectionPlan.value.remove();
    });

    assignWorkshopLink.addEventListener('click', () => {
        availableWorkshopModal.classList.add('research-plan-available-workshops-display');
        modalInterviewPlanningRequest.classList.remove('modal-interview-planning-request-display');
    });

    availableWorkshopModalCloseButton.addEventListener('click', () => {
        availableWorkshopModal.classList.remove('research-plan-available-workshops-display');
        workshopSearchbar.value = '';
        availableWorkshopsCard.forEach(card => {
            card.classList.remove('available-workshops-card-disabled');
        })
    });

    // Function used to capture the enter keytouch and simulate it as a button click.
    workshopSearchbar.addEventListener("keydown", function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
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
            if(document.getElementById('research-plan-workshop-selected-content')) {
                const selectedWorkshopBuilder = document.getElementById('research-plan-workshop-selected-content');
                selectedWorkshopBuilder.classList.add('research-plan-workshop-selected-display-flex');
            }
            selectedWorkshopName.innerHTML = workshopCardTitle[i].innerHTML;
            selectedWorkshopDescription.innerHTML = workshopCardDescription[i].innerHTML;
            selectedWorkshopNameInput.value = workshopCardTitle[i].innerHTML;
            selectedWorkshopDescriptionInput.value = workshopCardDescription[i].innerHTML;
            selectedWorkshopDescritionTextarea.innerHTML = workshopCardDescription[i].innerHTML.replace(/\s+/g, " ");
            availableWorkshopModal.classList.remove('research-plan-available-workshops-display');
        });
    }

    // Function used to open a textarea when the description needs to be edited
    selectedWorkshopEditIcon.addEventListener('click', () => {
        availableWorkshopModal.classList.add('research-plan-available-workshops-display');
        modalInterviewPlanningRequest.classList.remove('modal-interview-planning-request-display');
    });

    // Function used to close the textarea and modify the description.
    selectedWorkshopDescritionTextarea.addEventListener("keydown", function (event) {
        if (event.key == "Enter") {
            event.preventDefault();
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
        setTimeout(function () {
            selectedWorkshopDescritionTextarea.style.cssText = 'height:' + selectedWorkshopDescritionTextarea.scrollHeight + 'px';
        });
    });

    // Function used to open the modal interview planning request
    linkViewRequest.addEventListener('click', () => {
        modalInterviewPlanningRequest.classList.toggle('modal-interview-planning-request-display');
        availableWorkshopModal.classList.remove('research-plan-available-workshops-display');
    });

    // Function used to close the modal interview planning request
    interviewPlanningHeaderClose.addEventListener('click', () => {
        modalInterviewPlanningRequest.classList.remove('modal-interview-planning-request-display');
    });

    //function use to send an alert before validate the form
    if (document.querySelector('.send-research-plan-validation')) {
        const sendResearchPlanValidation = document.querySelector('.send-research-plan-validation');
        sendResearchPlanValidation.addEventListener('click', (event) => {
            let comfirm = confirm('this plan will be sent, check that all fields are filled in, otherwise the last section will not be saved');
            if (comfirm == false) {
                event.preventDefault();
            }

        })
    }
}
