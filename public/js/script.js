// Function to toggle sidebar
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    // Toggle the "open" class to show/hide the sidebar
    sidebar.classList.toggle('open');
    overlay.classList.toggle('show');
}

// Function to close sidebar when clicking outside of it
function closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.remove('open');
    overlay.classList.remove('show');
}
