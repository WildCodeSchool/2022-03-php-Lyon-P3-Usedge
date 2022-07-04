if (document.getElementById('reasearch-plans')) {

    const researchPlans = document.getElementById('reasearch-plans');
    const researchRequests = document.getElementById('reasearch-requests');
    const requestsList = document.getElementById('requests-list');
    const plansListNone = document.getElementById('plans-list-none');
    const PviewlansAssignedRequest = document.getElementById('view-plans-assigned-request');
    const viewPlansProject = document.getElementById('view-plans-project');
    const viewRequestCoachAssigned = document.getElementById('view-request-coach-assigned');
    const viewRequestsProject = document.getElementById('view-requests-project');
    const requestsProject = document.getElementById('requests-project');
    const requestsCoachAssigned = document.getElementById('requests-coach-assigned');
    const plansProject = document.getElementById('plans-project');
    const plansAssignedRequest = document.getElementById('plans-assigned-request');
    const createRequestButton = document.getElementById('create-request');
    const researchCenterAvailableTemplates = document.getElementById('research-center-available-templates');
    const researchCenterAvailableTemplatesClose = document.getElementById('available-templates-header-close');
    const researchTemplateActiveCardButtons = document.querySelectorAll('.research-template-list-active-card-link-button');
    const researchRequestModals = document.querySelectorAll('.new-research-request-modal');
    const researchRequestModalClose = document.querySelectorAll('.new-research-request-modal-close');

    researchRequests.onchange = function() {
        researchPlans.checked = true;
        if(researchRequests.checked == true && researchPlans.checked == true){
            plansListNone.className = 'share-plans-list';
            requestsList.className = 'share-requests-list';
            PviewlansAssignedRequest.className = 'view-details-none';
            viewPlansProject.className = 'view-details-none' ;
            viewRequestCoachAssigned.className = 'view-details-none';
            viewRequestsProject.className = 'view-details-none';
            requestsProject.className = 'sort-none';
            requestsCoachAssigned.className = 'sort-none';
            plansProject.className = 'sort-none';
            plansAssignedRequest.className = 'sort-none';
            
        } else {
            requestsList.className = 'requests-list-none ';
            plansListNone.className = 'plans-list';
            PviewlansAssignedRequest.className = 'view-details';
            viewPlansProject.className = 'view-details';
            viewRequestCoachAssigned.className = 'view-details';
            viewRequestsProject.className = 'view-details';
            requestsProject.className = 'sort';
            requestsCoachAssigned.className = 'sort';
            plansProject.className = 'sort';
            plansAssignedRequest.className = 'sort';
        }
    } 
    researchPlans.onchange = function() {
        researchRequests.checked = true;
        if(researchRequests.checked == true && researchPlans.checked == true){
            plansListNone.className = 'share-plans-list';
            requestsList.className = 'share-requests-list';
            PviewlansAssignedRequest.className = 'view-details-none';
            viewPlansProject.className = 'view-details-none' ;
            viewRequestCoachAssigned.className = 'view-details-none';
            viewRequestsProject.className = 'view-details-none ';
            requestsProject.className = 'sort-none';
            requestsCoachAssigned.className = 'sort-none';
            plansProject.className = 'sort-none';
            plansAssignedRequest.className = 'sort-none';
        } else {
            requestsList.className = 'requests-list';
            plansListNone.className = 'plans-list-none';
            PviewlansAssignedRequest.className = 'view-details';
            viewPlansProject.className = 'view-details';
            viewRequestCoachAssigned.className = 'view-details';
            viewRequestsProject.className = 'view-details';
            requestsProject.className = 'sort';
            requestsCoachAssigned.className = 'sort';
            plansProject.className = 'sort';
            plansAssignedRequest.className = 'sort';
        } 
    }

    // function used to open the availables templates popup
    createRequestButton.addEventListener('click', () => {
        researchCenterAvailableTemplates.classList.add('research-center-available-templates-display');
    });

    // function used to close the availables templates popup
    researchCenterAvailableTemplatesClose.addEventListener('click', () => {
        researchCenterAvailableTemplates.classList.remove('research-center-available-templates-display');

    });  

    // function used to open and close research request creation modals
    for (let i = 0; i < researchTemplateActiveCardButtons.length; i++) {
        researchTemplateActiveCardButtons[i].addEventListener('click', () => {
            researchRequestModals[i].classList.add('new-research-request-modal-display');
        });
        researchRequestModalClose[i].addEventListener('click', () => {
            researchRequestModals[i].classList.remove('new-research-request-modal-display');
        })
    }
}
