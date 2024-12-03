@extends('adminlte::page')

@section('title', 'Dashboard Penerimaan Barang')

@section('content_header')
    <h1 class="text-dark">Dashboard Penerimaan Barang</h1>
@stop

@section('content')
    <form id="chat-form">
        <input type="text" id="message" placeholder="Ketik pertanyaan Anda..." required>
        <button type="submit">Tanya</button>
    </form>
    <div id="chat-log"></div>

    <script>
        document.getElementById('chat-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const message = document.getElementById('message').value;

            // Kirim pesan ke backend
            const response = await fetch('{{ route('chatbot.reply') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    message
                })
            });

            const data = await response.json();

            // Tampilkan pesan di log
            document.getElementById('chat-log').innerHTML += `<p>User: ${message}</p>`;
            document.getElementById('chat-log').innerHTML += `<p>Bot: ${data.response}</p>`;
            document.getElementById('message').value = '';
        });
    </script>

    <div class="container-fluid">
        {{-- Row untuk grafik supplier dan kondisi --}}
        <div class="row mt-4">
            {{-- Grafik Penerimaan per Supplier --}}
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-chart-bar mr-2"></i>Jumlah Penerimaan per Supplier
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="supplierChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            {{-- Grafik Kondisi Barang --}}
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-chart-pie mr-2"></i>Kondisi Barang
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="kondisiChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Row untuk grafik bulanan --}}
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-chart-line mr-2"></i>Total Penerimaan per Bulan
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .card {
            border-radius: 10px;
            border: none;
        }

        .card-header {
            border-radius: 10px 10px 0 0 !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        canvas {
            max-width: 100%;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Konfigurasi umum untuk Chart.js
            const commonOptions = {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            };

            // Grafik Supplier
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
                        ...commonOptions,
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

            // Grafik Kondisi
            const kondisiChart = new Chart(
                document.getElementById('kondisiChart'), {
                    type: 'pie',
                    data: {
                        labels: {!! json_encode($kondisiData->pluck('kondisi')) !!},
                        datasets: [{
                            data: {!! json_encode($kondisiData->pluck('total')) !!},
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(255, 99, 132, 0.7)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        ...commonOptions,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                }
            );

            // Grafik Bulanan
            const monthlyChart = new Chart(
                document.getElementById('monthlyChart'), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($monthlyData->pluck('date')) !!},
                        datasets: [{
                            label: 'Total Penerimaan',
                            data: {!! json_encode($monthlyData->pluck('total')) !!},
                            fill: true,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            tension: 0.4,
                            pointRadius: 4,
                            pointBackgroundColor: 'rgba(75, 192, 192, 1)'
                        }]
                    },
                    options: {
                        ...commonOptions,
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    maxTicksLimit: 10, // Membatasi jumlah label di axis X
                                    maxRotation: 45, // Memutar label untuk readability
                                    minRotation: 45
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    title: function(tooltipItems) {
                                        return 'Tanggal: ' + tooltipItems[0].label;
                                    },
                                    label: function(context) {
                                        return 'Total Penerimaan: ' + context.raw;
                                    }
                                }
                            }
                        }
                    }
                }
            );
        });
    </script>
@stop
