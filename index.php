<?php
session_start();
include 'database.php'; // Pastikan menyambung ke pangkalan data

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Semak jika nama pengguna wujud dalam pangkalan data
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Semak kata laluan yang dimasukkan dengan hash dalam pangkalan data
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header('Location: dashboard.php'); // Arahkan ke dashboard jika log masuk berjaya
            exit;
        } else {
            $error = "Kata laluan salah.";
        }
    } else {
        $error = "Nama pengguna tidak wujud.";
    }
}
?>

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Masuk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Log Masuk</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Nama Pengguna</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Kata Laluan</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Log Masuk</button>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
    </form>
    <p class="text-center mt-3">Tiada akaun? <a href="register.php">Daftar di sini</a></p>
</div>
</body>
</html>
