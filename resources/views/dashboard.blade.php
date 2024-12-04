@extends('adminlte::page')

@section('title', 'Dashboard Anda')

@section('content_header')
    <h1>Dashboard Anda</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <!-- Grafik Jumlah Input Barang per Hari -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Jumlah Input Barang per Hari</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="dailyChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Grafik Kondisi Barang -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kondisi Barang</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="conditionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data untuk grafik jumlah input barang per hari
            const dailyData = @json($dailyData);
            const dailyLabels = dailyData.map(data => data.date);
            const dailyValues = dailyData.map(data => data.total);

            const dailyChart = new Chart(
                document.getElementById('dailyChart'), {
                    type: 'line',
                    data: {
                        labels: dailyLabels,
                        datasets: [{
                            label: 'Jumlah Input Barang',
                            data: dailyValues,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderWidth: 1,
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                }
            );

            // Data untuk grafik kondisi barang
            const conditionData = @json($kondisiData);
            const conditionLabels = conditionData.map(data => data.kondisi);
            const conditionValues = conditionData.map(data => data.total);

            const conditionChart = new Chart(
                document.getElementById('conditionChart'), {
                    type: 'pie',
                    data: {
                        labels: conditionLabels,
                        datasets: [{
                            data: conditionValues,
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(255, 206, 86, 0.5)',
                                'rgba(153, 102, 255, 0.5)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(153, 102, 255, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: 'bottom' }
                        }
                    }
                }
            );
        });
    </script>
@stop
