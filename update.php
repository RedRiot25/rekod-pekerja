<?php
include 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Dapatkan maklumat pekerja berdasarkan ID
    $sql = "SELECT * FROM maklumat WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_kp = $_POST['no_kp'];
    $nama_pekerja = $_POST['nama_pekerja'];
    $no_hp = $_POST['no_hp'];
    $jantina = $_POST['jantina'];

    // Kemaskini rekod pekerja
    $sql = "UPDATE maklumat SET no_kp = '$no_kp', nama_pekerja = '$nama_pekerja', no_hp = '$no_hp', jantina = '$jantina' WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        // Tunjukkan modal selepas kemaskini berjaya
        echo "<script type='text/javascript'>
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
              </script>";
        header('Location: dashboard.php');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Ralat: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kemaskini Pekerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-secondary {
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Kemaskini Pekerja</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="no_kp" class="form-label">IC</label>
            <input type="text" class="form-control" id="no_kp" name="no_kp" value="<?php echo $row['no_kp']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama_pekerja" class="form-label">Nama Pekerja</label>
            <input type="text" class="form-control" id="nama_pekerja" name="nama_pekerja" value="<?php echo $row['nama_pekerja']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No Telefon (HP)</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $row['no_hp']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="jantina" class="form-label">Jantina</label>
            <select class="form-select" id="jantina" name="jantina" required>
                <option value="Lelaki" <?php echo ($row['jantina'] == 'Lelaki') ? 'selected' : ''; ?>>Lelaki</option>
                <option value="Perempuan" <?php echo ($row['jantina'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
            </select>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success">Kemaskini</button>
        </div>
    </form>
    <br>
    <div class="d-grid gap-2">
        <!-- Butang kembali ke dashboard -->
        <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</div>

<!-- Modal untuk kemaskini berjaya -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Kemaskini Berjaya</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Rekod berjaya dikemaskini!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='dashboard.php';">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
