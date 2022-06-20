/*Action to call all classes to active the section modal*/
const modalSectionContainer = document.querySelector('.modal-section-container');
const modalSectionTriggers = document.querySelectorAll('.modal-section-trigger');

modalSectionTriggers.forEach(trigger => trigger.addEventListener('click', toggleSectionModal))
function toggleSectionModal() {
    modalSectionContainer.classList.toggle('active');
}