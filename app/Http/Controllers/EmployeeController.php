<?php

namespace App\Http\Controllers;

use App\Enums\EmployeeStatusEnum;
use App\Http\Requests\Employees\StoreEmployee;
use App\Http\Requests\EmployeeValidator;
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
//                ->allowedFilters(['name'])
//                ->allowedSorts(['name', 'description', 'status'])
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
            'locations' => Location::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployee $request)
    {
        $user = User::create([
            'role_id' => Role::Employee,
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'password' => Hash::make($request->get('password')),
        ]);
        $user->employee()->create([
            'official_name' => $request->get('official_name'),
            'nick_name' => $request->get('nick_name'),
            'location_id' => $request->get('location'),
            'date_of_join' => Carbon::parse($request->get('date_of_join'))->toDateString(),
            'status' => EmployeeStatusEnum::draft()
        ]);

        return Redirect::route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeValidator $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
