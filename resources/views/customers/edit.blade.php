@extends('layouts.app')

@section('title', 'Edit Customer | Customer Management System')

@section('content')
    <div class="mb-4">
        <h1 class="h3 fw-bold mb-1">Edit Customer</h1>
        <p class="text-muted mb-0">Update an existing customer profile.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4 p-lg-5">
            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <label for="firstName" class="form-label fw-semibold">First Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-person"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control @error('first_name') is-invalid @enderror"
                                id="firstName"
                                name="first_name"
                                value="{{ old('first_name', $customer->first_name) }}"
                                placeholder="Enter first name"
                            >
                        </div>
                        @error('first_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="lastName" class="form-label fw-semibold">Last Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-person"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control @error('last_name') is-invalid @enderror"
                                id="lastName"
                                name="last_name"
                                value="{{ old('last_name', $customer->last_name) }}"
                                placeholder="Enter last name"
                            >
                        </div>
                        @error('last_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{ old('email', $customer->email) }}"
                                placeholder="customer@example.com"
                            >
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="phoneNumber" class="form-label fw-semibold">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-telephone"></i>
                            </span>
                            <input
                                type="tel"
                                class="form-control @error('phone') is-invalid @enderror"
                                id="phoneNumber"
                                name="phone"
                                value="{{ old('phone', $customer->phone) }}"
                                placeholder="Enter phone number"
                            >
                        </div>
                        @error('phone')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-toggle-on"></i>
                            </span>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="Active" @selected(old('status', $customer->status) === 'Active')>Active</option>
                                <option value="Inactive" @selected(old('status', $customer->status) === 'Inactive')>Inactive</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label fw-semibold">Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white align-items-start pt-3">
                                <i class="bi bi-geo-alt"></i>
                            </span>
                            <textarea
                                class="form-control @error('address') is-invalid @enderror"
                                id="address"
                                name="address"
                                rows="4"
                                placeholder="Enter customer address"
                            >{{ old('address', $customer->address) }}</textarea>
                        </div>
                        @error('address')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle me-1"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>
                        Update Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
