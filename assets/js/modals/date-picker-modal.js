if (document.getElementById('add-date-picker-button')) {
    const addDatePickerModalOpenButton = document.getElementById('add-date-picker-button');
    const addDatePickerModal = document.getElementById('add-date-picker-modal');
    const FullScreenDatePickerModalClose= document.getElementById('full-screen-date-picker-modal-close');
    const body = document.getElementById('body');

    // Function used to open the modal
    addDatePickerModalOpenButton.addEventListener('click', () => {
        addDatePickerModal.classList.add('add-date-picker-modal-display');
        FullScreenDatePickerModalClose.classList.add('full-screen-date-picker-modal-display');
        body.classList.add('hide-body-overflow-date-picker');
        // Function used to close the modal when click outside the modal
        window.onclick = function(event) {
            if (event.target == FullScreenDatePickerModalClose) {
                addDatePickerModal.classList.remove('add-date-picker-modal-display'); 
                FullScreenDatePickerModalClose.classList.remove('full-screen-date-picker-modal-display');
                body.classList.remove('hide-body-overflow-date-picker');
            }
        };
    });
    

    
}