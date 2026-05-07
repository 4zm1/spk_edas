<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Data Master /</span> Data Alternatif
</h4>

<?= $this->session->flashdata('message'); ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Sunscreen</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="ti ti-plus me-1"></i> Tambah Data
        </button>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Kode</th>
                    <th>Nama Sunscreen</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $no = 1; foreach($alternatif as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><span class="badge bg-label-primary"><?= $row['kode_alternatif'] ?></span></td>
                    <td class="fw-bold"><?= $row['nama_alternatif'] ?></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-icon btn-label-warning" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalEdit<?= $row['id_alternatif'] ?>">
                            <i class="ti ti-pencil"></i>
                        </button>

                        <a href="<?= base_url('alternatif/hapus/'.$row['id_alternatif']) ?>" 
                           class="btn btn-sm btn-icon btn-label-danger"
                           onclick="return confirm('Yakin ingin menghapus data ini? Semua nilai penilaian terkait juga akan terhapus.');">
                            <i class="ti ti-trash"></i>
                        </a>
                    </td>
                </tr>

                <div class="modal fade" id="modalEdit<?= $row['id_alternatif'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Alternatif</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url('alternatif/update') ?>" method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="id_alternatif" value="<?= $row['id_alternatif'] ?>">
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="kode" class="form-label">Kode Alternatif</label>
                                            <input type="text" name="kode" class="form-control" value="<?= $row['kode_alternatif'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="nama" class="form-label">Nama Sunscreen</label>
                                            <input type="text" name="nama" class="form-control" value="<?= $row['nama_alternatif'] ?>" required>
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
                <h5 class="modal-title">Tambah Alternatif Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('alternatif/simpan') ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="kode" class="form-label">Kode Alternatif</label>
                            <input type="text" name="kode" class="form-control" placeholder="Contoh: S6" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama" class="form-label">Nama Sunscreen</label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: Kahf Sunscreen" required>
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