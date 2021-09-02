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
                ->with(['user'])
                ->latest('id')
                ->paginate()
                ->appends(\request()->query()),
            'auditors' =>  AuditorPermission::auditors(),
            'locations' =>  Location::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $session = $request->get('session');

        if($session == null){
            $session = AuditSession::create([
                'user_id' => $request->get('auditor'),
                'start_date' => $request->get('startDate'),
                'end_date' => $request->get('endDate'),
            ]);

        }else{
            $session = AuditSession::find($session);
        }

//        $employees = $this->employeeList($request);

        $locations = Location::get();
        return Inertia::render('AuditorAccess/Create',[
                'session' => $session,
                'locationId' => $request->get('location'),
                'locations' => $locations,
//                'employees' => $employees,
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
    public function edit($session)
    {
//        $accessedEmployees = AuditorPermission::where(  )->paginate();

        return Inertia::render('AuditorAccess/Edit',[
            'accessedEmployees' => QueryBuilder::for(AuditorPermission::class)
                ->where('audit_session_id',$session)
                ->with(['employee.location',])
                ->latest('id')
                ->paginate()
                ->appends(\request()->query()),
            "session" => $session,
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
        $session = $request->get('session');
        $employee = $request->get('employee');
        if(!AuditorPermission::hasAccess($session , $employee)){
            return AuditorPermission::create([
                'audit_session_id' => $session,
                'employee_id' => $employee,
            ]);
        }else{
            return AuditorPermission::where('audit_session_id',$session)->where('employee_id',$employee)->delete();
        }
    }
    public function extraAccess(Request $request){


        $permissionId = $request->get('id');
        $auditorPermission = AuditorPermission::find($permissionId);

        if($request->get('employee_details') != null){
            return $auditorPermission->update([
                "employee_details" => $request->get('employee_details') == "true" ? 1 : 0 ,
            ]);
        }else if($request->get('contact_details') != null){
            return $auditorPermission->update([
                "contact_details" => $request->get('contact_details') == "true" ? 1 : 0 ,
            ]);
        }else if($request->get('contribution') != null){
            return $auditorPermission->update([
                "contribution" => $request->get('contribution') == "true" ? 1 : 0 ,
            ]);
        }else if($request->get('salary_details') != null){
            return $auditorPermission->update([
                "salary_details" => $request->get('salary_details') == "true" ? 1 : 0 ,
            ]);
        }else if($request->get('documents') != null){
            return $auditorPermission->update([
                "documents" => $request->get('documents') == "true" ? 1 : 0 ,
            ]);
        }else if($request->get('leave') != null){
            return $auditorPermission->update([
                "leave" => $request->get('leave') == "true" ? 1 : 0 ,
            ]);
        }else if($request->get('payslips') != null){
            return $auditorPermission->update([
                "payslips" => $request->get('payslips') == "true" ? 1 : 0 ,
            ]);
        }


    }
    public function employeeList(Request $request){

        $session = $request->get('session');
        $location = $request->get('location');
        $employees = Employee::where('location_id',$location)->paginate();

        foreach ($employees as $employee){
            $employee->check = AuditorPermission::hasAccess($session , $employee->id);
            $employee->location = Location::name($employee->location_id);
        }
        return $employees;
    }
}
