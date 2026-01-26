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
if ($theme == 'dark') $theme_class = 'bg-dark text-white';
if ($theme == 'warm') $theme_class = 'bg-warning text-dark';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="<?php echo $theme_class; ?> d-flex align-items-center justify-content-center vh-100">

    <div class="card p-5 shadow text-center" style="width: 400px;">
        
        <?php if (isset($_SESSION['warning'])): ?>
            <div class="alert alert-warning">
                <strong>Warning:</strong> 
                <?php 
                    echo $_SESSION['warning']; 
                    unset($_SESSION['warning']); 
                ?>
            </div>
        <?php endif; ?>

        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        
        <p class="mt-3">
            <strong>Email:</strong> <?php echo htmlspecialchars($email); ?><br>
            <strong>Current Theme:</strong> <?php echo htmlspecialchars($theme); ?>
        </p>

        <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>

</body>
</html>