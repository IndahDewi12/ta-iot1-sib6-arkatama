@extends('layouts.dashboard')

@section('content')
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
        <div class="col-sm-10 col-md-4">
            <div class="card iq-mb-3">
                <div class="card-body">
                    <h4 class="card-title">Monitoring Sensor Hujan</h4>
                    <p class="card-text">Grafik berikut adalah monitoring sensor hujan 3 menit terakhir.</p>
                    <div id="gaugeRain"></div>
                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        let chartGas, gaugeGas, gaugeHumidity, gaugeTemperature;

        async function requestData() {
            const result = await fetch("{{ route('api.sensors.mq.index') }}");
            if (result.ok) {
                const data = await result.json();
                const sensorData = data.data;

                const date = sensorData[0].created_at;
                const value = sensorData[0].value;

                const point = [new Date(date).getTime(), Number(value)];
                const series = chartGas.series[0],
                    shift = series.data.length > 20;

                chartGas.series[0].addPoint(point, true, shift);
                setTimeout(requestData, 3000);
            }
        }

        async function requestGaugeGas() {
            const result = await fetch("{{ route('api.sensors.mq.index') }}");
            if (result.ok) {
                const data = await result.json();
                const sensorData = data.data;

                const value = sensorData[0].value;

                if (gaugeGas) {
                    gaugeGas.series[0].setData([Number(value)], true, true, true);
                }

                setTimeout(requestGaugeGas, 3000);
            }
        }

        async function requestGaugeHumidity() {
            const result = await fetch("{{ route('api.sensors.dht11.index') }}");
            if (result.ok) {
                const data = await result.json();
                const sensorData = data.data;

                const value = sensorData.humidity;

                if (gaugeHumidity) {
                    gaugeHumidity.series[0].setData([Number(value)], true, true, true);
                }

                setTimeout(requestGaugeHumidity, 3000);
            }
        }

        async function requestGaugeTemperature() {
            const result = await fetch("{{ route('api.sensors.dht11.index') }}");
            if (result.ok) {
                const data = await result.json();
                const sensorData = data.data;

                const value = sensorData.temperature;

                if (gaugeTemperature) {
                    gaugeTemperature.series[0].setData([Number(value)], true, true, true);
                }

                setTimeout(requestGaugeTemperature, 3000);
            }
        }

        async function requestGaugeRain() {
            const result = await fetch("{{ route('api.sensors.rain.index') }}");
            if (result.ok) {
                const data = await result.json();
                const sensorData = data.data;

                const value = sensorData.value;

                if (gaugeRain) {
                    gaugeRain.series[0].setData([Number(value)], true, true, true);
                }

                setTimeout(requestGaugeRain, 3000);
            }
        }
        window.addEventListener('load', function() {
            chartGas = new Highcharts.Chart({
                chart: {
                    renderTo: 'monitoringGas',
                    defaultSeriesType: 'spline',
                    events: {
                        load: requestData
                    }
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Value',
                        margin: 80
                    }
                },
                series: [{
                    name: 'Gas',
                    data: []
                }]
            });

            gaugeGas = new Highcharts.Chart({
                chart: {
                    renderTo: 'gaugeGas',
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: '80%',
                    events: {
                        load: requestGaugeGas
                    }
                },
                title: {
                    text: ''
                },
                pane: {
                    startAngle: -90,
                    endAngle: 89.9,
                    background: null,
                    center: ['50%', '75%'],
                    size: '110%'
                },
                yAxis: {
                    min: 0,
                    max: 1000,
                    tickPixelInterval: 72,
                    tickPosition: 'inside',
                    tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                    tickLength: 20,
                    tickWidth: 2,
                    minorTickInterval: null,
                    labels: {
                        distance: 20,
                        style: {
                            fontSize: '14px'
                        }
                    },
                    lineWidth: 0,
                    plotBands: [{
                        from: 0,
                        to: 199,
                        color: '#55BF3B', // green
                        thickness: 20,
                        borderRadius: '50%'
                    }, {
                        from: 200,
                        to: 299,
                        color: '#DDDF0D', // yellow
                        thickness: 20,
                        borderRadius: '50%'
                    }, {
                        from: 300,
                        to: 1000,
                        color: '#DF5353', // red
                        thickness: 20,
                        borderRadius: '50%'
                    }]
                },
                series: [{
                    name: 'Gas',
                    data: [0],
                    tooltip: {
                        valueSuffix: ' gas'
                    },
                    dataLabels: {
                        format: '{y} gas',
                        borderWidth: 0,
                        color: (
                            Highcharts.defaultOptions.title &&
                            Highcharts.defaultOptions.title.style &&
                            Highcharts.defaultOptions.title.style.color
                        ) || '#333333',
                        style: {
                            fontSize: '16px'
                        }
                    },
                    dial: {
                        radius: '80%',
                        backgroundColor: 'gray',
                        baseWidth: 12,
                        baseLength: '0%',
                        rearLength: '0%'
                    },
                    pivot: {
                        backgroundColor: 'gray',
                        radius: 6
                    }
                }]
            });

            gaugeHumidity = new Highcharts.Chart({
                chart: {
                    renderTo: 'gaugeHumidity',
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: '80%',
                    events: {
                        load: requestGaugeHumidity
                    }
                },
                title: {
                    text: ''
                },
                pane: {
                    startAngle: -90,
                    endAngle: 89.9,
                    background: null,
                    center: ['50%', '75%'],
                    size: '110%'
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickPixelInterval: 10,
                    tickPosition: 'inside',
                    tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                    tickLength: 20,
                    tickWidth: 2,
                    minorTickInterval: null,
                    labels: {
                        distance: 20,
                        style: {
                            fontSize: '14px'
                        }
                    },
                    lineWidth: 0,
                    plotBands: [{
                        from: 0,
                        to: 40,
                        color: '#DF5353', // red
                        thickness: 20,
                        borderRadius: '50%'
                    }, {
                        from: 40,
                        to: 60,
                        color: '#DDDF0D', // yellow
                        thickness: 20,
                        borderRadius: '50%'
                    }, {
                        from: 60,
                        to: 100,
                        color: '#55BF3B', // green
                        thickness: 20,
                        borderRadius: '50%'
                    }]
                },
                series: [{
                    name: 'Humidity',
                    data: [0],
                    tooltip: {
                        valueSuffix: ' %'
                    },
                    dataLabels: {
                        format: '{y} %',
                        borderWidth: 0,
                        color: (
                            Highcharts.defaultOptions.title &&
                            Highcharts.defaultOptions.title.style &&
                            Highcharts.defaultOptions.title.style.color
                        ) || '#333333',
                        style: {
                            fontSize: '16px'
                        }
                    },
                    dial: {
                        radius: '80%',
                        backgroundColor: 'gray',
                        baseWidth: 12,
                        baseLength: '0%',
                        rearLength: '0%'
                    },
                    pivot: {
                        backgroundColor: 'gray',
                        radius: 6
                    }
                }]
            });

            gaugeTemperature = new Highcharts.Chart({
                chart: {
                    renderTo: 'gaugeTemperature',
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: '80%',
                    events: {
                        load: requestGaugeTemperature
                    }
                },
                title: {
                    text: ''
                },
                pane: {
                    startAngle: -90,
                    endAngle: 89.9,
                    background: null,
                    center: ['50%', '75%'],
                    size: '110%'
                },
                yAxis: {
                    min: 0,
                    max: 50,
                    tickPixelInterval: 5,
                    tickPosition: 'inside',
                    tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                    tickLength: 20,
                    tickWidth: 2,
                    minorTickInterval: null,
                    labels: {
                        distance: 20,
                        style: {
                            fontSize: '14px'
                        }
                    },
                    lineWidth: 0,
                    plotBands: [{
                        from: 0,
                        to: 20,
                        color: '#55BF3B', // green
                        thickness: 20,
                        borderRadius: '50%'
                    }, {
                        from: 20,
                        to: 35,
                        color: '#DDDF0D', // yellow
                        thickness: 20,
                        borderRadius: '50%'
                    }, {
                        from: 35,
                        to: 50,
                        color: '#DF5353', // red
                        thickness: 20,
                        borderRadius: '50%'
                    }]
                },
                series: [{
                    name: 'Temperature',
                    data: [0],
                    tooltip: {
                        valueSuffix: ' °C'
                    },
                    dataLabels: {
                        format: '{y} °C',
                        borderWidth: 0,
                        color: (
                            Highcharts.defaultOptions.title &&
                            Highcharts.defaultOptions.title.style &&
                            Highcharts.defaultOptions.title.style.color
                        ) || '#333333',
                        style: {
                            fontSize: '16px'
                        }
                    },
                    dial: {
                        radius: '80%',
                        backgroundColor: 'gray',
                        baseWidth: 12,
                        baseLength: '0%',
                        rearLength: '0%'
                    },
                    pivot: {
                        backgroundColor: 'gray',
                        radius: 6
                    }
                }]
            });

            gaugeRain = new Highcharts.Chart({
                chart: {
                    renderTo: 'gaugeRain',
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: '80%',
                    events: {
                        load: requestGaugeRain
                    }
                },
                title: {
                    text: ''
                },
                pane: {
                    startAngle: -90,
                    endAngle: 89.9,
                    background: null,
                    center: ['50%', '75%'],
                    size: '110%'
                },
                yAxis: {
                    min: 0,
                    max: 100,
                    tickPixelInterval: 10,
                    tickPosition: 'inside',
                    tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                    tickLength: 20,
                    tickWidth: 2,
                    minorTickInterval: null,
                    labels: {
                        distance: 20,
                        style: {
                            fontSize: '14px'
                        }
                    },
                    lineWidth: 0,
                    plotBands: [{
                        from: 0,
                        to: 40,
                        color: '#55BF3B', // green
                        thickness: 20,
                        borderRadius: '50%'
                    }, {
                        from: 40,
                        to: 60,
                        color: '#DDDF0D', // yellow
                        thickness: 20,
                        borderRadius: '50%'
                    }, {
                        from: 60,
                        to: 100,
                        color: '#DF5353', // red
                        thickness: 20,
                        borderRadius: '50%'
                    }]
                },
                series: [{
                    name: 'Rain',
                    data: [0],
                    tooltip: {
                        valueSuffix: ' mm'
                    },
                    dataLabels: {
                        format: '{y} mm',
                        borderWidth: 0,
                        color: (
                            Highcharts.defaultOptions.title &&
                            Highcharts.defaultOptions.title.style &&
                            Highcharts.defaultOptions.title.style.color
                        ) || '#333333',
                        style: {
                            fontSize: '16px'
                        }
                    },
                    dial: {
                        radius: '80%',
                        backgroundColor: 'gray',
                        baseWidth: 12,
                        baseLength: '0%',
                        rearLength: '0%'
                    },
                    pivot: {
                        backgroundColor: 'gray',
                        radius: 6
                    }
                }]
            });
        });
    </script>
@endpush
