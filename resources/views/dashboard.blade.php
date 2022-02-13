@extends('layouts.main')

@section('content')
    <x-alert />

    <div class="row">
        <div class="col-3 text-center text-white p-3">
            <div class="bg-warning p-3">
                <p class="m-0">Total Stock</p>
                <h3 class="m-0">{{ $total_tanaman }}</h3>
            </div>
        </div>
        <div class="col-3 text-center text-white p-3">
            <div class="bg-primary p-3">
                <p class="m-0">Total Pengadaan</p>
                <h3 class="m-0">{{ $total_pengadaan }}</h3>
            </div>
        </div>
        <div class="col-3 text-center text-white p-3">
            <div class="bg-info p-3">
                <p class="m-0">Total Penjualan</p>
                <h3 class="m-0">{{ $total_penjualan }}</h3>
            </div>
        </div>
        <div class="col-3 text-center text-white p-3">
            <div class="bg-danger p-3">
                <p class="m-0">Total Reject</p>
                <h3 class="m-0">{{ $total_reject }}</h3>
            </div>
        </div>
    </div>

    <div class="text-center">
        <h3>Grafik Pengeluaran & Pendapatan {{ $_GET['tahun'] }}</h3>
        <select name="" id="" onchange="window.location = this.value">
            <option value="/dashboard?tahun=2021" @if ($_GET['tahun'] == '2021')
                selected @endisset>2021</option>
            <option value="/dashboard?tahun=2022" @if ($_GET['tahun'] == '2022')
                selected @endisset>2022</option>
            <option value="/dashboard?tahun=2023" @if ($_GET['tahun'] == '2023')
                selected @endisset>2023</option>
        </select>
    </div>

    <div class="row my-3 px-4">
        <div class="py-3 text-white col-6 text-center" style="background-color: rgba(75, 192, 192, 0.7)">Pendapatan</div>
        <div class="py-3 col-6 text-center" style="background-color: rgba(75, 192, 192, 0.2)">Pengluaran</div>
    </div>

    <div class="mb-4">
        <canvas id="myChart"></canvas>
    </div>

    <div class="row">
        {{-- <div class="col-6">
            <div class="text-center">
                <h3>Kategori Tanaman Paling Laris {{ $_GET['tahun'] }}</h3>
            </div>
        
            <div class="mb-4 w-50 m-auto">
                <canvas id="myPie"></canvas>
            </div>
        </div> --}}
    
        {{-- <div class="col-6">
            <div class="text-center">
                <h3>Top 10 Tanaman Paling Laris {{ $_GET['tahun'] }}</h3>
            </div>
        
            <x-table>
                <x-thead>
                    <th>No</th>
                    <th>Nama Tanaman</th>
                    <th>Kategori</th>
                </x-thead>
            </x-table>
        </div> --}}
    </div>
@endsection


@section('js')
    <script>
        const labels = [
            'Pendapat Januari',
            'Pengeluaran Januari',
            'Pendapat Februari',
            'Pengeluaran Februari',
            'Pendapat Maret',
            'Pengeluaran Maret',
            'Pendapat April',
            'Pengeluaran April',
            'Pendapat Mai',
            'Pengeluaran Mai',
            'Pendapat Juni',
            'Pengeluaran Juni',
            'Pendapat Juli',
            'Pengeluaran Juli',
            'Pendapat Agustus',
            'Pengeluaran Agustus',
            'Pendapat September',
            'Pengeluaran September',
            'Pendapat Oktober',
            'Pengeluaran Oktober',
            'Pendapat November',
            'Pengeluaran November',
            'Pendapat Desember',
            'Pengeluaran Desember',
        ];

        const data = {
            labels: labels,
            datasets: [{
                label: "Data Tahun {{ $_GET['tahun'] }}",
                data: [
                    '{{ $Pendapat_Januari }}',
                    '{{ $Pengeluaran_Januari }}',
                    '{{ $Pendapat_Februari }}',
                    '{{ $Pengeluaran_Februari }}',
                    '{{ $Pendapat_Maret }}',
                    '{{ $Pengeluaran_Maret }}',
                    '{{ $Pendapat_April }}',
                    '{{ $Pengeluaran_April }}',
                    '{{ $Pendapat_Mai }}',
                    '{{ $Pengeluaran_Mai }}',
                    '{{ $Pendapat_Juni }}',
                    '{{ $Pengeluaran_Juni }}',
                    '{{ $Pendapat_Juli }}',
                    '{{ $Pengeluaran_Juli }}',
                    '{{ $Pendapat_Agustus }}',
                    '{{ $Pengeluaran_Agustus }}',
                    '{{ $Pendapat_September }}',
                    '{{ $Pengeluaran_September }}',
                    '{{ $Pendapat_Oktober }}',
                    '{{ $Pengeluaran_Oktober }}',
                    '{{ $Pendapat_November }}',
                    '{{ $Pengeluaran_November }}',
                    '{{ $Pendapat_Desember }}',
                    '{{ $Pengeluaran_Desember }}',
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(75, 192, 192, 0.2)',
                ],
                borderColor: 'rgba(75, 255, 230, 1)',
                borderWidth: 1,
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );


        const data2 = {
            labels: [
                'Greenery plants',
                'Bonsai Plants',
                'Vines Plants',
                'Aglaonema Plants',
                'Taro Plants',
                'Decorative plants',
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [
                    {{ $pie_2 }}, {{ $pie_3 }}, {{ $pie_4 }}, {{ $pie_5 }}, {{ $pie_6 }}, {{ $pie_7 }}
                ],
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(100, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(100, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(100, 205, 86)',
                ],
                hoverOffset: 4
            }]
        };

        const config2 = {
            type: 'doughnut',
            data: data2,
        };

        const myPie = new Chart(
            document.getElementById('myPie'),
            config2
        );
    </script>
@endsection
