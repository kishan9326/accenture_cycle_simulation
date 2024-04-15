@extends('layouts.master')
@section('content')
    <main class="content">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center mb-3" style="height: 90%">
                    <div class="p-2">
                        <h1 class="text-center mb-5"><strong>Home Page</strong></h1>
                        <div class="d-flex align-content-center flex-wrap mb-3">
                            <div class="p-2 col-3 text-center hover">
                                <a href="{{ route('profile-management.index') }}" class="text-decoration-none">
                                    <div class="pt-4 pb-4 hover-border shadow-lg rounded">
                                        <img src="{{ asset('public/images/profile.png') }}" class="img-fluid pe-2 w-25" />
                                        <p class="mt-3 mb-0">Profile Management</p>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2 col-3 text-center hover">
                                <a href="{{ route('category-management.index') }}" class="text-decoration-none">
                                    <div class="pt-4 pb-4 hover-border shadow-lg rounded">
                                        <img src="{{ asset('public/images/menu.png') }}" class="img-fluid pe-2 w-25" />
                                        <p class="mt-3 mb-0">Category Management</p>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2 col-3 text-center hover">
                                <a href="{{ route('data-management.index') }}" class="text-decoration-none">
                                    <div class="pt-4 pb-4 hover-border shadow-lg rounded">
                                        <img src="{{ asset('public/images/image.png') }}" class="img-fluid pe-2 w-25" />
                                        <p class="mt-3 mb-0">Data Management</p>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2 col-3 text-center hover">
                                <a href="{{ route('leaderboard.index') }}" class="text-decoration-none">
                                    <div class="pt-4 pb-4 hover-border shadow-lg rounded">
                                        <img src="{{ asset('public/images/leaderboard.png') }}"
                                            class="img-fluid pe-2 w-25" />
                                        <p class="mt-3 mb-0">Leaderboard Management</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
   
@endsection
