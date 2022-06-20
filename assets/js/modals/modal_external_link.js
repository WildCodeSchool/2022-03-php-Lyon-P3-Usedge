/*Action to call all classes to active the section modal*/
const modalExternalLinkContainer = document.querySelector('.modal-external-link-container');
const modalExternalLinkTriggers = document.querySelectorAll('.modal-external-link-trigger');

modalExternalLinkTriggers.forEach(trigger => trigger.addEventListener('click', toggleExternalLinkModal))
function toggleExternalLinkModal() {
    modalExternalLinkContainer.classList.toggle('active');
}