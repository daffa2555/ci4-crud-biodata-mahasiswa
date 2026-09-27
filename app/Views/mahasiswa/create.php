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
        .card { border-radius: 12px; border: none; box-shadow: 0 4px 16px rgba(0,0,0,0.06); }
        .form-label { font-weight: 600; color: #334155; }
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
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card p-4">
                <div class="d-flex align-items-center mb-4 pb-2 border-bottom">
                    <a href="<?= base_url('mahasiswa'); ?>" class="btn btn-outline-secondary btn-sm me-3">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <div>
                        <h4 class="mb-0 text-dark fw-bold">Tambah Biodata Mahasiswa</h4>
                        <p class="text-muted mb-0 small">Formulir input data baru ke database (Tahap Create).</p>
                    </div>
                </div>

                <!-- Form Tambah Mahasiswa (CREATE) -->
                <form action="<?= base_url('mahasiswa/store'); ?>" method="post">
                    <?= csrf_field(); ?>

                    <!-- Input NIM -->
                    <div class="mb-3">
                        <label for="nim" class="form-label">Nomor Induk Mahasiswa (NIM) <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control <?= (isset($validation) && $validation->hasError('nim')) ? 'is-invalid' : ''; ?>" 
                               id="nim" 
                               name="nim" 
                               placeholder="Contoh: 202401004" 
                               value="<?= old('nim'); ?>" 
                               required 
                               autofocus>
                        <div class="invalid-feedback">
                            <?= (isset($validation)) ? $validation->getError('nim') : ''; ?>
                        </div>
                    </div>

                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control <?= (isset($validation) && $validation->hasError('nama')) ? 'is-invalid' : ''; ?>" 
                               id="nama" 
                               name="nama" 
                               placeholder="Masukkan nama lengkap mahasiswa" 
                               value="<?= old('nama'); ?>" 
                               required>
                        <div class="invalid-feedback">
                            <?= (isset($validation)) ? $validation->getError('nama') : ''; ?>
                        </div>
                    </div>

                    <!-- Input Jenis Kelamin -->
                    <div class="mb-3">
                        <label class="form-label d-block">Jenis Kelamin <span class="text-danger">*</span></label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input <?= (isset($validation) && $validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" 
                                   type="radio" 
                                   name="jenis_kelamin" 
                                   id="jk_l" 
                                   value="Laki-laki" 
                                   <?= old('jenis_kelamin') === 'Laki-laki' ? 'checked' : ''; ?> 
                                   required>
                            <label class="form-check-label" for="jk_l">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input <?= (isset($validation) && $validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" 
                                   type="radio" 
                                   name="jenis_kelamin" 
                                   id="jk_p" 
                                   value="Perempuan" 
                                   <?= old('jenis_kelamin') === 'Perempuan' ? 'checked' : ''; ?> 
                                   required>
                            <label class="form-check-label" for="jk_p">Perempuan</label>
                        </div>
                        <div class="text-danger small mt-1">
                            <?= (isset($validation)) ? $validation->getError('jenis_kelamin') : ''; ?>
                        </div>
                    </div>

                    <!-- Input Program Studi -->
                    <div class="mb-3">
                        <label for="prodi" class="form-label">Program Studi <span class="text-danger">*</span></label>
                        <select class="form-select <?= (isset($validation) && $validation->hasError('prodi')) ? 'is-invalid' : ''; ?>" 
                                id="prodi" 
                                name="prodi" 
                                required>
                            <option value="" disabled <?= old('prodi') ? '' : 'selected'; ?>>-- Pilih Program Studi --</option>
                            <option value="Teknik Informatika" <?= old('prodi') === 'Teknik Informatika' ? 'selected' : ''; ?>>Teknik Informatika</option>
                            <option value="Sistem Informasi" <?= old('prodi') === 'Sistem Informasi' ? 'selected' : ''; ?>>Sistem Informasi</option>
                            <option value="Teknologi Informasi" <?= old('prodi') === 'Teknologi Informasi' ? 'selected' : ''; ?>>Teknologi Informasi</option>
                            <option value="Rekayasa Perangkat Lunak" <?= old('prodi') === 'Rekayasa Perangkat Lunak' ? 'selected' : ''; ?>>Rekayasa Perangkat Lunak</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= (isset($validation)) ? $validation->getError('prodi') : ''; ?>
                        </div>
                    </div>

                    <!-- Input Alamat -->
                    <div class="mb-4">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control <?= (isset($validation) && $validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" 
                                  id="alamat" 
                                  name="alamat" 
                                  rows="3" 
                                  placeholder="Contoh: Jl. KH. Ahmad Dahlan No. 1, Kota Mataram"><?= old('alamat'); ?></textarea>
                        <div class="invalid-feedback">
                            <?= (isset($validation)) ? $validation->getError('alamat') : ''; ?>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                        <a href="<?= base_url('mahasiswa'); ?>" class="btn btn-light px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 d-inline-flex align-items-center">
                            <i class="bi bi-save2-fill me-2"></i> Simpan Biodata
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle via CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
