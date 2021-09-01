<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Location;
use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        return Inertia::render('Dashboard', [
            'totalEmployee' => Employee::count(),
            'totalLocations' => Location::count(),
            'totalUsers' => User::count(),
            'openSupportTickets' => SupportTicket::where('status', 'Open')->count(),
            'recentSupportTickets' => SupportTicket::with(['user', 'chats'])
                ->latest('id')
                ->where('status', 'Pending')
                ->take(5)->get()
        ]);
    }
}
