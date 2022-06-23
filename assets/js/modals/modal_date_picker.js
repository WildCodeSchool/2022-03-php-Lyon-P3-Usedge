if (document.getElementById('add-date-picker-button')) {
    const addDatePickerModalOpenButton = document.getElementById('add-date-picker-button');
    const addDatePickerModal = document.getElementById('add-date-picker-modal');
    const datePickerDraggableHandle = document.getElementById('date-picker-draggable-handle');
    const FullScreenDatePickerModalClose= document.getElementById('full-screen-date-picker-modal-close');
    const datePickerModalCloseButton = document.getElementById('date-picker-modal-close');
    const inputDatePickerTitle = document.getElementById('input-date-picker-title');
    const inputMandatoryDatePicker = document.getElementById('input-mandatory-date-picker');
    const adddatePickerName = document.getElementById('date-picker-name');
    const body = document.getElementById('body');
    const draggable = require('draggable');
    const draggableOptions = {handle: datePickerDraggableHandle}

    // Function used to open the modal
    addDatePickerModalOpenButton.addEventListener('click', () => {
        FullScreenDatePickerModalClose.classList.add('full-screen-date-picker-modal-display');
        body.classList.add('hide-body-overflow-date-picker');
        adddatePickerName.setAttribute('name','name');
        new draggable(addDatePickerModal, draggableOptions);
        // Function used to close the modal when click outside of the modal
        window.onclick = function(event) {
            if (event.target == FullScreenDatePickerModalClose) {
                FullScreenDatePickerModalClose.classList.remove('full-screen-date-picker-modal-display');
                body.classList.remove('hide-body-overflow-date-picker');
                adddatePickerName.setAttribute('name','');
            }
        };
    });

    // Function used to close the modal when click on close button and initialise values
    datePickerModalCloseButton.addEventListener('click', () => {
        inputDatePickerTitle.value = '';
        FullScreenDatePickerModalClose.classList.remove('full-screen-date-picker-modal-display');
        body.classList.remove('hide-body-overflow-date-picker');
        adddatePickerName.setAttribute('name','');
        inputMandatoryDatePicker.checked = false;
    });
    

    
}