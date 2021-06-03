<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as QueryRequest;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Users/Index', [
            'requests' => QueryRequest::all(['filter', 'sort']),
            'users' => QueryBuilder::for(User::class)
                ->exceptEmployee()
                ->with(['role'])
                ->allowedFilters(['name', 'phone'])
                ->allowedSorts(['name', 'phone', 'status', 'created_at'])
                ->latest('id')
                ->paginate()
                ->appends(request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Users/Create', [
            'roles' => Role::select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        User::create([
            'role_id' => $request->get('role'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'password' => Hash::make($request->get('password')),
            'status' => $request->get('status'),
            'photo' => upload($request->file('photo'), 'profile-photos', 'public'),
        ]);

        return Redirect::route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Inertia\Response
     */
    public function show($id)
    {
        return Inertia::render('Users/Show', [
            'user' => User::with('role:id,name')->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Inertia\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'roles' => Role::select('id', 'name')->get(),
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->update([
            'role_id' => $request->get('role'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'password' => Hash::make($request->get('password')),
            'status' => $request->get('status'),
            'photo' => upload($request->file('photo'), 'profile-photos', 'public', $user->photo),
        ]);

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
