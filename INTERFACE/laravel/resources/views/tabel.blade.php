@extends("layouts.app")

@section("title","Tabel")

@section("content")

<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <main class="container col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
                <div class="pt-3">
                <h1 class="pb-2 border-bottom border-secondary">Tabel Parameter Listrik</h1>
                    <form method="POST" action="{{ route('export.data') }}" class="row g-3 mb-4">
                        @csrf
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Tanggal Mulai:</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">Tanggal Akhir:</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <label for="export_type" class="form-label">Format:</label>
                            <select name="export_type" class="form-control" required>
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                            </select>
                        </div>
                        <div class="col-md-2 align-self-end">
                            <button type="submit" class="btn btn-success w-100">Generate</button>
                        </div>
                    </form>                    
                    <!-- Tabel Data -->
                    <table id="dataTable" class="table table-striped table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Waktu</th>
                                <th scope="col">Tegangan</th>
                                <th scope="col">Arus</th>
                                <th scope="col">Daya</th>
                                <th scope="col">Frekuensi</th>
                                <th scope="col">Energi</th>
                                <th scope="col">Power Factor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                            <tr>
                                <td>{{ $row->waktu }}</td>
                                <td>{{ $row->Voltage }}</td>
                                <td>{{ $row->Current }}</td>
                                <td>{{ $row->Power }}</td>
                                <td>{{ $row->Frequency }}</td>
                                <td>{{ $row->Energy }}</td>
                                <td>{{ $row->PowerFactor }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- jQuery, DataTables JS, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable(); // Initialize DataTable
    });

    // $(document).ready(function() {
    //     setTimeout(function() {
    //         $('#myTable').DataTable({
    //             "order": [[1, "desc"]],
    //             "paging": true,
    //             "searching": true, 
    //             "info": true,
    //         });
    //     }, 500);
    // });

    // Toggle sidebar menu
    document.getElementById('sidebarToggle').addEventListener('click', function() {
            var menu = document.getElementById('sidebarMenu');
            if (menu.classList.contains('collapse')) {
                menu.classList.remove('collapse');
            } else {
                menu.classList.add('collapse');
            }
    });
    </script>
</body>
@endsection