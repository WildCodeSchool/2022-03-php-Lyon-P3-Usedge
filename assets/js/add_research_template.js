function changeStatusColor(selectStatusList) {
    const valueSelectStatusList = document.getElementById('select-status').value;
    document.getElementById('research-template-status').value = valueSelectStatusList;

    selectStatusList.classList.remove('bg-green-dot', 'bg-grey-dot', 'bg-red-dot');

    switch (valueSelectStatusList) {
    case "active":
        selectStatusList.classList.add('bg-green-dot');
        break;
    case "draft":
        selectStatusList.classList.add('bg-grey-dot');
        break;
    case "dropped":
        selectStatusList.classList.add('bg-red-dot');
        break;
    }
}

if (document.getElementById('select-status')) {
    
    const selectStatusList = document.getElementById('select-status');
    const formBuilder = document.getElementById('form-builder');
    
    //-----------------------------------------------------
    //Changing the color depending on the selected status and add the value of the template in a hidden input
    //-----------------------------------------------------
    
    changeStatusColor(selectStatusList);

    selectStatusList.addEventListener('change', function () {
        changeStatusColor(selectStatusList);
        const form = new FormData(formBuilder);
        fetch('/research-template/' ,{
            method: 'POST',
            body: form
        })
    });


    //-----------------------------------------------------
    //Add and Delete the name attribute for the separator components
    //with open and close all others modals
    //-----------------------------------------------------

    //Deleted the name attribute for the separator with open all others components

    const addSeparatorName = document.getElementById('separator-name');
    const delNamesSeparator = document.getElementsByClassName('del-name-separator');
    const addNamesSeparator = document.getElementsByClassName('add-name-separator');

    // Function used to open the others modals

    for (const delNameSeparator of delNamesSeparator) {
        
        delNameSeparator.addEventListener('click', () => {

            addSeparatorName.setAttribute('name','');

        });

    }

    for (const addNameSeparator of addNamesSeparator) {
        
        addNameSeparator.addEventListener('click', () => {

            addSeparatorName.setAttribute('name','name');

        });

    }
    
    // function used to generate the component's order number in order to send it to the database
    if (document.getElementById('form-builder-save-button')) {
        const formBuilderSaveButton = document.getElementById('form-builder-save-button');

        formBuilderSaveButton.addEventListener('click', () => {
            const componentsOrderNumber = document.getElementsByClassName('component-order-number');
            const componentId = document.getElementsByClassName('research-template-component-id');
            const componentCounter = document.getElementById('components-number-count');
            let orderNumber = 1;
            componentCounter.value = 0;
            for (const component of componentsOrderNumber) {
                component.name += orderNumber;            
                component.value = orderNumber;
                componentCounter.value = orderNumber;
                orderNumber++;
            }
            orderNumber = 1;
            for (const id of componentId) {
                id.name += orderNumber;
                orderNumber++;            
            }
        });
    }
}

