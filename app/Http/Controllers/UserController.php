<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as QueryRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
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
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Users/Create', [
            'roles' => Role::select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
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
     * @param $id
     * @return Response
     */
    public function show($id): Response
    {
        return Inertia::render('Users/Show', [
            'user' => User::with('role:id,name')->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user): Response
    {
        return Inertia::render('Users/Edit', [
            'roles' => Role::select('id', 'name')->get(),
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, User $user): RedirectResponse
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
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * @return Response|ResponseFactory
     */
    public function profile()
    {
        return inertia('Users/Profile', [
            'user' => Auth::user()
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function updateProfile(Request $request, User $user): RedirectResponse
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'photo' => ['nullable', 'image'],
            'phone' => [
                'required', 'string', 'min:3', 'max:255',
                'regex:/^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('phone', request('phone'))->where('id', '!==', request()->route('user'));
                })
            ],
        ]);

        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'photo' => upload($request->file('photo'), 'profile-photos', 'public', $user->photo),
        ]);

        return Redirect::back()->with('success', "Your profile Updated");
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function updatePassword(Request $request, User $user): RedirectResponse
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed',
            'confirm_password' => 'required'
        ]);

        if ($user->getAuthPassword() === Hash::make($request->current_passsword)) {
            $user->update([
                'password' => Hash::make($request->get('new_password'))
            ]);
        } else {
            return Redirect::back()->with('error', 'Current Password doesn\'t match');
        }
    }
}
