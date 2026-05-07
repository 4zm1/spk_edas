<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Data Master /</span> Input Penilaian
</h4>

<?= $this->session->flashdata('message'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Matriks Penilaian</h5>
                <small class="text-muted">Masukkan nilai untuk setiap alternatif terhadap kriteria</small>
            </div>
            
            <div class="card-body">
                <form action="<?= base_url('penilaian/update') ?>" method="post">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th width="20%">Alternatif \ Kriteria</th>
                                    <?php foreach($kriteria as $k): ?>
                                        <th class="text-center">
                                            <?= $k['nama_kriteria'] ?> <br>
                                            <span class="badge bg-label-secondary" style="font-size: 0.7em"><?= $k['kode_kriteria'] ?></span>
                                        </th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($alternatif as $a): ?>
                                <tr>
                                    <td class="align-middle fw-bold">
                                        <?= $a['nama_alternatif'] ?>
                                    </td>
                                    
                                    <?php foreach($kriteria as $k): ?>
                                        <td>
                                            <?php 
                                                $nilai_awal = isset($matriks[$a['id_alternatif']][$k['id_kriteria']]) 
                                                              ? $matriks[$a['id_alternatif']][$k['id_kriteria']] 
                                                              : 0;
                                            ?>
                                            
                                            <input type="number" step="0.01" 
                                                   class="form-control text-center"
                                                   name="nilai[<?= $a['id_alternatif'] ?>][<?= $k['id_kriteria'] ?>]" 
                                                   value="<?= $nilai_awal ?>" 
                                                   required>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="reset" class="btn btn-label-secondary me-2">Reset</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i> Simpan Penilaian
                        </button>
                        <a href="<?= base_url('edas') ?>" class="btn btn-success ms-2">
                            <i class="ti ti-calculator me-1"></i> Lihat Hasil Perhitungan
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <span class="alert-icon text-primary me-2">
                <i class="ti ti-info-circle ti-xs"></i>
            </span>
            <span>
                <strong>Petunjuk:</strong> Pastikan semua kolom terisi angka. Jika data kosong, masukkan angka 0. 
                Setelah disimpan, klik tombol "Lihat Hasil Perhitungan" untuk melihat ranking metode EDAS.
            </span>
        </div>
    </div>
</div>