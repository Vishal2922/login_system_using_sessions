<?php
session_start();

$saved_username = isset($_COOKIE['remember_username']) ? $_COOKIE['remember_username'] : '';
$saved_theme = isset($_COOKIE['user_theme']) ? $_COOKIE['user_theme'] : 'light';

$bg_class = 'bg-light';
if ($saved_theme === 'dark') $bg_class = 'bg-dark text-white';
if ($saved_theme === 'warm') $bg_class = 'bg-warning';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="<?php echo $bg_class; ?> d-flex align-items-center justify-content-center vh-100">

    <div class="card p-4 shadow" style="width: 350px;">
        <h3 class="text-center mb-3 text-dark">Login</h3>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                    echo $_SESSION['error']; 
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <form action="auth.php" method="POST">
            
            <div class="mb-3">
                <label class="form-label text-dark">Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($saved_username); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-dark">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-dark">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label text-dark" for="remember">Remember Me</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

</body>
</html>