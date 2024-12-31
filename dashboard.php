<?php
include 'database.php';

$sql = "SELECT * FROM maklumat";  // Ambil semua data dari jadual maklumat
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pekerja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .table th, .table td {
            text-align: center;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .btn-sm {
            margin: 0 5px;
        }
        .btn-add {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Dashboard Pekerja</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No KP</th>
                <th>Nama Pekerja</th>
                <th>No Telefon (HP)</th>
                <th>Jantina</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Paparkan setiap baris data
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['no_kp'] . "</td>";
                    echo "<td>" . $row['nama_pekerja'] . "</td>";
                    echo "<td>" . $row['no_hp'] . "</td>";
                    echo "<td>" . $row['jantina'] . "</td>";
                    echo "<td>
                            <a href='update.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Kemaskini</a>
                            <button class='btn btn-danger btn-sm delete-btn' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal' data-id='" . $row['id'] . "'>Padam</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tiada data.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Butang ke halaman add_employee.php -->
    <a href="add_employee.php" class="btn btn-primary btn-add">Tambah Pekerja Baru</a>
    <!-- Butang Log Keluar -->
    <a href="index.php" class="btn btn-primary btn-add">Log Keluar</a>
</div>

<!-- Modal untuk Pengesahan Padam -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Pengesahan Padam</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Adakah anda pasti ingin memadam rekod ini? Tindakan ini tidak boleh dibatalkan.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a id="confirmDeleteButton" href="" class="btn btn-danger">Padam</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Menetapkan ID pekerja yang akan dipadam apabila butang padam ditekan
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const pekerjaId = this.getAttribute('data-id');
            const deleteLink = document.getElementById('confirmDeleteButton');
            deleteLink.setAttribute('href', 'delete.php?id=' + pekerjaId);
        });
    });
</script>

</body>
</html>
