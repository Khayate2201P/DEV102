<?php
ob_start();
require_once 'config/db.php';
require_once 'includes/header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$email, $username]);

        if ($stmt->fetch()) {
            $errors[] = "Username or email already exists.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_password]);

            header('Location: login.php');
            exit();
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
    <h2>Register</h2>

    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <form action="" method="post">
        <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($username ?? '') ?>">
        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($email ?? '') ?>">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm_password" placeholder="Confirm Password">
        <button type="submit">Register</button>
    </form>
    <div style="margin-top: 2rem; text-align: center;">
    <p style="margin-bottom: 1rem; color: #555;">Or register with:</p>
    
    <a href="#" style="display: inline-block; margin: 0 0.5rem; padding: 0.6rem 1.2rem;
        background: #db4437; color: white; border-radius: 6px; text-decoration: none; font-weight: bold;">
        Google
    </a>
    
    <a href="#" style="display: inline-block; margin: 0 0.5rem; padding: 0.6rem 1.2rem;
        background: #3b5998; color: white; border-radius: 6px; text-decoration: none; font-weight: bold;">
        Facebook
    </a>
    
    <a href="#" style="display: inline-block; margin: 0 0.5rem; padding: 0.6rem 1.2rem;
        background: #24292e; color: white; border-radius: 6px; text-decoration: none; font-weight: bold;">
        GitHub
    </a>
</div>

    <p>
        Already have an account?
        <a href="login.php">Login here</a>
    </p>
</section>

<?php
require_once 'includes/footer.php';
ob_end_flush();
?>
