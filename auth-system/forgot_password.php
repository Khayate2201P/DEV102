<?php
ob_start();
require_once 'includes/header.php';

// إذا ضغط المستخدم على إرسال:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $message = "Please enter your email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address.";
    } else {
        // هنا يمكن تضيف التحقق من وجود الإيميل فـ قاعدة البيانات
        // وإرسال رابط الاسترجاع، لكن هنا نحتافضو بنسخة بسيطة

        $message = "If this email exists in our system, a reset link will be sent.";
    }
}
?>

<style>
body {
    background: #ffffff;
    font-family: 'Segoe UI', sans-serif;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

form {
    max-width: 400px;
    width: 100%;
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h2 {
    color: #2c3e50;
    margin-bottom: 1.5rem;
}

input[type="email"] {
    width: 100%;
    padding: 1rem;
    margin-bottom: 1rem;
    border: 2px solid #eee;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 1rem;
    background: #2ecc71;
    color: white;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background: #27ae60;
}

p {
    margin-top: 1rem;
    color: #555;
}
</style>

<form method="post">
    <h2>Forgot Password</h2>

    <?php if (!empty($message)): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <input type="email" name="email" placeholder="Enter your email" required>
    <button type="submit">Send Reset Link</button>

    <a href="login.php" style="
    display: inline-block;
    margin-top: 1.5rem;
    padding: 0.6rem 1.2rem;
    background: #2c3e50;
    color: white;
    text-decoration: none;
    font-weight: bold;
    border-radius: 6px;
    transition: background 0.3s ease, transform 0.2s ease;
">
    &larr; Back to Login
</a>

</form>

<?php
require_once 'includes/footer.php';
ob_end_flush();
?>
