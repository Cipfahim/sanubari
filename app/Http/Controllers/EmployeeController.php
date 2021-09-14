<?php

namespace App\Http\Controllers;


use App\Http\Requests\Employees\StoreEmployeeRequest;
use App\Http\Requests\Employees\UpdateEmployeeRequest;
use App\Models\Country;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as QueryRequest;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Employees/Index', [
            'requests' => QueryRequest::all(['filter', 'sort']),
            'employees' => QueryBuilder::for(Employee::class)
                ->with(['user', 'location'])
                ->allowedFilters(['official_name', 'date_of_join', 'user.phone', 'user.status', 'location.name'])
                ->allowedSorts(['official_name', 'status'])
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
        return Inertia::render('Employees/Create', [
            'locations' => Location::all(),
            'countries' => Country::select('id', 'name', 'flag_path', 'country_code')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreEmployeeRequest $request)
    {
        sendPassword($request->get('phone'), $request->get('password'));
        $user = User::create([
            'role_id' => Role::Employee,
            'name' => $request->get('nick_name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'password' => Hash::make($request->get('password')),
            'photo' => upload($request->file('photo'), 'profile-photos', 'public'),
            'status' => $request->get('status')
        ]);
        $user->employee()->create([
            'official_name' => $request->get('official_name'),
            'nick_name' => $request->get('nick_name'),
            'location_id' => $request->get('location'),
            'date_of_join' => Carbon::parse($request->get('date_of_join'))->toDateString(),
        ]);

        // Send otp code
        sendPassword($request->get('phone'), $request->get('password'));

        return Redirect::route('employees.edit.identification.index', $user->employee->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return \Inertia\Response
     */
    public function show($id)
    {
        return Inertia::render('Employees/Show', [
            'showTab' => request('showTab'),
            'employee' => Employee::with(['user', 'location', 'bankDetails', 'salaryDetails', 'contribution', 'contactNumbers', 'contactEmails', 'contactAddress'])
                ->findOrfail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        return Inertia::render('Employees/Edit/EmployeeDetails', [
            'locations' => Location::all(),
            'employee' => Employee::with('user')->findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Employee $employee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $employee->update([
            'official_name' => $request->get('official_name'),
            'nick_name' => $request->get('nick_name'),
            'location_id' => $request->get('location'),
            'date_of_join' => Carbon::parse($request->get('date_of_join'))->toDateString(),
        ]);

        $user = $employee->user;
        $user->update([
            'role_id' => Role::Employee,
            'name' => $request->get('nick_name'),
            'phone' => $request->get('phone'),
            'password' => isset($request->password)
                ? Hash::make($request->get('password'))
                : $user->password,
            'photo' => upload($request->file('photo'), 'profile-photos', 'public', $user->photo),
            'status' => $request->get('status')
        ]);

        if ($request->get('continue') == true) {
            return Redirect::route('employees.edit.identification.index', $id)
                ->with('success', 'Employee info Saved.');
        }
        return Redirect::back()->with('success', 'Employee info Saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
