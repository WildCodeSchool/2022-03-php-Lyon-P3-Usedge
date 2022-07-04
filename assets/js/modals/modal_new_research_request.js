if (document.getElementById('new-research-request-modal-close')) {

    const researchRequestModalClose = document.getElementById('new-research-request-modal-close');
    const researchRequestModal = document.getElementById('new-research-request-modal');

    researchRequestModalClose.addEventListener('click', () => {
        researchRequestModal.classList.remove('new-research-request-modal-display');
    })
}