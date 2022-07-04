if (document.getElementById('add-research-request-header')) {

    const bodyWithSideBar = document.querySelector('body');
    const newResearchRequestHeaderButton = document.getElementById('add-research-request-header-button');
    const newResearchRequestFormButton = document.getElementById('add-research-request-form-button');

    bodyWithSideBar.classList.remove('body');
    bodyWithSideBar.classList.add('body-without-sidebar');

    if (document.getElementById('research-open-question-text-area')) {
        const textareas = document.querySelectorAll('.research-open-question-text-area');
        
        textareas.forEach(textarea => {
            textarea.addEventListener('keydown', autosize);
             
            function autosize(){
                var el = this;
                setTimeout(function() {
                    el.style.cssText = 'height:' + el.scrollHeight + 'px';
                },0);
            }
        });
    }

    newResearchRequestHeaderButton.addEventListener('click', () => {
        const statusInput = document.getElementById('research-request-status');
        statusInput.value = 'draft';
    });

    newResearchRequestFormButton.addEventListener('click', () => {
        const statusInput = document.getElementById('research-request-status');
        statusInput.value = 'waiting list';
    });
}