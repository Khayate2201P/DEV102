<?php
ob_start();
require_once 'config/db.php';
require_once 'includes/header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $errors[] = "Both fields are required.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Start session or redirect user
            header('Location: dashboard.php'); // change if needed
            exit();
        } else {
            $errors[] = "Invalid email or password.";
        }
    }
}
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
    max-width: 500px;
    width: 100%;
    background: var(--secondary);
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

h2 {
    color: var(--accent);
    margin-bottom: 1.5rem;
    font-size: 2rem;
    text-align: center;
    position: relative;
}

h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: var(--primary);
}

input {
    width: 100%;
    padding: 1rem;
    margin: 0.5rem 0;
    border: 2px solid #eee;
    border-radius: 6px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 10px rgba(46, 204, 113, 0.2);
}

button {
    background: var(--primary);
    color: var(--secondary);
    padding: 1rem;
    width: 100%;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-transform: uppercase;
    font-weight: bold;
    margin-top: 1rem;
}

button:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
}

p {
    text-align: center;
    margin-top: 1rem;
    font-size: 0.95rem;
}

p a {
    color: var(--primary);
    text-decoration: none;
    font-weight: bold;
}

p a:hover {
    text-decoration: underline;
}

.error {
    color: red;
    margin-bottom: 0.5rem;
    text-align: center;
}
</style>

<section>
    <h2>Login</h2>

    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <form action="" method="post">
        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($email ?? '') ?>">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
    <p><a href="forgot_password.php">Forgot your password?</a></p>

    <p>
        Don't have an account?
        <a href="register.php">Register here</a>
    </p>
</section>

<?php
require_once 'includes/footer.php';
ob_end_flush();
?>
