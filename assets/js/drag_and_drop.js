import Sortable from 'sortablejs';

if (document.getElementById('display_form_builder')) {

    const displayFormBuilder = document.getElementById('display_form_builder');
    const singleAnswerContainer = document.getElementById('single_answer_container');
    Sortable.create(displayFormBuilder, {
        handle: '.handle-template-component-draggable'
    });
    
    Sortable.create(singleAnswerContainer, {
        handle: '.single-choice-drag-and-drop'
    });
    
    
}