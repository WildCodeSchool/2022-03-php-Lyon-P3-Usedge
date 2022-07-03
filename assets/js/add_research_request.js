if (document.getElementById('add-research-request-header')) {

    const bodyWithSideBar = document.querySelector('body');

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
}