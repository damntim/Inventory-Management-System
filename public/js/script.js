function toggleDropdown() {
    document.getElementById("profileDropdown").classList.toggle("show");
}

function toggleEmployeeDropdown() {
    document.getElementById("employeeDropdown").classList.toggle("show");
}


window.onclick = function(event) {
    if (!event.target.matches('.profile-container img') && !event.target.matches('.dropdown-btn')) {
        var profileDropdown = document.getElementById("profileDropdown");
        var employeeDropdown = document.getElementById("employeeDropdown");

        if (profileDropdown.classList.contains('show')) {
            profileDropdown.classList.remove('show');
        }
        if (employeeDropdown.classList.contains('show')) {
            employeeDropdown.classList.remove('show');
        }
    }
}