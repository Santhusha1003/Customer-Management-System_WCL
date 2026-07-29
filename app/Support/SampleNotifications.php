<?php

namespace App\Support;

use Illuminate\Support\Collection;

class SampleNotifications
{
    public static function all(): Collection
    {
        return collect([
            [
                'title' => 'Customer Added',
                'message' => 'John Silva has been added successfully.',
                'icon' => 'person-plus',
                'type' => 'success',
                'time' => 'Just now',
                'unread' => true,
            ],
            [
                'title' => 'Customer Updated',
                'message' => "Nimal Perera's information has been updated.",
                'icon' => 'pencil-square',
                'type' => 'primary',
                'time' => '5 minutes ago',
                'unread' => true,
            ],
            [
                'title' => 'Customer Deleted',
                'message' => 'Kasun Fernando has been removed.',
                'icon' => 'trash',
                'type' => 'danger',
                'time' => '30 minutes ago',
                'unread' => false,
            ],
            [
                'title' => 'Dashboard Updated',
                'message' => 'Customer statistics were refreshed successfully.',
                'icon' => 'bar-chart',
                'type' => 'info',
                'time' => 'Yesterday',
                'unread' => false,
            ],
            [
                'title' => 'System Status',
                'message' => 'Customer Management System is running normally.',
                'icon' => 'check-circle',
                'type' => 'success',
                'time' => '2 days ago',
                'unread' => false,
            ],
        ]);
    }

    public static function unreadCount(): int
    {
        return self::all()->where('unread', true)->count();
    }
}
