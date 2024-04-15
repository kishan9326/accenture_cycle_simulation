<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cycle Simulator</title>
    <link href="{{ asset('public/css/light.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/flatpickr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/style.css?ver=' . time()) }}" rel="stylesheet">
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">
        {{-- URL:{{ Route::getCurrentRoute()->uri }} --}}
        @if (Route::getCurrentRoute()->uri !== '/' &&
                Route::getCurrentRoute()->uri !== 'login' &&
                Route::getCurrentRoute()->uri !== 'forgotpassword' &&
                Route::getCurrentRoute()->uri !== 'forgotpassword/{forgotpassword}'
            )
            @include('layouts.sidebar')
        @endif
        <div class="main">
            @if (Route::getCurrentRoute()->uri !== '/' &&
                    Route::getCurrentRoute()->uri !== 'login' &&
                    Route::getCurrentRoute()->uri !== 'forgotpassword' && 
                    Route::getCurrentRoute()->uri !== 'forgotpassword/{forgotpassword}')
                <nav class="navbar navbar-expand navbar-light navbar-bg">
                    <a class="sidebar-toggle js-sidebar-toggle">
                        <i class="hamburger align-self-center"></i>
                    </a>
                    <div class="navbar-collapse collapse">
                        <ul class="navbar-nav navbar-align">
                            <li class="nav-item dropdown">
                                <a class="nav-icon pe-md-0 dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <img src="{{ asset('public/images/avatar.jpg') }}" class="avatar img-fluid rounded" alt="Avatar">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <p class="p-2">Hello {{ Auth::id() ? Auth::user()->full_name: ' Guest' }}</p>
                                    <a class="dropdown-item" href="{{ route('user.index') }}">
                                        <i class="align-middle me-2 fas fa-fw fa-user-shield"></i> User
                                    </a>
                                    <form class="dropdown-item" action="{{ route('login.logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn p-0">
                                            <i class="align-middle me-2 fas fa-fw fa-sign-out-alt"></i> Log out
                                        </button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            @endif
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/js/flatpickr.js') }}"></script>
    <script type="text/javascript">
        const baseUrl = "{{ url('/') }}";
        const segment1 = "{{ !empty(Request::segment(1)) ? Request::segment(1) : '' }}";
    </script>
    <script src="{{ asset('public/js/main.js?ver=' . time()) }}"></script>
</body>

</html>
