if (document.getElementById('new-research-request-modal-close')) {

    const researchRequestModalClose = document.getElementById('new-research-request-modal-close');
    const researchRequestModal = document.getElementById('new-research-request-modal');

    researchRequestModalClose.addEventListener('click', () => {
        researchRequestModal.classList.add('new-research-request-modal-display');
    })
}