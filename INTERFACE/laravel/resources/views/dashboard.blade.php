@extends("layouts.app")

@section("title","Dashboard")

@section("content")
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

<!-- CSS -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        background-color:rgb(238, 238, 238); /* abu-abu muda */
        min-height: 100vh;
    }
    .card-custom {
        border-radius: 15px;
        background-color: #ffffff;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border: 1px solid #e3e3e3;
    }

    .card-custom:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .icon-container {
        font-size: 1.8rem;
        padding: 0.75rem;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 50px;
        height: 50px;
    }

    .btn-group .btn {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center; /* Pastikan teks ada di tengah */
    }

    .icon-danger { background-color: #f5365c; color: white; }
    .icon-success { background-color: #f5365c; color: white; }
    .icon-info { background-color:  rgb(36, 131, 12); color: white; }
    .icon-primary { background-color: #f5365c; color: white; }
    .icon-warning { background-color:rgb(36, 131, 12); color: white; }
    .icon-dark { background-color: rgb(36, 131, 12); color: white; }
</style>

<div class="container">
    <div class="row">
        <main class="container col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="pt-3">
                <h1 class="pb-2 border-bottom border-secondary">Dashboard</h1>
                <p class="text-center text-muted">
                    Update Terakhir: <strong id="waktu-update">{{ $data->waktu ?? 'Tidak ada data' }}</strong>
                </p>

                @php
                    $cards = [
                        ['title' => 'Tegangan (Volt)', 'value' => $data->Voltage ?? 'N/A', 'unit' => 'V', 'color' => 'danger', 'icon' => 'bolt'],
                        ['title' => 'Arus (Amper)', 'value' => $data->Current ?? 'N/A', 'unit' => 'A', 'color' => 'success', 'icon' => 'plug'],
                        ['title' => 'Frekuensi (Hz)', 'value' => $data->Frequency ?? 'N/A', 'unit' => 'Hz', 'color' => 'primary', 'icon' => 'wave-square'],
                        ['title' => 'Daya (Watt)', 'value' => $data->Power ?? 'N/A', 'unit' => 'W', 'color' => 'info', 'icon' => 'lightbulb'],
                        ['title' => 'Kwh Meter', 'value' => $data->Energy ?? 'N/A', 'unit' => 'kWh', 'color' => 'warning', 'icon' => 'battery-full'],
                        ['title' => 'Power Factor', 'value' => $data->PowerFactor ?? 'N/A', 'unit' => '', 'color' => 'dark', 'icon' => 'chart-line'],
                    ];
                @endphp

                <!-- Kartu Data Energi -->
                <div class="row g-4 mb-4" id="data-cards">
                    @foreach ($cards as $card)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card card-custom p-3 d-flex flex-row justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">{{ $card['title'] }}</h6>
                                    <h3 class="mb-0 fw-bold">{{ $card['value'] }} {{ $card['unit'] }}</h3>
                                </div>
                                <div class="icon-container icon-{{ $card['color'] }}">
                                    @if(in_array($card['title'], ['Tegangan (Volt)', 'Arus (Amper)', 'Frekuensi (Hz)']))
                                        <i class="nc-icon nc-sound-wave"></i>
                                    @elseif($card['title'] === 'Kwh Meter')
                                        <i class="nc-icon nc-money-coins"></i>
                                    @elseif($card['title'] === 'Daya (Watt)')
                                        <i class="nc-icon nc-sun-fog-29"></i>
                                    @elseif($card['title'] === 'Power Factor')
                                        <i class="nc-icon nc-tag-content"></i>
                                    @else
                                        <i class="fa-solid fa-{{ $card['icon'] }}"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Kontrol dan Reset -->
                <div class="row g-4 mb-4">
                    <!-- Kontrol Relay -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <div class="icon-big text-primary">
                                            <i class="nc-icon nc-bulb-63"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                    <p class="card-category mb-1 fw-bold text-secondary" style="font-size: 20px;">Kontrol Relay</p>
                                        <div class="btn-group w-100 mb-2">
                                            <button id="relayOn" class="btn btn-success btn-sm w-50">RELAY_ON</button>
                                            <button id="relayOff" class="btn btn-danger btn-sm w-50">RELAY_OFF</button>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="text-muted me-1">Status:</span>
                                            <span id="status" class="badge {{ $status ? 'bg-success' : 'bg-danger' }}">
                                                Relay {{ $status ? 'ON' : 'OFF' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reset Energi -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <div class="icon-big text-warning">
                                            <i class="nc-icon nc-settings"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                    <p class="card-category mb-1 fw-bold text-secondary" style="font-size: 20px;">Reset Energi</p>
                                        <div class="btn-group w-100 mb-2">
                                            <button id="energiOff" class="btn btn-success btn-sm w-50">Membaca</button>
                                            <button id="energiOn" class="btn btn-danger btn-sm w-50">Mereset</button>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="text-muted me-1">Status:</span>
                                            <span id="statusenergi" class="badge {{ $statusenergi ? 'bg-danger' : 'bg-success' }}">
                                                Reset Energi {{ $statusenergi ? 'ON' : 'OFF' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reset WiFi -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <div class="icon-big text-danger">
                                            <i class="nc-icon nc-globe"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                    <p class="card-category mb-1 fw-bold text-secondary" style="font-size: 20px;">Reset WiFi</p>
                                        <div class="btn-group w-100 mb-2">
                                            <button id="wifiOff" class="btn btn-success btn-sm w-50">Terhubung</button>
                                            <button id="wifiOn" class="btn btn-danger btn-sm w-50">Reset</button>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="text-muted me-1">Status:</span>
                                            <span id="statuswifi" class="badge {{ $statuswifi ? 'bg-danger' : 'bg-success' }}">
                                                Reset WiFi {{ $statuswifi ? 'ON' : 'OFF' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Luas Bangunan dan Trend -->
                <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card bg-primary text-white shadow-lg rounded-3">
                            <div class="card-header d-flex align-items-center">
                                <i class="fa-solid fa-ruler-combined icon me-2"></i>
                                <span class="fs-5">Input Luas Bangunan</span>
                            </div>
                            <div class="card-body text-center">
                                <form id="buildingForm">
                                    <input type="number" id="luasBangunan" class="form-control mb-3" placeholder="Masukkan luas (m²)" value="{{ $luas }}" step="0.01">
                                    <button type="submit" class="btn btn-success w-100">Simpan</button>
                                </form>
                                <p class="mt-3 fs-6">Luas Bangunan: <span id="displayLuas">{{ $luas }}</span> m²</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom kedua dan ketiga digabung untuk Grafik Energi -->
                    <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="card shadow-lg rounded-3">
                        <div class="card-body">
                            <h6 class="text-muted mb-4 fs-5 text-center">Trend Efisiensi Penggunaan Energi</h6>
                            <div class="d-flex justify-content-center">
                                <canvas id="energiChart" class="w-100" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>


    
    <script>
    // Inisialisasi Chart
    const labels = @json($labels);
    const values = @json($values);
    const fuzzies = @json($fuzzies);

    const ctx = document.getElementById('energiChart').getContext('2d');
    
    // Inisialisasi Chart pertama kali
    const energiChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Konsumsi Energi (kWh)',
                data: values,
                fill: false,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 1)',
                tension: 0.2,
                pointRadius: 6,
                pointHoverRadius: 8,
                pointBackgroundColor: fuzzies.map(fuzzy => {
                    if (fuzzy === 'Efisien') return 'green';
                    if (fuzzy === 'Cukup Efisien') return 'orange';
                    if (fuzzy === 'Tidak Efisien') return 'red';
                    return 'gray';
                }),
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const index = context.dataIndex;
                            return `KWH: ${values[index]} (${fuzzies[index]})`;
                        }
                    }
                },
                datalabels: {
                    align: 'left',
                    anchor: 'center',
                    font: {
                        size: 10,
                        weight: 'bold'
                    },
                    color: function(context) {
                        const index = context.dataIndex;
                        const fuzzy = fuzzies[index];
                        if (fuzzy === 'Efisien') return 'green';
                        if (fuzzy === 'Cukup Efisien') return 'orange';
                        if (fuzzy === 'Tidak Efisien') return 'red';
                        return 'gray';
                    },
                    formatter: function(value, context) {
                        const index = context.dataIndex;
                        return `${value} (${fuzzies[index]})`;
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'KWH'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    // Fungsi untuk menarik data fuzzy
    function ambilFuzzyLog() {
        fetch("{{ route('get.fuzzy') }}")
            .then(response => response.json())
            .then(data => {
                // Pastikan data yang diterima valid
                if (data && data.labels && data.values && data.fuzzies) {
                    // Update data chart tanpa merubah chart yang ada
                    updateChartData(data.labels, data.values, data.fuzzies);
                } else {
                    console.error("Data tidak lengkap:", data);
                }
            })
            .catch(err => console.error("Gagal ambil data fuzzy:", err));
    }

    // Fungsi untuk memperbarui data chart yang sudah ada
    function updateChartData(labels, values, fuzzies) {
        // Memastikan chart sudah ada
        if (energiChart) {
            // Memperbarui data chart (labels, values, dan pointBackgroundColor)
            energiChart.data.labels = labels;
            energiChart.data.datasets[0].data = values;
            energiChart.data.datasets[0].pointBackgroundColor = fuzzies.map(fuzzy => {
                if (fuzzy === 'Efisien') return 'green';
                if (fuzzy === 'Cukup Efisien') return 'orange';
                if (fuzzy === 'Tidak Efisien') return 'red';
                return 'gray';
            });

            // Memperbarui chart setelah data diubah
            energiChart.update();
        }
    }

    // Fungsi untuk auto-load data fuzzy dan update chart setiap 10 detik
    setInterval(ambilFuzzyLog, 10000);

    // Menarik data pertama kali ketika halaman selesai dimuat
    document.addEventListener("DOMContentLoaded", ambilFuzzyLog);

        // ajax realtime data
        function fetchLatestData() {
            $.ajax({
                url: "{{ route('dashboard.latest-data') }}",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#waktu-update').text(data.waktu ?? '—');

                    const values = [
                        { key: 'Voltage', unit: 'V' },
                        { key: 'Current', unit: 'A' },
                        { key: 'Frequency', unit: 'Hz' },
                        { key: 'Power', unit: 'W' },
                        { key: 'Energy', unit: 'kWh' },
                        { key: 'PowerFactor', unit: '' },
                    ];

                    values.forEach((item, index) => {
                        const val = data[item.key] ?? 'N/A';
                        $('#data-cards .col-lg-4').eq(index).find('h3').html(`${val} ${item.unit}`);
                    });
                },
                error: function() {
                    console.log("Belum ada data dari ESP.");
                }
            });
        }

        fetchLatestData();
        setInterval(fetchLatestData, 3000);

        // RELAY
        $(document).ready(function() {
            function relay() {
                $.get("{{ route('dashboard.relay.status') }}", function(response) {
                    let statusText = response.status ? 'ON' : 'OFF';
                    let statusClass = response.status ? 'bg-success' : 'bg-danger';
                    $('#status').text("Relay " + statusText).removeClass('bg-secondary bg-success bg-danger').addClass(statusClass);
                });
            }

            $('#relayOn').click(function() {
                toggleRelay(1);
            });

            $('#relayOff').click(function() {
                toggleRelay(0);
            });

            function toggleRelay(status) {
                $.ajax({
                    url: "{{ route('dashboard.relay.toggle') }}",
                    type: "POST",
                    data: { _token: "{{ csrf_token() }}", status: status },
                    success: function(response) {
                        relay();
                    }
                });
            }

            relay(); // Ambil status awal saat halaman dimuat
        });


        // RESET ENERGI
        $(document).ready(function () {
            function Energi() {
                $.get("{{ route('dashboard.energi.status') }}", function (response) {
                    let statusText = response.status ? 'ON' : 'OFF';
                    let statusClass = response.status ? 'bg-danger' : 'bg-success';
                    $('#statusenergi')
                        .text("Reset Energi " + statusText)
                        .removeClass('bg-secondary bg-success bg-danger')
                        .addClass(statusClass);
                });
            }

            $('#energiOn').click(function () {
                toggleEnergi(1);
            });

            $('#energiOff').click(function () {
                toggleEnergi(0);
            });

            function toggleEnergi(status) {
                $.ajax({
                    url: "{{ route('dashboard.energi.toggle') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: status
                    },
                    success: function (response) {
                        Energi(); // update tampilan status
                    }
                });
            }

            Energi(); // Ambil status awal saat halaman dimuat
        });

        // RESET WIFI
        $(document).ready(function () {
            function Wifi() {
                $.get("{{ route('dashboard.wifi.status') }}", function (response) {
                    let statusText = response.status ? 'ON' : 'OFF';
                    let statusClass = response.status ? 'bg-danger' : 'bg-success';
                    $('#statuswifi')
                        .text("Reset WiFi " + statusText)
                        .removeClass('bg-secondary bg-danger bg-success ')
                        .addClass(statusClass);
                });
            }

            $('#wifiOn').click(function () {
                toggleWifi(1);
            });

            $('#wifiOff').click(function () {
                toggleWifi(0);
            });

            function toggleWifi(status) {
                $.ajax({
                    url: "{{ route('dashboard.wifi.toggle') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: status
                    },
                    success: function (response) {
                        Wifi(); // update tampilan status
                    }
                });
            }

            Wifi(); // Ambil status awal saat halaman dimuat
        });

        // LUAS BANGUNAN
        document.getElementById('buildingForm').addEventListener('submit', function(event) {
        event.preventDefault();
        let luas = document.getElementById('luasBangunan').value;

        fetch("{{ route('dashboard.save-luas') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ luas: luas })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('displayLuas').textContent = data.luas;
            alert(data.message);
        })
        .catch(error => console.error("Error:", error));
    });
    </script>
@endsection