@extends('layouts.dashboard')

{{-- @section('content')
    <div class="row">
        <!-- Gas Sensor Monitoring -->
        <div class="col-sm-12 col-md-6">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor Gas</h4>
                    <p class="card-text">Grafik berikut adalah monitoring sensor gas 3 menit terakhir.</p>
                    <div id="monitoringGas"></div>
                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div>
        <div class="col-sm-10 col-md-5">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor Gas</h4>
                    <p class="card-text">Grafik berikut adalah monitoring sensor gas 3 menit terakhir.</p>
                    <div id="gaugeGas"></div>
                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div>

        <!-- DHT11 Sensor Monitoring (Humidity) -->
        <div class="col-sm-10 col-md-4">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Kelembaban (DHT11)</h4>
                    <p class="card-text">Grafik berikut adalah monitoring kelembaban sensor DHT11 3 menit terakhir.</p>
                    <div id="gaugeHumidity"></div>
                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div>

        <!-- DHT11 Sensor Monitoring (Temperature) -->
        <div class="col-sm-10 col-md-4">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Suhu (DHT11)</h4>
                    <p class="card-text">Grafik berikut adalah monitoring suhu sensor DHT11 3 menit terakhir.</p>
                    <div id="gaugeTemperature"></div>
                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div>

        <!-- Rain sensor -->
        {{-- <div class="col-sm-10 col-md-4">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor Hujan</h4>
                    <p class="card-text">Grafik berikut adalah monitoring sensor hujan 3 menit terakhir.</p>
                    <div id="gaugeRain"></div>
                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div> --}}
</div>
{{-- @endsection  --}}

{{-- @push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Highcharts.chart('gaugeGas', {
                chart: {
                    type: 'gauge',
                    backgroundColor: '#f9f9f9',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false
                },
                title: {
                    text: ''
                },
                pane: {
                    startAngle: -150,
                    endAngle: 150,
                    background: [{
                        backgroundColor: '#f9f9f9',
                        outerRadius: '105%',
                        innerRadius: '100%',
                        borderWidth: 0
                    }]
                },
                yAxis: {
                    min: 0,
                    max: 1000,
                    minorTickInterval: 'auto',
                    minorTickWidth: 1,
                    minorTickLength: 10,
                    minorTickPosition: 'inside',
                    minorTickColor: '#666',
                    tickPixelInterval: 72,
                    tickWidth: 2,
                    tickPosition: 'inside',
                    tickLength: 10,
                    tickColor: '#666',
                    labels: {
                        step: 2,
                        rotation: 'auto',
                        style: {
                            color: '#333'
                        }
                    },
                    title: {
                        text: 'Gas',
                        style: {
                            color: '#333'
                        }
                    },
                    plotBands: [{
                        from: 0,
                        to: 199,
                        color: '#55BF3B', // green
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }, {
                        from: 200,
                        to: 299,
                        color: '#DDDF0D', // yellow
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }, {
                        from: 300,
                        to: 1000,
                        color: '#DF5353', // red
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }]
                },
                series: [{
                    name: 'Gas',
                    data: [0],
                    tooltip: {
                        valueSuffix: ' gas'
                    }
                }]
            });

            Highcharts.chart('gaugeHumidity', {
                chart: {
                    type: 'gauge',
                    backgroundColor: '#f9f9f9',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false
                },
                title: {
                    text: ''
                },
                pane: {
                    startAngle: -150,
                    endAngle: 150,
                    background: [{
                        backgroundColor: '#f9f9f9',
                        outerRadius: '105%',
                        innerRadius: '100%',
                        borderWidth: 0
                    }]
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    minorTickInterval: 'auto',
                    minorTickWidth: 1,
                    minorTickLength: 10,
                    minorTickPosition: 'inside',
                    minorTickColor: '#666',
                    tickPixelInterval: 72,
                    tickWidth: 2,
                    tickPosition: 'inside',
                    tickLength: 10,
                    tickColor: '#666',
                    labels: {
                        step: 2,
                        rotation: 'auto',
                        style: {
                            color: '#333'
                        }
                    },
                    title: {
                        text: 'Humidity',
                        style: {
                            color: '#333'
                        }
                    },
                    plotBands: [{
                        from: 0,
                        to: 50,
                        color: '#55BF3B', // green
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }, {
                        from: 51,
                        to: 70,
                        color: '#DDDF0D', // yellow
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }, {
                        from: 71,
                        to: 100,
                        color: '#DF5353', // red
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }]
                },
                series: [{
                    name: 'Humidity',
                    data: [0],
                    tooltip: {
                        valueSuffix: ' %'
                    }
                }]
            });

            Highcharts.chart('gaugeTemperature', {
                chart: {
                    type: 'gauge',
                    backgroundColor: '#f9f9f9',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false
                },
                title: {
                    text: ''
                },
                pane: {
                    startAngle: -150,
                    endAngle: 150,
                    background: [{
                        backgroundColor: '#f9f9f9',
                        outerRadius: '105%',
                        innerRadius: '100%',
                        borderWidth: 0
                    }]
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    minorTickInterval: 'auto',
                    minorTickWidth: 1,
                    minorTickLength: 10,
                    minorTickPosition: 'inside',
                    minorTickColor: '#666',
                    tickPixelInterval: 72,
                    tickWidth: 2,
                    tickPosition: 'inside',
                    tickLength: 10,
                    tickColor: '#666',
                    labels: {
                        step: 2,
                        rotation: 'auto',
                        style: {
                            color: '#333'
                        }
                    },
                    title: {
                        text: 'Temperature',
                        style: {
                            color: '#333'
                        }
                    },
                    plotBands: [{
                        from: 0,
                        to: 20,
                        color: '#55BF3B', // green
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }, {
                        from: 21,
                        to: 30,
                        color: '#DDDF0D', // yellow
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }, {
                        from: 31,
                        to: 100,
                        color: '#DF5353', // red
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }]
                },
                series: [{
                    name: 'Temperature',
                    data: [0],
                    tooltip: {
                        valueSuffix: ' °C'
                    }
                }]
            });

            Highcharts.chart('gaugeRain', {
                chart: {
                    type: 'gauge',
                    backgroundColor: '#f9f9f9',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false
                },
                title: {
                    text: ''
                },
                pane: {
                    startAngle: -150,
                    endAngle: 150,
                    background: [{
                        backgroundColor: '#f9f9f9',
                        outerRadius: '105%',
                        innerRadius: '100%',
                        borderWidth: 0
                    }]
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    minorTickInterval: 'auto',
                    minorTickWidth: 1,
                    minorTickLength: 10,
                    minorTickPosition: 'inside',
                    minorTickColor: '#666',
                    tickPixelInterval: 72,
                    tickWidth: 2,
                    tickPosition: 'inside',
                    tickLength: 10,
                    tickColor: '#666',
                    labels: {
                        step: 2,
                        rotation: 'auto',
                        style: {
                            color: '#333'
                        }
                    },
                    title: {
                        text: 'Rain',
                        style: {
                            color: '#333'
                        }
                    },
                    plotBands: [{
                        from: 0,
                        to: 20,
                        color: '#55BF3B', // green
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }, {
                        from: 21,
                        to: 50,
                        color: '#DDDF0D', // yellow
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }, {
                        from: 51,
                        to: 100,
                        color: '#DF5353', // red
                        innerRadius: '100%',
                        outerRadius: '105%'
                    }]
                },
                series: [{
                    name: 'Rain',
                    data: [0],
                    tooltip: {
                        valueSuffix: ' mm'
                    }
                }]
            });
        });
    </script>
@endpush --}}
