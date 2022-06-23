//-----------------------------------------------------
//Changing the color depending on the selected status
//-----------------------------------------------------

if (document.getElementById('select-status')) {
    
    const selectStatusList = document.getElementById('select-status');

    selectStatusList.addEventListener('change', function () {

        const valueSelectStatusList = document.getElementById('select-status').value;

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

}