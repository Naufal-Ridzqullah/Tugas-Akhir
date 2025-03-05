<?php
include_once "config/database.php";
include_once "layout/header.php";

?>

<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <body>
        <div class="container-fluid">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container">
                        <a class="navbar-brand" href="index.php"><strong>Power Monitoring System</strong></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="tabel.php">Tabel</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Grafik</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
        
                <!-- Main Content -->
                <main class="container col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="pt-3 border-1">
                        <h1>Dashboard</h1>
                        <!-- Grid Row -->
                        <div class="row">
                            <!-- Tegangan (Volt) -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                    Tegangan (Volt)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="Voltage"></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Arus (Amper) -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Arus (Amper)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="Current"></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Daya (Watt) -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Daya (Watt)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="Power"></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Frekuensi (Hz) -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Frekuensi (Hz)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="Frequency"></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kwh Meter -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kwh Meter</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="Energy"></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Power Factor -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-dark shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Power Factor</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="PowerFactor"></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
                                    <div class="col">
                                        <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Update Terbaru</h5>
                                            <p class="card-text" id="waktu"></p>
                                            <hr>
                                            <h5 class="card-title">Jumlah Data</h5>
                                            <p class="card-text" id="id"></p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </main>

            </div>
        </div>
    </body>
    <script>
    if(!!window.EventSource)
    {
        var source = new EventSource("api/read.php");
        source.onmessage = function(event){
            var data = JSON.parse(event.data);
            var id = data.id;
            var waktu = data.waktu;
            var Voltage = data.Voltage;
            var Current = data.Current;
            var Power = data.Power;
            var Energy = data.Energy;
            var Frequency = data.Frequency;
            var PowerFactor = data.PowerFactor;

            document.getElementById("id").innerText = id;
            document.getElementById("waktu").innerText = waktu;
            document.getElementById("Voltage").innerText = Voltage;
            document.getElementById("Current").innerText = Current;
            document.getElementById("Power").innerText = Power;
            document.getElementById("Energy").innerText = Energy;
            document.getElementById("Frequency").innerText = Frequency;
            document.getElementById("PowerFactor").innerText = PowerFactor;

        };
    }else
        {
            alert("Kegagalan Server Sent Event");
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Toggle sidebar menu on small screens
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            var menu = document.getElementById('sidebarMenu');
            if (menu.classList.contains('collapse')) {
                menu.classList.remove('collapse');
            } else {
                menu.classList.add('collapse');
            }
        });
    </script>
</html>

<?php include_once "layout/footer.php"; ?>
