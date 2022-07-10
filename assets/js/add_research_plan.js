if (document.getElementById('title-section-research-plan')) {

    const titleSection = document.getElementById('title-section-research-plan');
    const inputTitleSectionPlan = document.getElementById('title-section-research-plan');

    titleSection.addEventListener('click', function() {
        inputTitleSectionPlan.type = "text";
    });

    const buttonUntitled = document.getElementById('button-untitled');
    window.addEventListener("keydown", function(event) {
        if (event.key == "Enter") {
            const valueInput = inputTitleSectionPlan.value;
            buttonUntitled.value = valueInput;
            inputTitleSectionPlan.classList.remove('title-section-research-plan');
            inputTitleSectionPlan.classList.add("newTitleSection");
            event.preventDefault();
        }
    }, true);

    const buttonRemoveTitle = document.getElementById('button-basket');
    buttonRemoveTitle.addEventListener('click', function() {
        inputTitleSectionPlan.value.remove();
    });

}
