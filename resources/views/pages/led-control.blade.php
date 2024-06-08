@extends('layouts.dashboard')

@section('title_menu', 'LED Control')

@section('content')
    {{-- <div class="card w-100">
        <div class="card-body">
            <h5 class="card-title">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus"></i>
                    Tambah LED
                </button>
            </h5>

            <div class="row my-4">
                @foreach ($leds as $led)
                    <div class="col-sm-6 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex w-100 justify-content-between">
                                    <div
                                        class="d-flex align-items-start
                                    @if ($led->status == '1') text-primary @endif
                                    ">
                                        <i class="fas fa-lightbulb fa-fw fa-3x"></i>
                                        <div>
                                            <h6 class="p-0 m-0 fw-bold">{{ $led->name }}</h6>
                                            <p class="p-0 m-0 text-muted">Pin: {{ $led->pin }}</p>

                                            <div>
                                                <div class="ms-3 form-check form-switch">
                                                    <input @checked($led->status == '1') class="form-check-input"
                                                        type="checkbox" id="flexSwitchCheckDefault">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <i class="fas fa-ellipsis-v fa-fw" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-expanded="false"></i>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item" href="#">Delete</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('led.store') }}" method="POST">
                <div class="modal-content">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add LED</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">LED Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama LED">
                        </div>

                        <div class="mb-3">
                            <label for="pin" class="form-label">LED Pin</label>
                            <input type="number" class="form-control" name="pin" id="pin" placeholder="Nama LED">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}

@endsection
