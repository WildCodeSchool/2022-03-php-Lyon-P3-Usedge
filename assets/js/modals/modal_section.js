/*Action to call all classes to active the section modal*/
const modalSectionContainer = document.querySelector('.modal-section-container');
const modalSectionTriggers = document.querySelectorAll('.modal-section-trigger');
const sectionDraggableHandle = document.getElementById('section-draggable-handle');
const draggable = require('draggable');
const draggableOptions = {handle:sectionDraggableHandle}

modalSectionTriggers.forEach(trigger => trigger.addEventListener('click', toggleSectionModal))
function toggleSectionModal() {
    modalSectionContainer.classList.toggle('active');
    new draggable(modalSectionContainer, draggableOptions);
}