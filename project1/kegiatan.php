<?php
include 'config/database.php';

// Tambah data kegiatan
if (isset($_POST['tambah'])) {
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $tempat = $_POST['tempat'];
    $deskripsi = $_POST['deskripsi'];
    $jenis_kegiatan_id = $_POST['jenis_kegiatan_id'];

    mysqli_query($conn, "INSERT INTO kegiatan (tanggal_mulai, tanggal_selesai, tempat, deskripsi, jenis_kegiatan_id)
                         VALUES ('$tanggal_mulai', '$tanggal_selesai', '$tempat', '$deskripsi', '$jenis_kegiatan_id')");
}

// Update data kegiatan
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $tempat = $_POST['tempat'];
    $deskripsi = $_POST['deskripsi'];
    $jenis_kegiatan_id = $_POST['jenis_kegiatan_id'];

    mysqli_query($conn, "UPDATE kegiatan SET tanggal_mulai='$tanggal_mulai', tanggal_selesai='$tanggal_selesai', tempat='$tempat', deskripsi='$deskripsi', jenis_kegiatan_id='$jenis_kegiatan_id' WHERE id=$id");
    header("Location: kegiatan.php");
}

// Ambil data untuk edit
$edit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM kegiatan WHERE id=$id");
    $edit = mysqli_fetch_assoc($result);
}

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM kegiatan WHERE id=$id");
    header("Location: kegiatan.php");
}

// Ambil data kegiatan dan jenis_kegiatan
$data = mysqli_query($conn, "SELECT kegiatan.*, jenis_kegiatan.nama AS jenis_nama FROM kegiatan 
                             LEFT JOIN jenis_kegiatan ON kegiatan.jenis_kegiatan_id = jenis_kegiatan.id");

// Ambil data jenis kegiatan untuk form
$jenis = mysqli_query($conn, "SELECT * FROM jenis_kegiatan");
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div id="layoutSidenav_content">
<div class="container-fluid px-4">
    <h2 class="mt-4">Data Kegiatan</h2>

    <!-- Form tambah/edit kegiatan -->
    <div class="card mb-4">
        <div class="card-header">
            <form method="POST" class="row g-2 align-items-center">
                <?php if ($edit): ?>
                    <input type="hidden" name="id" value="<?= $edit['id'] ?>">
                <?php endif; ?>
                <div class="col">
                    <input type="date" name="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" required value="<?= $edit ? htmlspecialchars($edit['tanggal_mulai']) : '' ?>">
                </div>
                <div class="col">
                    <input type="date" name="tanggal_selesai" class="form-control" placeholder="Tanggal Selesai" required value="<?= $edit ? htmlspecialchars($edit['tanggal_selesai']) : '' ?>">
                </div>
                <div class="col">
                    <input type="text" name="tempat" class="form-control" placeholder="Tempat" required value="<?= $edit ? htmlspecialchars($edit['tempat']) : '' ?>">
                </div>
                <div class="col">
                    <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" required><?= $edit ? htmlspecialchars($edit['deskripsi']) : '' ?></textarea>
                </div>
                <div class="col">
                    <select name="jenis_kegiatan_id" class="form-select" required>
                        <option value="">Pilih Jenis Kegiatan</option>
                        <?php mysqli_data_seek($jenis, 0); while ($j = mysqli_fetch_assoc($jenis)) { ?>
                            <option value="<?= $j['id'] ?>" <?= $edit && $edit['jenis_kegiatan_id'] == $j['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($j['nama']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-auto">
                    <?php if ($edit): ?>
                        <button name="update" class="btn btn-success">Update</button>
                        <a href="kegiatan.php" class="btn btn-secondary">Batal</a>
                    <?php else: ?>
                        <button name="tambah" class="btn btn-primary">Tambah</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle" bgcolor="#F1F8E2">
                    <thead class="table" bgcolor="#C0DF81">
                        <tr align="center">
                            <th>No</th>
                            <th>Jenis Kegiatan</th>
                            <th>Tempat</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td align="center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['jenis_nama']) ?></td>
                            <td><?= htmlspecialchars($row['tempat']) ?></td>
                            <td><?= htmlspecialchars($row['tanggal_mulai']) ?></td>
                            <td><?= htmlspecialchars($row['tanggal_selesai']) ?></td>
                            <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="?edit=<?= $row['id'] ?>">Edit</a>
                                <a class="btn btn-sm btn-danger" href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if (mysqli_num_rows($data) == 0): ?>
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data kegiatan.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
