@extends('adminlte::page')

@section('title', 'Dashboard Penerimaan Barang')

@section('content_header')
    <h1>Dashboard Penerimaan Barang</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <!-- Grafik Kinerja Supplier -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kinerja per Supplier</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="supplierChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Grafik Kinerja User -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kinerja per User</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="userChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Grafik Tren Penerimaan Bulanan -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tren Penerimaan per Bulan</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Grafik Kondisi Barang -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kondisi Barang</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="kondisiChart"></canvas>
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
            // Data untuk grafik supplier
            const supplierChart = new Chart(
                document.getElementById('supplierChart'), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($supplierData->pluck('label')) !!},
                        datasets: [{
                            label: 'Jumlah Penerimaan',
                            data: {!! json_encode($supplierData->pluck('value')) !!},
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
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

            // Data untuk grafik kinerja user
            const userChart = new Chart(
                document.getElementById('userChart'), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($userData->pluck('label')) !!},
                        datasets: [{
                            label: 'Jumlah Input Barang',
                            data: {!! json_encode($userData->pluck('value')) !!},
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
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

            // Data untuk grafik tren penerimaan bulanan
            const monthlyChart = new Chart(
                document.getElementById('monthlyChart'), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($monthlyData->pluck('month')) !!},
                        datasets: [{
                            label: 'Total Penerimaan',
                            data: {!! json_encode($monthlyData->pluck('total')) !!},
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
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
            const kondisiChart = new Chart(
                document.getElementById('kondisiChart'), {
                    type: 'pie',
                    data: {
                        labels: {!! json_encode($kondisiData->pluck('kondisi')) !!},
                        datasets: [{
                            data: {!! json_encode($kondisiData->pluck('total')) !!},
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(255, 99, 132, 0.5)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true
                    }
                }
            );
        });
    </script>
@stop
