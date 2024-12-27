document.addEventListener('DOMContentLoaded', (e) => {
    const editButton = document.querySelector('.edit-btn');
    const saveButton = document.querySelector('.save-btn');
    const submitBtn = document.querySelector('.submit-btn');

    editButton.addEventListener('click', (e) => {
        let fields = editButton.closest('.section').querySelectorAll('input');
        fields.forEach(field => {
            if(field.id !== 'admin-id' && field.id !== 'doj'){
                field.removeAttribute('readonly');
            }
        });
        editButton.classList.add('hidden');
        saveButton.classList.remove('hidden');
    });

    saveButton.addEventListener('click', (e) => {
        const fields = saveButton.closest('.section').querySelectorAll('input');
        fields.forEach(field => field.setAttribute('readonly', true));
        saveButton.classList.add('hidden');
        editButton.classList.remove('hidden');
        submitBtn.classList.remove('hidden');
    });
});