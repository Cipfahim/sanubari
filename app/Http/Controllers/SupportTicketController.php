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
            'last_message' => Chat::latest()->first() ? Chat::latest()->first()->created_at : '',
            'tickets' => QueryBuilder::for(SupportTicket::class)
                ->with(['user', 'chats'])
                ->where('user_id', Auth::id())
                ->allowedFilters(['subject'])
                ->allowedSorts(['user', 'subject'])
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
        return Inertia::render('SupportTicket/Create');
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
        $this->validate($request, [
            'subject' => ['required'],
            'description' => ['required']
        ]);

        $ticket = SupportTicket::create([
            'user_id' => Auth::user()->id,
            'subject' => $request->get('subject'),
            'description' => $request->get('description')
        ]);

        Chat::create([
            'support_ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'chat' => $request->get('description')
        ]);

        return Redirect::route('employee.supportTickets.index')->with('success', 'Support Ticket is Created');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(SupportTicket $supportTicket)
    {
        if ($supportTicket->status === "Pending" || $supportTicket->status === "Closed" || $supportTicket->status === "Spam") {
            return Redirect::back()->with('error', 'Your Status is Pending');
        } else {
            return Inertia::render('SupportTicket/Show', [
                'ticket' => $supportTicket->load(['chats.user'])
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SupportTicket $supportTicket
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
     * @param SupportTicket $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupportTicket $supportTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SupportTicket $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupportTicket $supportTicket)
    {
        //
    }

    /**
     * @return Response
     */
    public function adminIndex(): Response
    {
        return Inertia::render('SupportTicket/Admin/Index', [
            'requests' => QueryRequest::all(['filter', 'sort']),
            'last_message' => Chat::latest()->first() ? Chat::latest()->first()->created_at : '',
            'tickets' => QueryBuilder::for(SupportTicket::class)
                ->with(['user', 'chats'])
                ->allowedFilters(['user.name', 'subject'])
                ->allowedSorts(['user', 'subject'])
                ->latest('id')
                ->paginate()
                ->appends(request()->query()),
        ]);
    }

    /**
     * @param SupportTicket $supportTicket
     * @return Response
     */
    public function adminShow(SupportTicket $supportTicket): Response
    {
        if ($supportTicket->status === 'Pending') {
            $supportTicket->update([
                'status' => 'Open'
            ]);
        }

        return Inertia::render('SupportTicket/Show', [
            'ticket' => $supportTicket->load(['chats.user'])
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function storeChat(Request $request, $id): RedirectResponse
    {
        Chat::create([
            'support_ticket_id' => $id,
            'user_id' => Auth::id(),
            'chat' => $request->get('chat')
        ]);

        return Redirect::back();
    }

    /**
     * @param $id
     * @param $status
     * @return RedirectResponse
     */
    public function updateStatus($id, $status): RedirectResponse
    {
        $ticket = SupportTicket::where('id', $id)->first();

        $ticket->update([
           'status' => $status
        ]);

        return Redirect::route('supportTickets.index')->with('success', 'Support Ticket Updated');
    }
}
