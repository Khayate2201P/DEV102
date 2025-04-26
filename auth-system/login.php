<?php
require_once 'config/db.php';
require_once 'includes/header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_or_username = trim($_POST['email_or_username']);
    $password = $_POST['password'];

    if (empty($email_or_username) || empty($password)) {
        $errors[] = "Both fields are required.";
    } else {
        // Fetch user by email or username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$email_or_username, $email_or_username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Correct login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header('Location: dashboard.php');
            exit();
        } else {
            $errors[] = "Incorrect login details.";
        }
    }
}
?>

<div class="auth-form">
    <h2>Login</h2>
    <?php
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
    <form action="" method="post">
        <input type="text" name="email_or_username" placeholder="Email or Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <div class="nav-links">
        <a href="register.php">Create Account</a>
    </div>
</div>
<!-- ... footer ... -->

<?php require_once 'includes/footer.php'; ?>
