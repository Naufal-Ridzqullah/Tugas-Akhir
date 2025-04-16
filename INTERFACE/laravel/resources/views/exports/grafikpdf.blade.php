<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Grafik Monitoring PDF</title>
    <style>
        body { font-family: sans-serif; }
        .chart-img {
            width: 100%;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <h2>Grafik Penggunaan Listrik</h2>
    <p>Periode: {{ $startDate }} sampai {{ $endDate }}</p>

    @foreach($metrics as $index => $metric)
        <div>
            <h4>{{ $metric }}</h4>
            @if(isset($imageDataArray[$index]))
                <img src="{{ $imageDataArray[$index] }}" class="chart-img">
            @else
                <p>Data grafik tidak tersedia</p>
            @endif
        </div>
    @endforeach
</body>
</html>
