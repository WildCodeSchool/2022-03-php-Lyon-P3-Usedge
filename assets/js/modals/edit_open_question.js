// Function to open and close the checkbox helperText in edit
if (document.getElementById('editAddAHelpertext')) {

    const checkHelpertext = document.getElementById('editAddAHelpertext');
    const newHelperText = document.getElementById('checkbox-helper-text');

    checkHelpertext.addEventListener('click', function() {

        if (checkHelpertext.checked) {
            newHelperText.type = 'text';
        } else {
            newHelperText.type = 'hidden';
        }
        
    });

}