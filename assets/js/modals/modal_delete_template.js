const buttonDeleteTemplates = document.getElementsByClassName("action_modal");
const actionsMenuContainerArchives = document.getElementsByClassName("modal_delete_template");
const fullScreenActionMenuContainerModalCloseArchives =
    document.getElementsByClassName("no_keep_the_template");

for (const buttonDeleteTemplate of buttonDeleteTemplates) {
    for (const actionsMenuContainerArchive of actionsMenuContainerArchives) {
        buttonDeleteTemplate.addEventListener("click", function () {
            actionsMenuContainerArchive.classList.add(
                "actions-menu-container-flex_archive"
            );
        });
        for (const fullScreenActionMenuContainerModalCloseArchive of fullScreenActionMenuContainerModalCloseArchives) {
            fullScreenActionMenuContainerModalCloseArchive.addEventListener("click", function () {
                actionsMenuContainerArchive.classList.remove("actions-menu-container-flex_archive");
            });
        }
    }
}