@extends('layouts.app')

@section('title', 'My Profile | Customer Management System')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">My Profile</h1>
            <p class="text-muted mb-0">Administrator account information and system profile overview.</p>
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
            <div class="d-flex flex-column flex-md-row align-items-md-start gap-4 gap-lg-5">
                <div class="avatar-placeholder" style="width: 88px; height: 88px; font-size: 2rem;" aria-label="Admin User avatar">U</div>

                <div class="flex-grow-1">
                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <p class="text-muted small fw-semibold text-uppercase mb-2">
                                <i class="bi bi-person me-1"></i>
                                Name
                            </p>
                            <p class="h6 fw-bold mb-0">Admin User</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="text-muted small fw-semibold text-uppercase mb-2">
                                <i class="bi bi-envelope me-1"></i>
                                Email
                            </p>
                            <p class="h6 fw-bold mb-0">admin@cms.com</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="text-muted small fw-semibold text-uppercase mb-2">
                                <i class="bi bi-shield-check me-1"></i>
                                Role
                            </p>
                            <p class="h6 fw-bold mb-3">Administrator</p>
                            <span class="badge text-bg-success">
                                <i class="bi bi-check-circle me-1"></i>
                                Administrator Account
                            </span>
                            <p class="small text-muted mt-3 mb-0">This account manages customer records and system settings.</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="text-muted small fw-semibold text-uppercase mb-2">
                                <i class="bi bi-calendar-check me-1"></i>
                                Joined
                            </p>
                            <p class="h6 fw-bold mb-0">July 2026</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
