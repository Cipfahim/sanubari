<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Location;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Dashboard', [
            'totalEmployee' => Employee::count(),
            'totalLocations' => Location::count(),
            'openSupportTickets' => SupportTicket::where('status', 'Open')->count(),
            'pendingSupportTickets' => SupportTicket::where('status', 'Pending')->count(),
            'recentSupportTickets' => SupportTicket::with(['user', 'chats'])
                ->latest('id')
                ->where('status', 'Pending')
                ->take(5)->get()
        ]);
    }
}
