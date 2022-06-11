/*Action to call all classes to active the modal*/
const modalSectionContainer = document.querySelector('.modal-section-container');
const modalSectionTriggers = document.querySelectorAll('.modal-section-trigger');

modalSectionTriggers.forEach(trigger => trigger.addEventListener('click', toggleSectionModal))
function toggleSectionModal() {
    modalSectionContainer.classList.toggle('active')
};

/*Action to send the title in the modal to the div form_builder */
const buttonActionComponentSection = document.getElementById('button-action-component-section');
buttonActionComponentSection.addEventListener('click', function() {
    const inputModalSection = document.getElementById('input-modal-section').value;
    const displayFormBuilder = document.getElementById('display_form_builder');
    displayFormBuilder.innerHTML = displayFormBuilder.innerHTML + "<input type='hidden' name='input-modal-section' value=" + inputModalSection + ">" + inputModalSection + "</br>";
    document.getElementById('input-modal-section').value = ''; 
});