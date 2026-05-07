<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Pengaturan /</span> Manajemen User
</h4>

<?= $this->session->flashdata('message'); ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Pengguna Sistem</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="ti ti-plus me-1"></i> Tambah User
        </button>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $no = 1; foreach($users as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <div class="d-flex justify-content-start align-items-center user-name">
                            <div class="avatar-wrapper">
                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded-circle bg-label-primary">
                                        <?= substr($row['nama_lengkap'], 0, 2) ?>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="fw-medium"><?= $row['nama_lengkap'] ?></span>
                                <small class="text-muted">Admin</small>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge bg-label-info"><?= $row['username'] ?></span></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-icon btn-label-warning" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalEdit<?= $row['id_user'] ?>">
                            <i class="ti ti-pencil"></i>
                        </button>

                        <?php if($row['id_user'] != $this->session->userdata('id_user')): ?>
                            <a href="<?= base_url('user/hapus/'.$row['id_user']) ?>" 
                               class="btn btn-sm btn-icon btn-label-danger"
                               onclick="return confirm('Yakin ingin menghapus user ini?');">
                                <i class="ti ti-trash"></i>
                            </a>
                        <?php else: ?>
                            <button class="btn btn-sm btn-icon btn-label-secondary" disabled title="Akun Sendiri">
                                <i class="ti ti-lock"></i>
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>

                <div class="modal fade" id="modalEdit<?= $row['id_user'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="<?= base_url('user/update') ?>" method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                                    
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" name="nama" class="form-control" value="<?= $row['nama_lengkap'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" value="<?= $row['username'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label class="form-label">Password Baru</label>
                                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                                            <small class="text-muted">Isi hanya jika ingin mengganti password.</small>
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
                <h5 class="modal-title">Tambah User Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('user/simpan') ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Petugas" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="UsernameLogin" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="*******" required>
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