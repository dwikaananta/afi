<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <title>{{ env('app_name') }}</title>
</head>

<body class="bg-light">

    @auth
        <div class="text-center my-3">
            <h3>{{ env('app_name') }}</h3>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                {{-- <a class="navbar-brand" href="#">{{ env('app_name') }}</a> --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav container d-flex justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link active" href="/dashboard?tahun={{ date('Y') }}"><i class="fa fa-dashboard me-1"></i>Dashboard</a>
                        </li>
                        @if (auth()->user()->level == 9)
                            <li class="nav-item">
                                <a class="nav-link active" href="/user"><i class="fa fa-users me-1"></i>User</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link active" href="/tanaman"><i class="fa fa-tree me-1"></i>Tanaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/supplier"><i class="fa fa-boxes me-1"></i>Supplier</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/pengadaan"><i class="fa fa-check-square me-1"></i>Pengadaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/penjualan"><i class="fa fa-check-circle me-1"></i>Penjualan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/reject"><i class="fa fa-times-circle me-1"></i>Reject</a>
                        </li>
                        @if (auth()->user()->level == 9)
                            <li class="nav-item dropdown">
                                <a class="nav-link active dropdown-toggle" id="laporan" data-bs-toggle="dropdown" aria-expanded="false" href="#"><i class="fa fa-flag me-1"></i>Laporan</a>
                                <ul class="dropdown-menu" aria-labelledby="laporan">
                                    <li><a class="dropdown-item" href="/laporan-pengadaan">Laporan Pengadaan</a></li>
                                    <li><a class="dropdown-item" href="/laporan-penjualan">Laporan Penjualan</a></li>
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link active" href="/logout" onclick="return confirm('Yakin logout ?')"><i class="fa fa-sign-out me-1"></i>Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @endauth


    @auth
        <div class="container bg-white py-4">
            <h3 class="card-header text-center mb-2">{{ $title ?? '' }} @isset($_GET['deleted']) Tidak Aktif @endisset</h3>
    @endauth
        @yield('content')
    @auth
        </div>
    @endauth


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://unpkg.com/react@17/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js" crossorigin></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('.table-sm').DataTable();
        });
    </script>

    @yield('js')
</body>

</html>
