<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Customer Management System')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/splash-screen.css') }}" rel="stylesheet">

    <style>
        :root {
            --cms-primary: #0d6efd;
            --cms-sidebar-width: 260px;
        }

        body {
            background-color: #f4f7fb;
            color: #263238;
        }

        a,
        button,
        .form-control,
        .form-select {
            transition: all .18s ease-in-out;
        }

        a:focus-visible,
        button:focus-visible,
        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .18);
        }

        .navbar {
            min-height: 64px;
        }

        .brand-mark {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background-color: rgba(13, 110, 253, .12);
            color: var(--cms-primary);
        }

        .app-shell {
            min-height: calc(100vh - 64px);
        }

        .app-sidebar {
            width: var(--cms-sidebar-width);
            background-color: #ffffff;
            border-right: 1px solid #e5e9f0;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            color: #52616f;
            border-radius: 8px;
            padding: .75rem 1rem;
            text-decoration: none;
            font-weight: 500;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            color: var(--cms-primary);
            background-color: rgba(13, 110, 253, .1);
        }

        .sidebar-link i {
            font-size: 1.1rem;
        }

        .content-wrapper {
            min-width: 0;
        }

        .card {
            border-radius: 12px;
        }

        .shadow-soft {
            box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .table {
            --bs-table-hover-bg: rgba(13, 110, 253, .045);
        }

        .table th {
            color: #52616f;
            font-size: .78rem;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .empty-state-icon {
            width: 72px;
            height: 72px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: rgba(13, 110, 253, .1);
            color: var(--cms-primary);
            font-size: 2rem;
        }

        .stat-card {
            border: 0;
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 52px;
            border-radius: 12px;
            background-color: rgba(13, 110, 253, .1);
            color: var(--cms-primary);
            font-size: 1.35rem;
        }

        .stat-icon-primary {
            background-color: rgba(13, 110, 253, .12);
            color: #0d6efd;
        }

        .stat-icon-success {
            background-color: rgba(25, 135, 84, .12);
            color: #198754;
        }

        .stat-icon-secondary {
            background-color: rgba(108, 117, 125, .14);
            color: #6c757d;
        }

        .stat-icon-info {
            background-color: rgba(13, 202, 240, .15);
            color: #087990;
        }

        .avatar-placeholder {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: var(--cms-primary);
            color: #ffffff;
            font-weight: 700;
        }

        .avatar-button {
            border: 0;
            border-radius: 50%;
            padding: 0;
            background: transparent;
        }

        .avatar-button::after {
            display: none;
        }

        .notification-dropdown {
            width: min(360px, calc(100vw - 2rem));
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 40px;
            border-radius: 10px;
            background-color: rgba(13, 110, 253, .1);
            color: var(--cms-primary);
            font-size: 1.1rem;
        }

        .notification-item.unread {
            background-color: rgba(13, 110, 253, .045);
        }

        .notification-title.unread {
            font-weight: 700;
        }

        @media (min-width: 992px) {
            .desktop-sidebar {
                display: block;
                flex: 0 0 var(--cms-sidebar-width);
            }
        }
    </style>
</head>
<body>
    @if (request()->routeIs('dashboard'))
        @include('partials.splash-screen')
    @endif

    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container-fluid px-3 px-lg-4">
            <button class="btn btn-outline-primary d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar" aria-label="Open menu">
                <i class="bi bi-list"></i>
            </button>

            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-primary" href="#">
                <span class="brand-mark">
                    <i class="bi bi-people-fill"></i>
                </span>
                <span>Customer Management System</span>
            </a>

            <div class="ms-auto d-flex align-items-center gap-3">
                <div class="dropdown">
                    <button
                        class="btn btn-light position-relative"
                        type="button"
                        id="notificationDropdown"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="outside"
                        aria-expanded="false"
                        aria-label="Notifications"
                    >
                        <i class="bi bi-bell"></i>
                        @if ($unreadNotificationsCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary" id="notificationUnreadBadge">
                                {{ $unreadNotificationsCount }}
                                <span class="visually-hidden">unread notifications</span>
                            </span>
                        @endif
                    </button>

                    <div class="dropdown-menu dropdown-menu-end notification-dropdown border-0 shadow-soft p-0" aria-labelledby="notificationDropdown">
                        <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom">
                            <h2 class="h6 fw-bold mb-0">Notifications</h2>
                            @if ($unreadNotificationsCount > 0)
                                <span class="badge text-bg-primary" id="notificationUnreadText">{{ $unreadNotificationsCount }} unread</span>
                            @endif
                        </div>

                        @if ($recentNotifications->isEmpty())
                            <div class="text-center text-muted py-4 px-3">
                                <i class="bi bi-bell d-block fs-3 mb-2"></i>
                                No notifications available.
                            </div>
                        @else
                            <div class="list-group list-group-flush">
                                @foreach ($recentNotifications as $notification)
                                    <div class="list-group-item notification-item {{ $notification['unread'] ? 'unread' : '' }}">
                                        <div class="d-flex gap-3">
                                            <div class="notification-icon text-{{ $notification['type'] }}">
                                                <i class="bi bi-{{ $notification['icon'] }}"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between gap-2">
                                                    <h3 class="h6 mb-1 notification-title {{ $notification['unread'] ? 'unread' : '' }}">{{ $notification['title'] }}</h3>
                                                    @if ($notification['unread'])
                                                        <span class="badge text-bg-primary align-self-start">New</span>
                                                    @endif
                                                </div>
                                                <p class="small text-muted mb-1">{{ $notification['message'] }}</p>
                                                <div class="small text-muted">
                                                    {{ $notification['time'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="p-3 border-top">
                            <a href="{{ route('notifications.index') }}" class="btn btn-primary w-100">
                                <i class="bi bi-list-ul me-1"></i>
                                View All Notifications
                            </a>
                        </div>
                    </div>
                </div>

                <div class="dropdown">
                    <button
                        class="avatar-button dropdown-toggle"
                        type="button"
                        id="profileDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        aria-label="Open profile menu"
                    >
                        <span class="avatar-placeholder">U</span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-soft" aria-labelledby="profileDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('profile') }}">
                                <i class="bi bi-person-circle"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('settings') }}">
                                <i class="bi bi-gear"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('about') }}">
                                <i class="bi bi-info-circle"></i>
                                <span>About System</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <button
                                class="dropdown-item d-flex align-items-center gap-2 text-danger"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#logoutDemoModal"
                            >
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout (Demo)</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="app-shell d-flex">
        <aside class="app-sidebar desktop-sidebar d-none d-lg-block">
            <div class="p-3">
                <div class="text-uppercase text-muted small fw-semibold px-2 mb-2">Navigation</div>

                <nav class="d-grid gap-1">
                    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('customers.index') }}" class="sidebar-link {{ request()->routeIs('customers.index') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Customers</span>
                    </a>
                </nav>
            </div>
        </aside>

        <div class="offcanvas offcanvas-start app-sidebar" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title text-primary fw-bold" id="mobileSidebarLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                <div class="p-3">
                    <div class="text-uppercase text-muted small fw-semibold px-2 mb-2">Navigation</div>

                    <nav class="d-grid gap-1">
                        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('customers.index') }}" class="sidebar-link {{ request()->routeIs('customers.index') ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            <span>Customers</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <main class="content-wrapper flex-grow-1">
            <div class="container-fluid p-3 p-lg-4">
                @foreach (['success' => 'check-circle', 'error' => 'exclamation-octagon', 'warning' => 'exclamation-triangle'] as $type => $icon)
                    @if (session($type))
                        <div class="alert alert-{{ $type === 'error' ? 'danger' : $type }} alert-dismissible fade show shadow-sm" role="alert">
                            <i class="bi bi-{{ $icon }} me-2"></i>
                            {{ session($type) }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close alert"></button>
                        </div>
                    @endif
                @endforeach

                @yield('content')
            </div>
        </main>
    </div>

    <footer class="bg-white border-top py-3">
        <div class="container-fluid px-3 px-lg-4 text-center text-muted small">
            &copy; {{ date('Y') }} Customer Management System. All rights reserved.
        </div>
    </footer>

    <div class="modal fade" id="logoutDemoModal" tabindex="-1" aria-labelledby="logoutDemoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-soft">
                <div class="modal-header">
                    <h2 class="modal-title h5 fw-bold" id="logoutDemoModalLabel">Demo Project</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close logout message"></button>
                </div>
                <div class="modal-body">
                    Authentication is not implemented in this project.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/splash-screen.js') }}"></script>
    <script>
        document.querySelectorAll('form[data-disable-on-submit="true"]').forEach((form) => {
            form.addEventListener('submit', (event) => {
                if (form.dataset.submitting === 'true') {
                    event.preventDefault();
                    return;
                }

                const button = form.querySelector('[data-loading-text]');

                if (!button) {
                    return;
                }

                form.dataset.submitting = 'true';
                button.disabled = true;
                button.dataset.originalText = button.innerHTML;
                button.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-1" aria-hidden="true"></span>
                    <span>${button.dataset.loadingText}</span>
                `;
            });
        });

    </script>
</body>
</html>
