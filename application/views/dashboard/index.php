
<div class="row">
    <div class="col-12 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="card-title mb-2 text-white">Selamat Datang di SunSmart SPK! 👋</h3>
                        <p class="mb-4 text-white-50">
                            Sistem Pendukung Keputusan pemilihan sunscreen terbaik untuk kulit berjerawat <br>
                            menggunakan metode <strong>EDAS (Evaluation based on Distance from Average Solution)</strong>.
                        </p>
                        <a href="<?= base_url('penilaian') ?>" class="btn btn-light text-primary fw-bold">
                            <i class="ti ti-edit me-1"></i> Mulai Penilaian
                        </a>
                        <a href="<?= base_url('edas') ?>" class="btn btn-outline-white ms-2">
                            Lihat Hasil
                        </a>
                    </div>
                    <div class="d-none d-md-block">
                        <svg width="120" height="120" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="white" fill-opacity="0.2"/>
                            <path d="M12 18C15.3137 18 18 15.3137 18 12C18 8.68629 15.3137 6 12 6C8.68629 6 6 8.68629 6 12C6 15.3137 8.68629 18 12 18Z" fill="white"/>
                            <path d="M12 4V2M12 22V20M4 12H2M22 12H20M6.34 6.34L4.93 4.93M19.07 19.07L17.66 17.66M6.34 17.66L4.93 19.07M19.07 4.93L17.66 6.34" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-bottle ti-md"></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?= $total_alternatif ?></h4>
                </div>
                <p class="mb-1">Total Sunscreen</p>
                <small class="text-muted">Produk terdaftar</small>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-success"><i class="ti ti-database ti-md"></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?= $total_kriteria ?></h4>
                </div>
                <p class="mb-1">Total Kriteria</p>
                <small class="text-muted">Parameter penilaian</small>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-warning"><i class="ti ti-calculator ti-md"></i></span>
                    </div>
                    <h4 class="ms-1 mb-0">EDAS</h4>
                </div>
                <p class="mb-1">Metode SPK</p>
                <small class="text-muted">Jurnal Referensi</small>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-8 mb-4 mb-lg-0">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title m-0 me-2">Hasil Perangkingan Sunscreen</h5>
                <a href="<?= base_url('edas') ?>" class="btn btn-sm btn-label-primary">Lihat Detail</a>
            </div>
            <div class="card-body">
                <div id="rankingChart"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title m-0 me-2">Bobot Kriteria</h5>
            </div>
            <div class="card-body">
                <div id="weightChart" class="d-flex justify-content-center"></div>
                <div class="mt-4">
                    <ul class="p-0 m-0">
                        <?php 
                        $colors = ['#7367F0', '#00CFE8', '#28C76F', '#FF9F43', '#EA5455'];
                        $i = 0;
                        foreach($chart_kriteria as $k): 
                            $color = $colors[$i % count($colors)];
                            $i++;
                        ?>
                        <li class="d-flex gap-2 align-items-center mb-2">
                            <span class="badge badge-dot" style="background-color: <?= $color ?>;"></span>
                            <span class="fw-semibold"><?= $k['nama_kriteria'] ?></span>
                            <span class="text-muted ms-auto"><?= $k['bobot'] * 100 ?>%</span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title m-0">Alur Penggunaan Sistem</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="p-3 border rounded text-center bg-light">
                            <span class="badge bg-label-primary p-2 mb-2"><i class="ti ti-database"></i></span>
                            <h6 class="mb-1">1. Data Kriteria</h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 border rounded text-center bg-light">
                            <span class="badge bg-label-info p-2 mb-2"><i class="ti ti-bottle"></i></span>
                            <h6 class="mb-1">2. Data Alternatif</h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 border rounded text-center bg-light">
                            <span class="badge bg-label-warning p-2 mb-2"><i class="ti ti-edit"></i></span>
                            <h6 class="mb-1">3. Input Penilaian</h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 border rounded text-center bg-light">
                            <span class="badge bg-label-success p-2 mb-2"><i class="ti ti-calculator"></i></span>
                            <h6 class="mb-1">4. Hasil EDAS</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    
    // Cek apakah library sudah terload dari Header
    if (typeof ApexCharts === 'undefined') {
        console.error('Library ApexCharts belum terload! Pastikan link CDN ada di header.php');
        return;
    }

    // --- DATA DARI PHP (Encode langsung ke JSON) ---
    const dataRank = <?= json_encode($chart_hasil) ?>;
    const dataKriteria = <?= json_encode($chart_kriteria) ?>;

    console.log("Data Grafik:", dataRank); 

    // Persiapan Data
    const names = dataRank.map(item => item.nama);
    const scores = dataRank.map(item => parseFloat(item.nilai));
    const weights = dataKriteria.map(item => parseFloat(item.bobot));
    const criteriaNames = dataKriteria.map(item => item.nama_kriteria);
    
    const chartColors = ['#7367F0', '#00CFE8', '#28C76F', '#FF9F43', '#EA5455', '#A8AAAE'];

    // 1. CONFIG BAR CHART (RANKING)
    const rankingChartEl = document.querySelector('#rankingChart');
    if (rankingChartEl) {
        const rankingChartConfig = {
            chart: {
                height: 350,
                type: 'bar',
                toolbar: { show: false },
                fontFamily: 'Public Sans',
                animations: { enabled: true, easing: 'easeinout', speed: 800 }
            },
            plotOptions: {
                bar: { columnWidth: '50%', borderRadius: 6, distributed: true }
            },
            dataLabels: { enabled: false },
            series: [{ name: 'Appraisal Score (AS)', data: scores }],
            xaxis: {
                categories: names,
                labels: { style: { colors: '#6f6b7d', fontSize: '12px' } }
            },
            colors: chartColors,
            grid: { borderColor: '#f1f1f2', padding: { bottom: 10 } },
            legend: { show: false },
            tooltip: { theme: 'light' }
        };
        const rankingChart = new ApexCharts(rankingChartEl, rankingChartConfig);
        rankingChart.render();
    }

    // 2. CONFIG DONUT CHART (BOBOT)
    const weightChartEl = document.querySelector('#weightChart');
    if (weightChartEl) {
        const weightChartConfig = {
            chart: {
                height: 250,
                type: 'donut',
                fontFamily: 'Public Sans'
            },
            labels: criteriaNames,
            series: weights,
            colors: chartColors,
            stroke: { width: 0 },
            legend: { show: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: '72%',
                        labels: {
                            show: true,
                            name: { fontSize: '0.9rem', fontFamily: 'Public Sans', offsetY: 20 },
                            value: {
                                fontSize: '1.2rem',
                                color: '#5d596c',
                                offsetY: -15,
                                formatter: function (val) { return (parseFloat(val) * 100) + '%'; }
                            },
                            total: {
                                show: true,
                                label: 'Total',
                                color: '#a5a3ae',
                                formatter: function () { return '100%'; }
                            }
                        }
                    }
                }
            }
        };
        const weightChart = new ApexCharts(weightChartEl, weightChartConfig);
        weightChart.render();
    }
});
</script>