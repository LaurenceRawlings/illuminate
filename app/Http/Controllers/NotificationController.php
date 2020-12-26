<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaPaginator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        $notifications = $request->user()->notifications()->latest()->paginate(12);

        $paginatedLinks = InertiaPaginator::paginationLinks($notifications);

        if ($request->wantsJson()) {
            return $notifications;
        }

        return Inertia::render('Notifications/Index', [
            'notifications' => $notifications,
            'paginated_links' => $paginatedLinks
        ]);
    }
}
