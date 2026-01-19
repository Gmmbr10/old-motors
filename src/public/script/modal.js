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