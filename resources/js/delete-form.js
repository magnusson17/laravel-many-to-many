
const deleteForm = document.querySelectorAll('.delete-form');
deleteForm.forEach(form => {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const confirmation = confirm('eliminare il dato?');
        if (confirmation) e.target.submit();
    })
})
