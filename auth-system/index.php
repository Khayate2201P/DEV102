<?php
ob_start();
require_once 'includes/header.php';
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

section {
    background: var(--secondary);
    max-width: 600px;
    width: 100%;
    padding: 2.5rem;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    text-align: center;
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-15px); }
    to { opacity: 1; transform: translateY(0); }
}

h1 {
    color: var(--accent);
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

p {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

a {
    display: inline-block;
    margin: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: var(--primary);
    color: var(--secondary);
    text-decoration: none;
    font-weight: bold;
    border-radius: 8px;
    transition: all 0.3s ease;
}

a:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(46, 204, 113, 0.3);
}
</style>

<section>
    <h1>Welcome to Our Website</h1>
    <p>Join us now or sign in to access your dashboard.</p>

    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
</section>

<?php
require_once 'includes/footer.php';
ob_end_flush();
?>
