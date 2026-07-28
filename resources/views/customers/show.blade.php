@extends('layouts.app')

@section('title', 'Customer Details | Customer Management System')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Customer Details</h1>
            <p class="text-muted mb-0">View complete customer profile information.</p>
        </div>

        <div class="d-flex flex-column flex-sm-row gap-2">
            <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Back to Customers
            </a>
            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil-square me-1"></i>
                Edit Customer
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-soft rounded-3 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="avatar-placeholder">
                            {{ strtoupper(substr($customer->first_name, 0, 1)) }}{{ strtoupper(substr($customer->last_name, 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="h5 fw-bold mb-1">{{ $customer->first_name }} {{ $customer->last_name }}</h2>
                            @if ($customer->status === 'Active')
                                <span class="badge text-bg-success">Active</span>
                            @else
                                <span class="badge text-bg-secondary">Inactive</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-grid gap-3">
                        <div>
                            <div class="text-muted small">Customer ID</div>
                            <div class="fw-semibold">#{{ $customer->id }}</div>
                        </div>
                        <div>
                            <div class="text-muted small">Email</div>
                            <div class="fw-semibold">{{ $customer->email }}</div>
                        </div>
                        <div>
                            <div class="text-muted small">Phone Number</div>
                            <div class="fw-semibold">{{ $customer->phone }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-soft rounded-3">
                <div class="card-body p-4 p-lg-5">
                    <h2 class="h5 fw-bold mb-4">Profile Information</h2>

                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <div class="text-muted small">First Name</div>
                            <div class="fw-semibold">{{ $customer->first_name }}</div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="text-muted small">Last Name</div>
                            <div class="fw-semibold">{{ $customer->last_name }}</div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="text-muted small">Full Name</div>
                            <div class="fw-semibold">{{ $customer->first_name }} {{ $customer->last_name }}</div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="text-muted small">Status</div>
                            @if ($customer->status === 'Active')
                                <span class="badge text-bg-success">Active</span>
                            @else
                                <span class="badge text-bg-secondary">Inactive</span>
                            @endif
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="text-muted small">Email</div>
                            <div class="fw-semibold">{{ $customer->email }}</div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="text-muted small">Phone Number</div>
                            <div class="fw-semibold">{{ $customer->phone }}</div>
                        </div>

                        <div class="col-12">
                            <div class="text-muted small">Address</div>
                            <div class="fw-semibold">{{ $customer->address ?: 'Not provided' }}</div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="text-muted small">Created Date</div>
                            <div class="fw-semibold">{{ $customer->created_at->format('M d, Y h:i A') }}</div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="text-muted small">Last Updated Date</div>
                            <div class="fw-semibold">{{ $customer->updated_at->format('M d, Y h:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
