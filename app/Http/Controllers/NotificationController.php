<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaPaginator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return [
                'unread' => $request->user()->unreadNotifications->count()
            ];
        }

        $request->user()->unreadNotifications->markAsRead();

        $notifications = $request->user()->notifications()->latest()->paginate(12);

        $paginatedLinks = InertiaPaginator::paginationLinks($notifications);

        return Inertia::render('Notifications/Index', [
            'notifications' => $notifications,
            'paginated_links' => $paginatedLinks
        ]);
    }
}
