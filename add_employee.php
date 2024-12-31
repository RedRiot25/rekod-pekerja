<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_kp = $_POST['no_kp'];
    $nama_pekerja = $_POST['nama_pekerja'];
    $no_hp = $_POST['no_hp'];
    $jantina = $_POST['jantina'];

    $sql = "INSERT INTO maklumat (no_kp, nama_pekerja, no_hp, jantina) VALUES ('$no_kp', '$nama_pekerja', '$no_hp', '$jantina')";
    
    if ($conn->query($sql) === TRUE) {
        // Jika berjaya, set status berjaya
        $status = 'success';
        $message = 'Rekod pekerja berjaya ditambah!';
    } else {
        // Jika gagal, set status gagal
        $status = 'danger';
        $message = 'Ralat: ' . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pekerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }
        .btn-success {
            font-size: 16px;
            padding: 12px 20px;
        }
        .btn-secondary {
            font-size: 16px;
            padding: 12px 20px;
        }
        .form-label {
            font-weight: bold;
            color: #2c3e50;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .d-grid gap-2 {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Pekerja Baru</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="no_kp" class="form-label">IC</label>
            <input type="text" class="form-control" id="no_kp" name="no_kp" required>
        </div>
        <div class="mb-3">
            <label for="nama_pekerja" class="form-label">Nama Pekerja</label>
            <input type="text" class="form-control" id="nama_pekerja" name="nama_pekerja" required>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No Telefon (HP)</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
        </div>
        <div class="mb-3">
            <label for="jantina" class="form-label">Jantina</label>
            <select class="form-select" id="jantina" name="jantina" required>
                <option value="Lelaki">Lelaki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success">Tambah Pekerja</button>
            <!-- Butang kembali ke Dashboard -->
            <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>
    </form>
</div>

<!-- Modal untuk Mesej Kejayaan atau Kegagalan -->
<?php if (isset($status)): ?>
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModalLabel">Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-<?php echo $status; ?>" role="alert">
          <?php echo $message; ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <a href="dashboard.php" class="btn btn-primary">Ke Dashboard</a>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Untuk membuka modal setelah memuatkan halaman
    <?php if (isset($status)): ?>
        var myModal = new bootstrap.Modal(document.getElementById('messageModal'));
        myModal.show();
    <?php endif; ?>
</script>

</body>
</html>
