@extends('layouts.master')
@section('content')
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="{{ asset('public/images/avatar.jpg') }}" alt="Avatar" class="img-fluid rounded-circle" width="100" height="100" />
                                    </div>
                                    <div class="text-center">
                                        <h1>Reset password</h1>
                                        <h6 class="">Enter the email address with your account and we'll send you a link to reset your password.</h6>
                                    </div>
                                    <form method="post" action="{{ route('forgotpassword.store') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input class="form-control form-control-lg" type="email" name="email"
                                                placeholder="Enter your email" />
                                            @error('email')
                                                <div class="small text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <div class="">
                                                <button type="submit"
                                                    class="btn btn-lg btn-primary full-width-button">Continue</button>
                                            </div>
                                            @if (session()->has('success'))
                                                <div class="shadow-lg p-3 mt-2 bg-body rounded">
                                                    <div class="text-success">
                                                        {{ session()->get('success') }}
                                                    </div>
                                                </div>
                                            @endif
                                            @if (session()->has('error'))
                                                <div class="shadow-lg p-3 mt-2 bg-body rounded">
                                                    <div class="text-danger">
                                                        {{ session()->get('error') }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="p-2">
                                <h6> Do you have password?<a href="{{ route('login.index') }}"> Login</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
