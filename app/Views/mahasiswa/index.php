<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title); ?> - Sistem Biodata Mahasiswa</title>
    <!-- Bootstrap 5 CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f8fafc; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-brand { font-weight: 700; letter-spacing: 0.5px; }
        .card { border-radius: 12px; border: none; box-shadow: 0 4px 16px rgba(0,0,0,0.06); }
        .table thead th { background-color: #f1f5f9; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 0.82rem; letter-spacing: 0.5px; }
        .badge-prodi { font-size: 0.85rem; padding: 0.4em 0.7em; }
    </style>
</head>
<body>

<!-- Header Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= base_url('mahasiswa'); ?>">
            <i class="bi bi-mortarboard-fill me-2 fs-4"></i> SIAKAD • Biodata Mahasiswa
        </a>
        <div class="navbar-nav ms-auto">
            <span class="nav-item nav-link text-white-50">Tugas 2: CRUD Read & Create</span>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <div class="row">
        <div class="col-12">

            <!-- Notifikasi Flash Message Sukses -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-check-circle-fill fs-5 me-2"></i>
                    <div><?= session()->getFlashdata('pesan'); ?></div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Card Utama Daftar Biodata (READ) -->
            <div class="card p-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 pb-2 border-bottom">
                    <div>
                        <h4 class="mb-1 text-dark fw-bold">Daftar Biodata Mahasiswa</h4>
                        <p class="text-muted mb-0 small">Menampilkan data mahasiswa yang tersimpan di basis data (Tahap Read).</p>
                    </div>
                    <div class="mt-2 mt-md-0">
                        <a href="<?= base_url('mahasiswa/create'); ?>" class="btn btn-primary d-inline-flex align-items-center px-3 py-2 shadow-sm">
                            <i class="bi bi-person-plus-fill me-2"></i> Tambah Mahasiswa Baru
                        </a>
                    </div>
                </div>

                <!-- Tabel Data Mahasiswa -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" width="50">No</th>
                                <th scope="col" width="140">NIM</th>
                                <th scope="col">Nama Mahasiswa</th>
                                <th scope="col" width="130">Jenis Kelamin</th>
                                <th scope="col" width="200">Program Studi</th>
                                <th scope="col">Alamat Asal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($mahasiswa)) : ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                        Belum ada data mahasiswa. Silakan klik tombol <strong>Tambah Mahasiswa Baru</strong>.
                                    </td>
                                </tr>
                            <?php else : ?>
                                <?php $no = 1; foreach ($mahasiswa as $m) : ?>
                                    <tr>
                                        <td class="text-center fw-semibold text-muted"><?= $no++; ?></td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-2 py-1 font-monospace"><?= esc($m['nim']); ?></span>
                                        </td>
                                        <td class="fw-semibold text-dark"><?= esc($m['nama']); ?></td>
                                        <td>
                                            <?php if ($m['jenis_kelamin'] === 'Laki-laki') : ?>
                                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                                    <i class="bi bi-gender-male me-1"></i> Laki-laki
                                                </span>
                                            <?php else : ?>
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                                    <i class="bi bi-gender-female me-1"></i> Perempuan
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle badge-prodi">
                                                <?= esc($m['prodi']); ?>
                                            </span>
                                        </td>
                                        <td class="text-secondary"><?= esc($m['alamat'] ?: '-'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Card -->
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top text-muted small">
                    <span>Total data terdaftar: <strong><?= count($mahasiswa); ?></strong> mahasiswa</span>
                    <span>Pola Arsitektur: <code>Route &rarr; Controller &rarr; Model &rarr; View</code></span>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle via CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
