<?php
require_once 'config/db.php';
require_once 'includes/header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
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
        // Check if email or username already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$email, $username]);
        if ($stmt->fetch()) {
            $errors[] = "Username or email already taken.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into database
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_password]);

            header('Location: login.php');
            exit();
        }
    }
}
?>

<h2>Register</h2>
<?php
foreach ($errors as $error) {
    echo "<p style='color:red;'>$error</p>";
}
?>
<form action="" method="post">
    <input type="text" name="username" placeholder="Username" value="<?= htmlspecialchars($username ?? '') ?>"><br>
    <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($email ?? '') ?>"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <input type="password" name="confirm_password" placeholder="Confirm Password"><br>
    <button type="submit">Register</button>
</form>

<div class="nav-links">
    <span>Already have an account?</span>
    <a href="login.php">Login here</a>
</div>

<?php require_once 'includes/footer.php'; ?>

