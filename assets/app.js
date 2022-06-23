/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// import main page js
import './js/homePage.js';
import './js/add_research_template.js';

// import modal js
import './js/modals/modal_external_link.js';
import './js/modals/modules/icons_module.js';
import './js/modals/modal_new_research_template.js';
import './js/modals/modal_multiple_choice.js';
import './js/modals/modal_single_choice.js';
import './js/modals/modal_evaluation_scale.js';
import './js/modals/modal_section.js';
import './js/modals/modal_date_picker.js';
import './js/modals/modal_selector';


// start the Stimulus application
import './bootstrap';

require('bootstrap');


