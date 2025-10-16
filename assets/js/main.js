document.getElementById('toggleEditMode').addEventListener('click', function () {
    const table = document.querySelector('.incident-table');
    table.classList.toggle('edit-mode');

    if (table.classList.contains('edit-mode')) {
        document.querySelectorAll('.incident-table tbody tr').forEach(row => {
        const rowId = row.getAttribute('data-id');
        const editCell = row.querySelector('.edit-cell');

        // Only add if not already injected
        if (!editCell.querySelector('a')) {
            const link = document.createElement('a');
            link.href = `edit-incident.php`;
            link.innerHTML = '<img src="./assets/images/edit-icon.png"/>'; // or your icon
            link.style.textDecoration = 'none';
            editCell.appendChild(link);
        }
        });
    }
});