@extends('layouts.app')

@section('title', 'Customers | Customer Management System')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Customers</h1>
            <p class="text-muted mb-0">Manage all customer records</p>
        </div>

        <a href="{{ route('customers.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus me-1"></i>
            Add Customer
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('customers.index') }}" method="GET" class="row g-3 align-items-end mb-4">
                <div class="col-12 col-lg-6">
                    <label for="customerSearch" class="form-label fw-semibold">Search Customers</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-search"></i>
                        </span>
                        <input
                            type="search"
                            class="form-control"
                            id="customerSearch"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Search by name, email, or phone"
                        >
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <label for="statusFilter" class="form-label fw-semibold">Status</label>
                    <select class="form-select" id="statusFilter">
                        <option selected>All</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i>
                        Search
                    </button>
                </div>
            </form>

            @if ($customers->isEmpty())
                <div class="alert alert-info mb-0" role="alert">
                    {{ $search ? 'No matching customers found.' : 'No customers found.' }}
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td class="fw-semibold">{{ $customer->id }}</td>
                                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                        @if ($customer->status === 'Active')
                                            <span class="badge text-bg-success">Active</span>
                                        @else
                                            <span class="badge text-bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-sm btn-outline-primary" aria-label="View customer">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-outline-secondary" aria-label="Edit customer">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" aria-label="Delete customer">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex flex-column align-items-center gap-3 pt-4">
                    <p class="text-muted small mb-0">
                        Showing {{ $customers->firstItem() ?? 0 }} to {{ $customers->lastItem() ?? 0 }} of {{ $customers->total() }} customers
                    </p>

                    {{ $customers->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection
