<?php
ob_start();
require_once 'includes/header.php';

// session_start(); // فعلها إذا كنت خدام بالجلسات
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit();
// }
?>

<style>
:root {
    --primary: #2ecc71;
    --secondary: #ffffff;
    --accent: #2c3e50;
}

body {
    background: var(--secondary);
    font-family: 'Segoe UI', sans-serif;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2rem;
}

main {
    background: var(--secondary);
    max-width: 600px;
    width: 100%;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    text-align: center;
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

h1 {
    color: var(--accent);
    font-size: 2.2rem;
    margin-bottom: 1rem;
}

p {
    color: #555;
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

nav {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

a {
    display: block;
    background: var(--primary);
    color: var(--secondary);
    text-decoration: none;
    font-weight: bold;
    padding: 0.8rem 1.2rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

a:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(46, 204, 113, 0.3);
}

@media (max-width: 500px) {
    nav {
        gap: 0.75rem;
    }
}
</style>

<main>
    <h1>Welcome, User!</h1>
    <p>Select one of the options below:</p>

    <nav>
        <a href="edit_profile.php">Edit Profile</a>
        <a href="change_password.php">Change Password</a>
        <a href="my_data.php">View My Data</a>
        <a href="logout.php">Logout</a>
    </nav>
</main>

<?php
require_once 'includes/footer.php';
ob_end_flush();
?>
