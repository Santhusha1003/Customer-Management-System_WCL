@extends('layouts.app')

@section('title', 'Notifications | Customer Management System')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Notifications</h1>
            <p class="text-muted mb-0">Review recent system activity.</p>
        </div>
    </div>

    <div class="card border-0 shadow-soft">
        <div class="card-body p-4">
            @if ($notifications->isEmpty())
                <div class="text-center py-5">
                    <div class="empty-state-icon mb-3">
                        <i class="bi bi-bell"></i>
                    </div>
                    <h2 class="h5 fw-bold mb-2">No notifications available.</h2>
                    <p class="text-muted mb-0">Customer activity notifications will appear here.</p>
                </div>
            @else
                <div class="list-group list-group-flush">
                    @foreach ($notifications as $notification)
                        <div class="list-group-item px-0 py-3 notification-item {{ $notification['unread'] ? 'unread' : '' }}">
                            <div class="d-flex gap-3">
                                <div class="notification-icon text-{{ $notification['type'] }}">
                                    <i class="bi bi-{{ $notification['icon'] }}"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                                        <div>
                                            <h2 class="h6 mb-1 notification-title {{ $notification['unread'] ? 'unread' : '' }}">{{ $notification['title'] }}</h2>
                                            <p class="text-muted mb-2">{{ $notification['message'] }}</p>
                                        </div>
                                        <span class="badge align-self-start {{ $notification['unread'] ? 'text-bg-primary' : 'text-bg-secondary' }}">
                                            {{ $notification['unread'] ? 'Unread' : 'Read' }}
                                        </span>
                                    </div>
                                    <div class="small text-muted">
                                        {{ $notification['time'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <p class="text-muted small text-center mb-0 pt-4">
                    Showing {{ $notifications->count() }} notifications
                </p>
            @endif
        </div>
    </div>
@endsection
