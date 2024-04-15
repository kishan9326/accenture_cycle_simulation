@extends('layouts.master')
@section('content')
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-8 col-md-6 col-lg-4 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="{{ asset('public/images/avatar.jpg') }}" alt="Avatar"
                                            class="img-fluid rounded-circle" width="132" height="132" />
                                    </div>
                                    <div class="text-center">
                                        <h1>Reset Password</h1>
                                    </div>
                                    <form method="post" action="{{ route('forgotpassword.update', $forgot_password->user_id) }}">
                                        @csrf
                                        @method('PATCH')                                        
                                        <div class="mb-3">
                                            <input class="form-control form-control-lg" type="password" name="password"
                                                placeholder="Enter your password" />
                                            @error('password')
                                                <div class="small text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control form-control-lg" type="password" name="password_confirmation"
                                                placeholder="Enter your password" />
                                            @error('password_confirmation')
                                                <div class="small text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <div class="d-flex align-content-center flex-wrap">
                                                <div>
                                                    <button type="submit" class="btn btn-lg btn-primary">Reset</button>
                                                </div>
                                            </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
