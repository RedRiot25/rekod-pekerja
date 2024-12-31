<?php
session_start();
include 'database.php'; // Pastikan untuk menyambung ke pangkalan data

$showModal = false; // Flag untuk kawal paparan modal

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Semak sama ada kata laluan sama dengan pengesahan
    if ($password != $confirm_password) {
        $error = "Kata laluan tidak sepadan.";
    } else {
        // Hash kata laluan untuk keselamatan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Simpan data pengguna dalam pangkalan data
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            // Set flag untuk paparkan modal
            $showModal = true;

            // Jangan redirect lagi, tunggu modal ditutup
        } else {
            $error = "Ralat semasa mendaftar: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Pendaftaran Pengguna</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Nama Pengguna</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Kata Laluan</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Pengesahan Kata Laluan</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-success">Daftar</button>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
    </form>
    <p class="text-center mt-3">Sudah ada akaun? <a href="index.php">Log Masuk</a></p>
</div>

<!-- Modal Pop-up -->
<?php if ($showModal): ?>
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">Pendaftaran Berjaya!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tahniah! Pendaftaran anda telah berjaya. Anda akan diarahkan ke halaman dashboard.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.href = 'index.php';">OK</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
    // Apabila halaman dimuatkan, buka modal jika $showModal bernilai true
    <?php if ($showModal): ?>
        window.onload = function() {
            $('#successModal').modal('show');
        }
    <?php endif; ?>
</script>

</body>
</html>
