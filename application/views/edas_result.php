<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">SPK /</span> Metode EDAS
</h4>

<div class="row">
    <div class="col-md-12 col-lg-4 mb-4">
        <div class="card h-100 bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title text-white mb-1">Rekomendasi Terbaik! 🎉</h5>
                <p class="card-text text-white-50">Berdasarkan hasil perhitungan sistem.</p>
                
                <div class="py-3 text-center">
                    <div class="avatar avatar-xl mx-auto mb-2">
                        <span class="avatar-initial rounded-circle bg-white text-primary fw-bold">1</span>
                    </div>
                    <h3 class="text-white mb-0"><?= $rank[0]['nama'] ?></h3>
                    <span class="badge bg-white text-primary mt-2">Skor: <?= number_format($rank[0]['nilai'], 4) ?></span>
                </div>
                
                <p class="mt-3 mb-0 text-center text-white-50">
                   Produk ini memiliki keseimbangan nilai terbaik dari segi SPF, Harga, dan Kualitas.
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-8 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Peringkat Lengkap Sunscreen</h5>
                <small class="text-muted">Diurutkan dari nilai tertinggi</small>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Nama Produk</th>
                            <th>Nilai Akhir (AS)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php $no = 1; foreach($rank as $r): ?>
                        <tr>
                            <td>
                                <?php if($no == 1): ?>
                                    <span class="badge badge-center rounded-pill bg-warning">
                                        <i class="ti ti-crown"></i>
                                    </span>
                                <?php else: ?>
                                    <span class="fw-bold text-muted"><?= $no ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?= $r['kode'] ?></td>
                            <td><strong><?= $r['nama'] ?></strong></td>
                            <td class="text-primary font-weight-bold"><?= number_format($r['nilai'], 4) ?></td>
                            <td>
                                <?php if($no == 1): ?>
                                    <span class="badge bg-label-success">Sangat Direkomendasikan</span>
                                <?php elseif($no == 2): ?>
                                    <span class="badge bg-label-info">Alternatif</span>
                                <?php else: ?>
                                    <span class="badge bg-label-secondary">Kurang Direkomendasikan</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php $no++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="accordion" id="accordionExample">
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Lihat Detail Matriks Keputusan
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>Alternatif</th>
                                        <?php foreach($kriteria as $k): ?>
                                            <th><?= $k['kode_kriteria'] ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($alternatif as $a): ?>
                                    <tr>
                                        <td><?= $a['nama_alternatif'] ?></td>
                                        <?php foreach($kriteria as $k): ?>
                                            <td><?= $matriks[$a['id_alternatif']][$k['id_kriteria']] ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Rata-rata (AV)</th>
                                        <?php foreach($kriteria as $k): ?>
                                            <th><?= number_format($av[$k['id_kriteria']], 3) ?></th>
                                        <?php endforeach; ?>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>