@extends('layouts.auth')
@section('content')
    <!-- Sign in Start -->
    <section class="sign-in-page bg-white d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="sign-in-from">
                        <h1 class="mb-0">Sign Up</h1>
                        <p>Masukkan Email dan Kata Sandi Anda!</p>

                        @include('layouts.dashboard.alerts.danger-alert')

                        <form class="mt-4" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Lengkap</label>
                                <input name="name" type="text" class="form-control mb-0" id="exampleInputEmail1"
                                    placeholder="Your Full Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail2">Email address</label>
                                <input name="email" type="email" class="form-control mb-0" id="exampleInputEmail2"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input name="password" type="password" class="form-control mb-0" id="exampleInputPassword1"
                                    placeholder="Password">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Password Confirmation</label>
                                <input name="password_confirmation" type="password" class="form-control mb-0"
                                    id="exampleInputPassword1" placeholder="Password">
                            </div>

                            <div class="d-inline-block w-100">
                                <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Saya menerima <a
                                            href="#">syarat dan ketentuan</a></label>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Sign Up</button>
                            </div>
                            <div class="sign-info">
                                <span class="dark-color d-inline-block line-height-2">Sudah memiliki akun? <a
                                        href="{{ route('login') }}">Log In</a></span>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sign in END -->
@endsection
