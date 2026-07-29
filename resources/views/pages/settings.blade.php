@extends('layouts.app')

@section('title', 'Settings | Customer Management System')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Settings</h1>
            <p class="text-muted mb-0">Configure and review system preferences.</p>
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
            <div class="d-flex flex-wrap gap-2 mb-4">
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

            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <div class="border rounded-3 p-4 h-100">
                        <p class="text-muted small fw-semibold text-uppercase mb-2">
                            <i class="bi bi-window-sidebar me-1"></i>
                            System Name
                        </p>
                        <p class="h6 fw-bold mb-0">Customer Management System</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="border rounded-3 p-4 h-100">
                        <p class="text-muted small fw-semibold text-uppercase mb-2">
                            <i class="bi bi-tag me-1"></i>
                            Version
                        </p>
                        <p class="h6 fw-bold mb-0">1.0.0</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="border rounded-3 p-4 h-100">
                        <p class="text-muted small fw-semibold text-uppercase mb-2">
                            <i class="bi bi-sun me-1"></i>
                            Theme
                        </p>
                        <p class="h6 fw-bold mb-0">Light</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="border rounded-3 p-4 h-100">
                        <p class="text-muted small fw-semibold text-uppercase mb-2">
                            <i class="bi bi-bell me-1"></i>
                            Notifications
                        </p>
                        <p class="h6 fw-bold mb-0">Enabled</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
