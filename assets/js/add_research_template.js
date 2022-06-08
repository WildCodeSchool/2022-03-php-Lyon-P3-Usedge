//-----------------------------------------------------
//Changing the color depending on the selected status
//-----------------------------------------------------

const selectStatusList = document.getElementById('select-status');

selectStatusList.addEventListener('change', function () {
    console.log('Changement détecté');

    const valueSelectStatusList = document.getElementById('select-status').value;

    console.log(valueSelectStatusList);

    selectStatusList.classList.remove('bg-green-dot', 'bg-grey-dot', 'bg-red-dot');

    switch (valueSelectStatusList) {
        case "active":
            selectStatusList.classList.add('bg-green-dot');
            break;
        case "disabled":
            selectStatusList.classList.add('bg-grey-dot');
            break;
        case "dropped":
            selectStatusList.classList.add('bg-red-dot');
            break;
    }
});

