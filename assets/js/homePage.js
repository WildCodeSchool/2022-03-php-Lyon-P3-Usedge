const plans = document.getElementById('reasearch-plans');
const requests = document.getElementById('reasearch-requests');
const requestsList = document.getElementById('requests-list');
const plansList = document.getElementById('plans-list');
const sortByChoice = document.getElementsByClassName('sort-by-choice');
const viewChoice = document.getElementsByClassName('view-choice');


if (plans.checked == false && requests.checked == true || requests.checked == false && plans.checked == true) {        
    requests.onchange = function() {
        plans.checked = true;
        if(requests.checked == true){
            plansList.style.display = 'flex';
            requestsList.style.display = 'flex';
            requestsList.style.width = '49%';
            plansList.style.width = '49%';
            for (let i = 0; i < sortByChoice.length; i++) {
                const element = sortByChoice[i];
                element.style.display = 'none';
            }
            for (let i = 0; i < viewChoice.length; i++) {
                const element = viewChoice[i];
                element.style.display = 'none';
            }
        } else {
            requestsList.style.display = 'none';
            plansList.style.display = 'flex';
            for (let i = 0; i < sortByChoice.length; i++) {
                const element = sortByChoice[i];
                element.style.display = 'block'; 
            }
            for (let i = 0; i < viewChoice.length; i++) {
                const element = viewChoice[i];
                element.style.display = 'flex';
            }
            requestsList.style.width = '100%';
            plansList.style.width = '100%';
        
        }
    } 
    plans.onchange = function() {
        requests.checked = true;
        if(plans.checked == true){
            plansList.style.display = 'flex';
            requestsList.style.display = 'flex';
            requestsList.style.width = '49%';
            plansList.style.width = '49%';
            for (let i = 0; i < sortByChoice.length; i++) {
                const element = sortByChoice[i];
                element.style.display = 'none';
            }
            for (let i = 0; i < viewChoice.length; i++) {
                const element = viewChoice[i];
                element.style.display = 'none';
            }
        } else {
            plansList.style.display = 'none';
            requestsList.style.display = 'flex';
            for (let i = 0; i < sortByChoice.length; i++) {
                const element = sortByChoice[i];
                element.style.display = 'block'; 
            }
            for (let i = 0; i < viewChoice.length; i++) {
                const element = viewChoice[i];
                element.style.display = 'flex';
            }
            requestsList.style.width = '100%';
            plansList.style.width = '100%';
        }
    }
}
 

    


