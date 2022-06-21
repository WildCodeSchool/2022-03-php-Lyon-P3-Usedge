import Sortable from 'sortablejs';

if (document.getElementById('display_form_builder')) {

    const displayFormBuilder = document.getElementById('display_form_builder');
    const handleTemplateComponentDraggable = document.getElementById('handle-template-component-draggable');

    Sortable.create(displayFormBuilder, {
        handle: handleTemplateComponentDraggable,
    });
    
}