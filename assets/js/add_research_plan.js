if (document.querySelector('.assign-workshop')) {

    const assignWorkshopLink = document.querySelector('.assign-workshop');
    const availableWorkshopModalCloseButton = document.getElementById('research-plan-available-workshops-modal-close');
    const availableWorkshopModal = document.getElementById('research-plan-available-workshops-modal');
    const workshopSearchbar = document.getElementById('research-plan-available-workshops-searchbar-input');
    const availableWorkshopsCard = document.querySelectorAll('.available-workshops-card');
    const workshopCardTitle = document.querySelectorAll('.available-workshop-name');
    const workshopCardDescription = document.querySelectorAll('.available-workshop-description');
    const availableWorkshopButton = document.getElementById('research-plan-available-workshops-searchbar-button');

    assignWorkshopLink.addEventListener('click', () => {
        availableWorkshopModal.classList.add('research-plan-available-workshops-display');
    });

    availableWorkshopModalCloseButton.addEventListener('click', () => {
        availableWorkshopModal.classList.remove('research-plan-available-workshops-display');
    })

    availableWorkshopButton.addEventListener('click', () => {
        let search = workshopSearchbar.value.toLowerCase();
        let arraySearch = search.split(' ');
        for (let i = 0; i < availableWorkshopsCard.length; i++) {
            availableWorkshopsCard[i].style.display = "none";
        }
        arraySearch.forEach(word => {
            for (let i = 0; i < availableWorkshopsCard.length; i++) {
                let workshopName = workshopCardTitle[i].innerHTML.toLowerCase();
                let workshopDescription = workshopCardDescription[i].innerHTML.toLowerCase();
                if (workshopName.includes(word) || workshopDescription.includes(word)) {
                    availableWorkshopsCard[i].style.display = "flex";
                }
            }
        })
    });
}