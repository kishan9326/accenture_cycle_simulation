<?php
$controllerAction = Route::currentRouteName();
[$controller, $action] = explode('.', $controllerAction);
?>
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar sidebar-bg-color">
        <a class="sidebar-brand" href="{{ route('profile-management.index') }}">
            <div class="text-center">
                <img src="{{ asset('public/images/loginlogoWhite.png') }}" alt="Avatar" class="img-fluid " width="132"
                    height="132" />
            </div>
            <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24"
                fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter"
                color="#FFFFFF" style="margin-left: -3px">
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
        </a>
        <ul class="sidebar-nav mt-3">
            <li class="sidebar-item {{ $controller === 'profile-management' ? 'active sidebar-highlight-li' : '' }}">
                <a class="sidebar-link {{ $controller === 'profile-management' ? 'sidebar-highlight-a' : '' }}"
                    href="{{ route('profile-management.index') }}">
                    <i class="align-middle text-white" data-feather="users"></i>
                    <span class="align-middle text-white ">Profile Management</span>
                </a>
            </li>
            <li class="sidebar-item  {{ $controller === 'category-management' ? 'active sidebar-highlight-li' : '' }}">
                <a class="sidebar-link {{ $controller === 'category-management' ? 'sidebar-highlight-a' : '' }}"
                    href="{{ route('category-management.index', ['cat_id' => 1]) }}">
                    <i class="align-middle text-white" data-feather="grid"></i>
                    <span class="align-middle text-white">Category Management</span>
                </a>
            </li>
            <li class="sidebar-item {{ $controller === 'data-management' ? 'active sidebar-highlight-li' : '' }}">
                <a class="sidebar-link {{ $controller === 'data-management' ? 'sidebar-highlight-a' : '' }}" href="{{ route('data-management.index', 'env=central_park') }}">
                    <i class="align-middle text-white" data-feather="airplay"></i>
                    <span class="align-middle text-white ">Data Management</span>
                </a>
            </li>
            <li class="sidebar-item {{ $controller === 'leaderboard' ? 'active sidebar-highlight-li' : '' }}">
                <a class="sidebar-link {{ $controller === 'leaderboard' ? 'sidebar-highlight-a' : '' }}"
                    href="{{ route('leaderboard.index') }}">
                    <i class="align-middle text-white" data-feather="award"></i>
                    <span class="align-middle text-white">Leaderboard Management</span>
                </a>
            </li>
            {{-- <li class="sidebar-item {{ $controller === 'user' ? 'active sidebar-highlight-li' : '' }}">
                <a data-bs-target="#user-sidebar" data-bs-toggle="collapse"
                    class="sidebar-link {{ $controller === 'user' ? 'sidebar-highlight-a' : '' }}">
                    <i class="align-middle text-white" data-feather="user-plus"></i>
                    <span class="align-middle text-white">User</span>
                </a>
                <ul id="user-sidebar"
                    class="sidebar-dropdown list-unstyled collapse {{ $controller === 'user' ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ $controller === 'user' && $action === 'create' ? 'active' : '' }}">
                        <a class="sidebar-link text-white" href="{{ route('user.create') }}">Add User</a>
                    </li>
                    <li class="sidebar-item {{ $controller === 'user' && $action === 'index' ? 'active' : '' }}">
                        <a class="sidebar-link text-white" href="{{ route('user.index') }}">User List</a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </div>
</nav>
