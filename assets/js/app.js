const plans = document.getElementById('reasearch-plans');
const requests = document.getElementById('reasearch-requests');
const requestsList = document.getElementById('requests-list');
const plansList = document.getElementById('plans-list');
const requestProject = document.getElementById('requests-project');
const requestCoachAssigned = document.getElementById('requests-coach-assigned');
const plansProject = document.getElementById('plans-project');
const plansAssignedRequest = document.getElementById('plans-assigned-request');

if (plans.checked == false && requests.checked == true || requests.checked == false && plans.checked == true) {        
    requests.onchange = function() {
        plans.checked = true;
        if(requests.checked == true){
            plansList.style.display = 'flex';
            requestsList.style.display = 'flex';
            requestsList.style.marginRight = '20px';
            requestProject.style.display = 'none';
            requestCoachAssigned.style.display = 'none';
            plansProject.style.display = 'none';
            plansAssignedRequest.style.display = 'none';
        } else {
            requestsList.style.display = 'none';
            plansList.style.display = 'flex';
            requestProject.style.display = 'block';
            requestCoachAssigned.style.display = 'block';
            plansProject.style.display = 'block';
            plansAssignedRequest.style.display = 'block';
        
        }
    } 
    plans.onchange = function() {
        requests.checked = true;
        if(plans.checked == true){
            plansList.style.display = 'flex';
            requestsList.style.display = 'flex';
            requestsList.style.marginRight = '20px';
            requestProject.style.display = 'none';
            requestCoachAssigned.style.display = 'none';
            plansProject.style.display = 'none';
            plansAssignedRequest.style.display = 'none';
        } else {
            plansList.style.display = 'none';
            requestsList.style.display = 'flex';
            requestProject.style.display = 'block';
            requestCoachAssigned.style.display = 'block';
            plansProject.style.display = 'block';
            plansAssignedRequest.style.display = 'block';
        }
    }
}
 

    


