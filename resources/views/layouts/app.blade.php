<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Customer Management System')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --cms-primary: #0d6efd;
            --cms-sidebar-width: 260px;
        }

        body {
            background-color: #f4f7fb;
            color: #263238;
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

        .stat-card {
            border: 0;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .06);
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background-color: rgba(13, 110, 253, .1);
            color: var(--cms-primary);
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

        @media (min-width: 992px) {
            .desktop-sidebar {
                display: block;
                flex: 0 0 var(--cms-sidebar-width);
            }
        }
    </style>
</head>
<body>
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
                <button class="btn btn-light position-relative" type="button" aria-label="Notifications">
                    <i class="bi bi-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-primary border border-light rounded-circle">
                        <span class="visually-hidden">New notifications</span>
                    </span>
                </button>

                <div class="avatar-placeholder" aria-label="User avatar">U</div>
            </div>
        </div>
    </nav>

    <div class="app-shell d-flex">
        <aside class="app-sidebar desktop-sidebar d-none d-lg-block">
            <div class="p-3">
                <div class="text-uppercase text-muted small fw-semibold px-2 mb-2">Navigation</div>

                <nav class="d-grid gap-1">
                    <a href="#" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="#" class="sidebar-link {{ request()->routeIs('customers.index') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Customers</span>
                    </a>

                    <a href="#" class="sidebar-link {{ request()->routeIs('customers.create') ? 'active' : '' }}">
                        <i class="bi bi-person-plus"></i>
                        <span>Add Customer</span>
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
                        <a href="#" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>

                        <a href="#" class="sidebar-link {{ request()->routeIs('customers.index') ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            <span>Customers</span>
                        </a>

                        <a href="#" class="sidebar-link {{ request()->routeIs('customers.create') ? 'active' : '' }}">
                            <i class="bi bi-person-plus"></i>
                            <span>Add Customer</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <main class="content-wrapper flex-grow-1">
            <div class="container-fluid p-3 p-lg-4">
                @yield('content')
            </div>
        </main>
    </div>

    <footer class="bg-white border-top py-3">
        <div class="container-fluid px-3 px-lg-4 text-center text-muted small">
            &copy; {{ date('Y') }} Customer Management System. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
