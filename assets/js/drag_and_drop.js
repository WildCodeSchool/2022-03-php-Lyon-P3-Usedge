import Sortable from 'sortablejs';

if (document.getElementById('display_form_builder')) {

    const displayFormBuilder = document.getElementById('display_form_builder');

    Sortable.create(displayFormBuilder, {
        handle: '.handle-template-component-draggable'
    });
    
}