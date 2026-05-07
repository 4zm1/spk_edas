<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Data Master /</span> Data Kriteria
</h4>

<?= $this->session->flashdata('message'); ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Kriteria & Bobot</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="ti ti-plus me-1"></i> Tambah Kriteria
        </button>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Kode</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot</th>
                    <th>Jenis</th> <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $no = 1; foreach($kriteria as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><span class="badge bg-label-primary"><?= $row['kode_kriteria'] ?></span></td>
                    <td class="fw-bold"><?= $row['nama_kriteria'] ?></td>
                    <td><?= $row['bobot'] ?></td>
                    <td>
                        <?php if($row['jenis'] == 'Benefit'): ?>
                            <span class="badge bg-label-success">Benefit (Keuntungan)</span>
                        <?php else: ?>
                            <span class="badge bg-label-danger">Cost (Biaya)</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-icon btn-label-warning" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalEdit<?= $row['id_kriteria'] ?>">
                            <i class="ti ti-pencil"></i>
                        </button>
                        <a href="<?= base_url('kriteria/hapus/'.$row['id_kriteria']) ?>" 
                           class="btn btn-sm btn-icon btn-label-danger"
                           onclick="return confirm('Hapus kriteria ini?');">
                            <i class="ti ti-trash"></i>
                        </a>
                    </td>
                </tr>

                <div class="modal fade" id="modalEdit<?= $row['id_kriteria'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Kriteria</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url('kriteria/update') ?>" method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="id_kriteria" value="<?= $row['id_kriteria'] ?>">
                                    
                                    <div class="row g-2">
                                        <div class="col mb-3">
                                            <label class="form-label">Kode</label>
                                            <input type="text" name="kode" class="form-control" value="<?= $row['kode_kriteria'] ?>" required>
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label">Bobot</label>
                                            <input type="number" step="0.01" name="bobot" class="form-control" value="<?= $row['bobot'] ?>" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label class="form-label">Nama Kriteria</label>
                                            <input type="text" name="nama" class="form-control" value="<?= $row['nama_kriteria'] ?>" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col mb-3">
                                            <label class="form-label">Jenis Atribut</label>
                                            <select name="jenis" class="form-select" required>
                                                <option value="Benefit" <?= ($row['jenis'] == 'Benefit') ? 'selected' : '' ?>>Benefit (Semakin besar semakin bagus)</option>
                                                <option value="Cost" <?= ($row['jenis'] == 'Cost') ? 'selected' : '' ?>>Cost (Semakin kecil semakin bagus)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kriteria Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('kriteria/simpan') ?>" method="post">
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label class="form-label">Kode</label>
                            <input type="text" name="kode" class="form-control" placeholder="C1" required>
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Bobot</label>
                            <input type="number" step="0.01" name="bobot" class="form-control" placeholder="0.20" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Nama Kriteria</label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: SPF, Harga" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Jenis Atribut</label>
                            <select name="jenis" class="form-select" required>
                                <option value="Benefit">Benefit (Semakin besar semakin bagus)</option>
                                <option value="Cost">Cost (Semakin kecil semakin bagus)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>