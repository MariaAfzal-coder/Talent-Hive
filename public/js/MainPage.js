function openForm(role) {
    switch (role) {
        case 'incharge':
            window.location.href = 'Login/login_incharge.html'; // Redirect to the Incharge login form
            break;
        case 'company':
            window.location.href = 'Login/login_companies.html'; // Redirect to the Company login form
            break;
        case 'supervisor':
            window.location.href = 'Login/login_supervisor.html'; // Redirect to the Supervisor login form
            break;
        case 'students':
            window.location.href = 'Login/login_student.html'; // Redirect to the Students login form
            break;
        default:
            console.error('Role not found');
            break;
    }
}
