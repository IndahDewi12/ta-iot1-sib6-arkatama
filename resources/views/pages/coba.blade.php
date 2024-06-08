@extends('layouts.dashboard')

@section('content')
    <h3>Dashboard</h3>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                <div class="iq-card-body pb-0">
                    <span class="float-center line-height-6">Sensor DHT 11</span>
                    <div class="clearfix"></div>
                    <div class="text-center">
                        <h4><span>Suhu dan Kelembapan</span></h4>
                        <p class="mb-0 text-secondary line-height"></i></p>
                    </div>
                </div>
                <div id="chart-1"></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                <div class="iq-card-body pb-0">
                    <span class="line-height-6">Sensor MQ-2</span>
                    <div class="clearfix"></div>
                    <div class="text-center">
                        <h4><span>Konsentrasi Gas</span></h4>
                        <p class="mb-0 text-secondary line-height"></i></p>
                    </div>
                </div>
                <div id="chart-2"></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                <div class="iq-card-body pb-0">
                    <span class="float-left line-height-6">Sensor Hujan</span>
                    <div class="clearfix"></div>
                    <div class="text-center">
                        <h4><span>Status</span></h4>
                        <p class="mb-0 text-secondary line-height"></p>
                    </div>
                </div>
                <div id="chart-3"></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                <div class="iq-card-body pb-0">
                    <span class="float-left line-height-6">LED</span>
                    <div class="clearfix"></div>
                    <div class="text-center">
                        <h4><span>Kondisi</span></h4>
                        <p class="mb-0 text-secondary line-height"></p>
                    </div>
                </div>
                <div id="chart-4"></div>
            </div>
        </div>
    </div>
@endsection
