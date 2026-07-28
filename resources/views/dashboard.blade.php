@extends('layouts.app')

@section('title', 'Dashboard | Customer Management System')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Welcome Back</h1>
            <p class="text-muted mb-0">Here is a quick overview of your customer records.</p>
        </div>
    </div>

    <div class="row g-3 g-xl-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card h-100">
                <div class="card-body d-flex align-items-center justify-content-between gap-3">
                    <div>
                        <p class="text-muted small fw-semibold text-uppercase mb-1">Total Customers</p>
                        <h2 class="display-6 fw-bold mb-1">{{ $totalCustomers }}</h2>
                        <p class="text-muted small mb-0">All registered customers</p>
                    </div>
                    <span class="stat-icon stat-icon-primary">
                        <i class="bi bi-people"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card h-100">
                <div class="card-body d-flex align-items-center justify-content-between gap-3">
                    <div>
                        <p class="text-muted small fw-semibold text-uppercase mb-1">Active Customers</p>
                        <h2 class="display-6 fw-bold mb-1">{{ $activeCustomers }}</h2>
                        <p class="text-muted small mb-0">Currently active customers</p>
                    </div>
                    <span class="stat-icon stat-icon-success">
                        <i class="bi bi-person-check"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card h-100">
                <div class="card-body d-flex align-items-center justify-content-between gap-3">
                    <div>
                        <p class="text-muted small fw-semibold text-uppercase mb-1">Inactive Customers</p>
                        <h2 class="display-6 fw-bold mb-1">{{ $inactiveCustomers }}</h2>
                        <p class="text-muted small mb-0">Currently inactive customers</p>
                    </div>
                    <span class="stat-icon stat-icon-secondary">
                        <i class="bi bi-person-dash"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card h-100">
                <div class="card-body d-flex align-items-center justify-content-between gap-3">
                    <div>
                        <p class="text-muted small fw-semibold text-uppercase mb-1">New This Month</p>
                        <h2 class="display-6 fw-bold mb-1">{{ $customersAddedThisMonth }}</h2>
                        <p class="text-muted small mb-0">Customers added this month</p>
                    </div>
                    <span class="stat-icon stat-icon-info">
                        <i class="bi bi-clock-history"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
