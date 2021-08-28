<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Employee;
use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as QueryRequest;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\QueryBuilder\QueryBuilder;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('SupportTicket/Index', [
            'requests' => QueryRequest::all(['filter', 'sort']),
            'tickets' => QueryBuilder::for(SupportTicket::class)
                ->with(['requester.user', 'assigned.user', 'chat'])
                ->allowedFilters(['requester.user', 'assigned.user', 'subject', 'status'])
                ->allowedSorts(['requester.user', 'subject', 'assigned.user'])
                ->latest('id')
                ->paginate()
                ->appends(request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $employees = Employee::with('user')->get();

        return Inertia::render('SupportTicket/Create', [
            'employees' => $employees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request , [
            'employee' => ['required'],
            'subject' => ['required'],
        ]);

        $chat = Chat::create();

        SupportTicket::create([
            'requester' => Auth::id(),
            'assigned' => $request->get('employee'),
            'subject' => $request->get('subject'),
            'chat_id' => $chat->id,
        ]);

        return Redirect::route('supportTickets.index')->with('success', 'Support Ticket is Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function show(SupportTicket $supportTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(SupportTicket $supportTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupportTicket $supportTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupportTicket $supportTicket)
    {
        //
    }
}
