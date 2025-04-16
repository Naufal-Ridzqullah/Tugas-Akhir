@extends("layouts.app")

@section("title","Grafik")

@section("content")

<style>
    body {
        background-color:rgb(238, 238, 238); /* abu-abu muda */
        min-height: 100vh;
    }
</style>

<div class="container">
    <div class="row">
        <!-- Main Content Grafik-->
        <main class="container col-md-12 ms-sm-auto col-lg-11 px-md-4 ">
            <div class="pt-3">
                <h1 class="pb-2 border-bottom border-secondary">Trend Parameter Listrik</h1>

                    <form method="GET" class="row g-3">
                        <div class="col-md-5">
                            <label for="start_date" class="form-label">Mulai Tanggal</label>
                            <input type="date" class="form-control" name="start_date" value="{{ $startDate }}">
                        </div>
                        <div class="col-md-5">
                            <label for="end_date" class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control" name="end_date" value="{{ $endDate }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('grafik.export-pdf') }}" id="pdfForm">
                        @csrf
                        <input type="hidden" name="imageData" id="imageData">
                        <input type="hidden" name="start_date" value="{{ $startDate }}">
                        <input type="hidden" name="end_date" value="{{ $endDate }}">
                        <button type="submit" class="btn btn-success mt-3">Generate PDF</button>
                    </form>

                    <div class="row mt-4 px-2 px-sm-3">
                        @foreach($metrics as $metric)
                            <div class="col-xl-6 col-md-12 col-sm-12 col-12 mb-4">
                                <div class="card shadow-sm border-1 rounded-lg h-100">
                                    <div class="card-body p-3 p-md-4">
                                        <h5 class="card-title text-center" style="font-size: clamp(1rem, 2.5vw, 1.25rem);">
                                            {{ $metric }}
                                        </h5>

                                        @if(isset($imageDataArray))
                                            <img src="{{ $imageDataArray[$loop->index] ?? '' }}"
                                                style="width: 100%; height: auto; object-fit: contain;"
                                                class="img-fluid my-3">
                                        @else
                                            <div style="width: 100%; height: auto;">
                                                <canvas id="{{ $metric }}Chart"
                                                        style="width: 100%; height: 300px !important; max-height: 400px;"
                                                        class="my-3"></canvas>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </main>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const chartData = @json($dataChart);
    let imageDataArray = [];
    let charts = [];
    let processedCharts = 0;

    const colors = {
        Voltage: { border: 'rgba(255, 99, 132, 1)', background: 'rgba(255, 99, 132, 0.2)' },
        Current: { border: 'rgba(54, 162, 235, 1)', background: 'rgba(54, 162, 235, 0.2)' },
        Power: { border: 'rgba(75, 192, 192, 1)', background: 'rgba(75, 192, 192, 0.2)' },
        Energy: { border: 'rgba(255, 206, 86, 1)', background: 'rgba(255, 206, 86, 0.2)' },
        Frequency: { border: 'rgba(153, 102, 255, 1)', background: 'rgba(153, 102, 255, 0.2)' },
        PowerFactor: { border: 'rgba(255, 159, 64, 1)', background: 'rgba(255, 159, 64, 0.2)' }
    };

    Object.keys(chartData).forEach(metric => {
        const ctx = document.getElementById(`${metric}Chart`).getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData[metric].labels,
                datasets: [{
                    label: metric,
                    data: chartData[metric].data,
                    borderColor: colors[metric].border,
                    backgroundColor: colors[metric].background,
                    borderWidth: 2,
                    fill: true,
                    pointRadius: 0
                }]
            }
        });

        charts.push(chart);
    });

    setTimeout(() => {
        charts.forEach((chart, index) => {
            const imageUrl = chart.toBase64Image();
            imageDataArray.push(imageUrl);
            processedCharts++;

            if (processedCharts === charts.length) {
                document.getElementById("imageData").value = JSON.stringify(imageDataArray);
            }
        });
    }, 2000);

    document.getElementById("pdfForm").addEventListener("submit", function (e) {
        if (imageDataArray.length === 0) {
            alert("Tunggu beberapa saat hingga grafik dimuat!");
            e.preventDefault();
        }
    });
});
</script>
@endsection