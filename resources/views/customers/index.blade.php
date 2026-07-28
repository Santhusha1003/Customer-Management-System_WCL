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

    <div class="card border-0 shadow-soft">
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
                    <select class="form-select" id="statusFilter" name="status">
                        <option value="All" @selected($status === 'All')>All</option>
                        <option value="Active" @selected($status === 'Active')>Active</option>
                        <option value="Inactive" @selected($status === 'Inactive')>Inactive</option>
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
                <div class="text-center py-5">
                    <div class="empty-state-icon mb-3">
                        <i class="bi bi-search"></i>
                    </div>
                    <h2 class="h5 fw-bold mb-2">{{ $search || $status !== 'All' ? 'No matching customers found.' : 'No customers found' }}</h2>
                    <p class="text-muted mb-4">
                        {{ $search || $status !== 'All' ? 'Try a different keyword or status filter.' : 'Start by adding your first customer profile.' }}
                    </p>
                    @unless ($search || $status !== 'All')
                        <a href="{{ route('customers.create') }}" class="btn btn-primary">
                            <i class="bi bi-person-plus me-1"></i>
                            Add Customer
                        </a>
                    @endunless
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
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
                                            <form id="deleteCustomerForm{{ $customer->id }}" action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteCustomerModal"
                                                    data-delete-form="deleteCustomerForm{{ $customer->id }}"
                                                    aria-label="Delete customer"
                                                >
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

    <div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-soft">
                <div class="modal-header">
                    <h2 class="modal-title h5 fw-bold" id="deleteCustomerModalLabel">
                        <i class="bi bi-trash text-danger me-2"></i>
                        Delete Customer
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close delete confirmation"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-1">Are you sure you want to delete this customer?</p>
                    <p class="text-muted mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>
                        Cancel
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteCustomerButton" data-loading-text="Deleting...">
                        <i class="bi bi-trash me-1"></i>
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const deleteCustomerModal = document.getElementById('deleteCustomerModal');
        const confirmDeleteCustomerButton = document.getElementById('confirmDeleteCustomerButton');
        let selectedDeleteForm = null;

        if (deleteCustomerModal) {
            deleteCustomerModal.addEventListener('show.bs.modal', (event) => {
                const button = event.relatedTarget;
                const formId = button?.getAttribute('data-delete-form');

                selectedDeleteForm = formId ? document.getElementById(formId) : null;
            });

            deleteCustomerModal.addEventListener('hidden.bs.modal', () => {
                selectedDeleteForm = null;
            });

            confirmDeleteCustomerButton?.addEventListener('click', () => {
                if (!selectedDeleteForm || confirmDeleteCustomerButton.disabled) {
                    return;
                }

                confirmDeleteCustomerButton.disabled = true;
                confirmDeleteCustomerButton.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-1" aria-hidden="true"></span>
                    <span>${confirmDeleteCustomerButton.dataset.loadingText}</span>
                `;

                selectedDeleteForm.submit();
            });
        }
    </script>
@endsection
