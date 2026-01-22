function openModal(id)
{
    const element = document.getElementById(id);
    
    element.showModal();
    element.style.display = 'flex';
}

function closeModal(id)
{
    const element = document.getElementById(id);
    
    element.close();
    element.style.display = 'none';
}

function openModalForm(id, formId = null)
{
    const element = document.getElementById(id);
    
    element.showModal();
    element.style.display = 'flex';

    if (formId == null) {
        return;
    }

    const button = element.getElementsByTagName('button')[0];

    button.addEventListener('click', () => {
        const form = document.getElementById(formId);
        form.submit();
    });
}