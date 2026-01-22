<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$theme = $_SESSION['theme'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

$theme_class = 'bg-light text-dark';
if ($theme == 'dark') {
    $theme_class = 'bg-dark text-white';
} elseif ($theme == 'warm') {
    $theme_class = 'bg-warning text-dark';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="<?php echo $theme_class; ?> vh-100 d-flex flex-column align-items-center justify-content-center">

    <div class="container text-center">
        <h1 class="display-4">Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        
        <div class="card mt-4 p-4 text-dark shadow-sm" style="max-width: 400px; margin: 0 auto;">
            <h5 class="card-title">User Profile</h5>
            <p class="card-text">
                <strong>Email:</strong> <?php echo htmlspecialchars($email); ?> <br>
                <strong>Current Theme:</strong> <?php echo htmlspecialchars($theme); ?>
            </p>
            
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

</body>
</html>