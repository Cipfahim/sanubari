<?php

namespace App\Http\Controllers;

use App\Models\AuditorPermission;
use App\Models\AuditSession;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Request as QueryRequest;
use Illuminate\Support\Str;

class AuditorPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Inertia::render('AuditorAccess/Index',[
            'requests' => QueryRequest::all(['filter','sort']),
            'sessions' => QueryBuilder::for(AuditSession::class)
                ->allowedFilters(['user_id'])
                ->allowedSorts(['user_id'])
                ->latest('id')
                ->paginate()
                ->appends(\request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auditors = User::whereHas('role', function (Builder $query) {
            $query->where('slug', 'auditor');
        })->get();

        return Inertia::render('AuditorAccess/Create',[
            'auditors' => $auditors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AuditorPermission  $auditorPermission
     * @return \Illuminate\Http\Response
     */
    public function show(AuditorPermission $auditorPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuditorPermission  $auditorPermission
     * @return \Illuminate\Http\Response
     */
    public function edit($auditor)
    {
        $auditor = User::where('id',$auditor)->first();

        $accessedEmployees = AuditorPermission::where('user_id',$auditor)->paginate();
        return Inertia::render('AuditorAccess/Edit',[
            "auditor" => $auditor,
            "accessedEmployees" => $accessedEmployees,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AuditorPermission  $auditorPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuditorPermission $auditorPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuditorPermission  $auditorPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuditorPermission $auditorPermission)
    {
        //
    }

    public function giveAccess(Request $request){
//        return  [$request->all() , $request->get('auditor')];
        $auditor = $request->get('auditor');
        $employee = $request->get('employee');
        if(!AuditorPermission::hasAccess($auditor , $employee)){
            return AuditorPermission::create([
                'user_id' => $request->get('auditor'),
                'employee_id' => $request->get('employee'),
            ]);
        }else{
            return AuditorPermission::where('user_id',$auditor)->where('employee_id',$employee)->delete();
        }


    }
    public function employeeList(Request $request){

        $auditor = $request->get('auditor');
        $employees = Employee::paginate(1);

        foreach ($employees as $employee){
            $employee->check = AuditorPermission::hasAccess($auditor , $employee->id);
            $employee->location = Location::name($employee->location_id);
        }
        return $employees;
    }
}
