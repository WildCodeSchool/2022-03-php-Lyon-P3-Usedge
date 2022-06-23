import {iconList} from './modules/icons_module';

if (document.getElementById('add-template-button')) {

    // Careful : for first const, check real button id when integration !
    const addTemplateModalOpenButton = document.getElementById('add-template-button');
    const addTemplateModal = document.getElementById('template-details-modal');
    const addTemplateModalCloseButton = document.getElementById('template-details-close');
    const iconPopupOpenButton = document.getElementById('icon-choice-button');
    const iconPopup = document.querySelector('.modal-icon-select-popup-hidden');
    const iconPopupCloseButton = document.getElementById('template-icon-close');
    const submitButton = document.querySelector('.new-template-button');
    const modalTextInputs = document.querySelectorAll('.modal-input');
    const templateNameInput = document.getElementById('research_template_name');
    const templateDescriptionInput = document.getElementById('research_template_description');
    const templatecoachSelect = document.getElementById('research_template_coach');
    const iconChoicePicture = document.getElementById('icon-choice-picture');

    // Function used to open the modal
    addTemplateModalOpenButton.addEventListener('click', () => {
        addTemplateModal.classList.add('template-details-modal-display');
    });

    // Function used to close the modal and initialise values
    addTemplateModalCloseButton.addEventListener('click', () => {
        iconChoicePicture.src = new URL('../../images/icons/template_icon_plus.png', import.meta.url);
        templateNameInput.value = '';
        templateDescriptionInput.value = '';
        templatecoachSelect.value = '';
        addTemplateModal.classList.remove('template-details-modal-display');
        iconPopup.classList.remove('modal-icon-select-popup');
        for (let iconNumber = 0; iconNumber < 6; iconNumber++) {
            let iconSubmitButton = document.getElementById(`research_template_icon_${iconNumber}`);
            iconSubmitButton.checked = false;
        }
    });

    // Function used to open the icon pop-up
    iconPopupOpenButton.addEventListener('click', () => {
        iconPopup.classList.toggle('modal-icon-select-popup');
    });

    // Function used to close the icon pop-up
    iconPopupCloseButton.addEventListener('click', () => {
        iconPopup.classList.remove('modal-icon-select-popup');
    });

    // Function used to change icon display when selected in the list
    for (let iconNumber = 0; iconNumber < 6; iconNumber++) {
        let iconSubmitButton = document.getElementById(`research_template_icon_${iconNumber}`);
        iconSubmitButton.addEventListener('click', () => {
            iconChoicePicture.src = iconList[iconNumber];
            iconPopup.classList.remove('modal-icon-select-popup');
        })
    }

    // Function used to check some front validations before form submission
    submitButton.addEventListener('click', (event) => {
        let count = 0;
        for (let iconNumber = 0; iconNumber < 6; iconNumber++) {
            let iconSubmitButton = document.getElementById(`research_template_icon_${iconNumber}`)
            if (iconSubmitButton.checked == true) {
                break;
            } else if (iconSubmitButton.checked == false && count == 5) {
                alert('Please select an icon in the list.');
            }
            count += 1;
        }
        for (const modalTextInput of modalTextInputs) {
            if (modalTextInput.value.length > 255) {
                alert('Maximum length is 255 characters.');
                event.preventDefault();
            }
        }
    });

}