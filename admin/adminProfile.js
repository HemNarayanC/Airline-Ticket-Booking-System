document.addEventListener('DOMContentLoaded', (e) => {
    const editButton = document.querySelector('.edit-btn');
    const saveButton = document.querySelector('.save-btn');

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
});