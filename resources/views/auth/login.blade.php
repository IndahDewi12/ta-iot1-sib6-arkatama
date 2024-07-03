@extends('layouts.auth')
@section('content')
    <!-- Sign in Start -->
    <section class="sign-in-page bg-white d-flex align-items-center justify-content-center">
        <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="row justify-content-center w-100">
                <div class="col-md-6">
                    <div class="sign-in-from">
                        <h1 class="mb-0">Sign in</h1>
                        <p>Masukkan Email dan Kata Sandi Anda!</p>

                        @include('layouts.dashboard.alerts.danger-alert')

                        <form class="mt-4" action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" type="email" class="form-control mb-0" id="exampleInputEmail1"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <a href="#" class="float-right">Lupa Password?</a>
                                <input name="password" type="password" class="form-control mb-0" id="exampleInputPassword1"
                                    placeholder="Password">
                            </div>
                            <div class="d-inline-block w-100">
                                <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                    <input name="remember"type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Ingat Saya</label>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Sign in</button>
                            </div>
                            <div class="sign-info">
                                <span class="dark-color d-inline-block line-height-2">Belum punya akun? <a
                                        href="{{ route('register') }}">Sign up</a></span>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sign in END -->
@endsection
