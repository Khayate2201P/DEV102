<?php
require_once 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
<p>This is your dashboard. Only logged-in users can see this.</p>
<a href="logout.php">Logout</a>
<!-- ... existing PHP code ... -->
<div class="dashboard">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>! 🎉</h2>
    <p>This is your secure dashboard. Only authenticated users can access this content.</p>
    <div class="nav-links">
        <a href="logout.php">Logout</a>
    </div>
</div>
<!-- ... footer ... --> 

<?php require_once 'includes/footer.php'; ?>
