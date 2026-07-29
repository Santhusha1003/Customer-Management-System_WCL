@extends('layouts.app')

@section('title', 'About System | Customer Management System')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">About System</h1>
            <p class="text-muted mb-3">System information, technology stack and project details.</p>
            <div class="d-flex flex-wrap gap-2">
                <span class="badge text-bg-primary">
                    <i class="bi bi-layers me-1"></i>
                    Laravel 13
                </span>
                <span class="badge text-bg-info">
                    <i class="bi bi-bootstrap me-1"></i>
                    Bootstrap 5
                </span>
                <span class="badge text-bg-secondary">
                    <i class="bi bi-tag me-1"></i>
                    Version 1.0.0
                </span>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                <i class="bi bi-person-circle me-1"></i>
                My Profile
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('settings') ? 'active' : '' }}" href="{{ route('settings') }}">
                <i class="bi bi-gear me-1"></i>
                Settings
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                <i class="bi bi-info-circle me-1"></i>
                About System
            </a>
        </li>
    </ul>

    <div class="card border-0 shadow-soft">
        <div class="card-body p-4 p-lg-5">
            <div class="row align-items-center g-4 mb-5">
                <div class="col-12 col-lg-5">
                    <div class="d-flex align-items-center gap-3">
                        <span class="stat-icon stat-icon-primary">
                            <i class="bi bi-people-fill"></i>
                        </span>
                        <div>
                            <h2 class="h4 fw-bold mb-1">Customer Management System</h2>
                            <p class="text-muted mb-0">Version 1.0.0</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-7">
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <div class="border rounded-3 p-4 h-100">
                                <p class="text-muted small fw-semibold text-uppercase mb-2">
                                    <i class="bi bi-layers me-1"></i>
                                    Framework
                                </p>
                                <p class="h6 fw-bold mb-0">Laravel 13</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="border rounded-3 p-4 h-100">
                                <p class="text-muted small fw-semibold text-uppercase mb-2">
                                    <i class="bi bi-bootstrap me-1"></i>
                                    UI Toolkit
                                </p>
                                <p class="h6 fw-bold mb-0">Bootstrap 5</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="border rounded-3 p-4 h-100">
                                <p class="text-muted small fw-semibold text-uppercase mb-2">
                                    <i class="bi bi-code-slash me-1"></i>
                                    Developed by
                                </p>
                                <p class="h6 fw-bold mb-0">Santhusha Manjalee</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-top pt-4">
                <h3 class="h5 fw-bold mb-3">Project Features</h3>

                <div class="row g-3">
                    @foreach ([
                        ['icon' => 'people', 'label' => 'Customer CRUD Management'],
                        ['icon' => 'search', 'label' => 'Search & Status Filter'],
                        ['icon' => 'bar-chart', 'label' => 'Dashboard Statistics'],
                        ['icon' => 'bell', 'label' => 'Notification Center'],
                        ['icon' => 'phone', 'label' => 'Responsive Bootstrap UI'],
                        ['icon' => 'shield-check', 'label' => 'Input Validation & Security'],
                        ['icon' => 'list-ol', 'label' => 'Pagination'],
                        ['icon' => 'person-gear', 'label' => 'Profile & Settings'],
                    ] as $feature)
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="d-flex align-items-center gap-2 border rounded-3 p-3 h-100">
                                <i class="bi bi-{{ $feature['icon'] }} text-primary"></i>
                                <span class="fw-semibold">{{ $feature['label'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
