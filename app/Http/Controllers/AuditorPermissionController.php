<?php

namespace App\Http\Controllers;

use App\Models\AuditorPermission;
use App\Models\AuditSession;
use App\Models\Employee;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request as QueryRequest;

class AuditorPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('AuditorAccess/Index', [
            'requests' => QueryRequest::all(['filter', 'sort']),
            'sessions' => QueryBuilder::for(AuditSession::class)
                ->with(['user'])
                ->allowedFilters(['user.name'])
                ->allowedSorts(['user.name'])
                ->latest('id')
                ->paginate()
                ->appends(\request()->query()),
            'auditors' => AuditorPermission::auditors(),
            'locations' => Location::all(),
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

        if ($session == null) {
            $session = AuditSession::create([
                'user_id' => $request->get('auditor'),
                'location' => $request->get('location'),
                'start_date' => $request->get('startDate'),
                'end_date' => $request->get('endDate'),
            ]);

        } else {
            $session = AuditSession::find($session);
        }

//        $employees = $this->employeeList($request);

        $locations = Location::get();
        return Inertia::render('AuditorAccess/Create', [
            'session' => $session,
            'locationId' => $request->get('location'),
            'locations' => $locations,
//                'employees' => $employees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param AuditorPermission $auditorPermission
     * @return \Illuminate\Http\Response
     */
    public function show(AuditorPermission $auditorPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $session
     * @return Response
     */
    public function edit($session): Response
    {
        return Inertia::render('AuditorAccess/Edit', [
            'requests' => QueryRequest::all(['filter']),
            'session' => $session,
            'locations' => Location::all(),
            'accessedEmployees' => QueryBuilder::for(AuditorPermission::class)
                ->where('audit_session_id', $session)
                ->with(['employee.location',])
                ->latest('id')
                ->paginate()
                ->appends(\request()->query()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param AuditorPermission $auditorPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuditorPermission $auditorPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AuditorPermission $auditorPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuditorPermission $auditorPermission)
    {
        //
    }

    public function giveAccess(Request $request)
    {
        $session = $request->get('session');
        $employee = $request->get('employee');
        if (!AuditorPermission::hasAccess($session, $employee)) {
            return AuditorPermission::create([
                'audit_session_id' => $session,
                'employee_id' => $employee,
            ]);
        } else {
            return AuditorPermission::where('audit_session_id', $session)->where('employee_id', $employee)->delete();
        }
    }

    public function extraAccess(Request $request)
    {
        $auditorPermission = AuditorPermission::where('id', $request->get('id'))->first();

        if ($request->get('employee_details') != null) {
            return $auditorPermission->update([
                "employee_details" => $request->get('employee_details') == "true" ? 1 : 0,
            ]);
        } else if ($request->get('contact_details') != null) {
            return $auditorPermission->update([
                "contact_details" => $request->get('contact_details') == "true" ? 1 : 0,
            ]);
        } else if ($request->get('contribution') != null) {
            return $auditorPermission->update([
                "contribution" => $request->get('contribution') == "true" ? 1 : 0,
            ]);
        } else if ($request->get('salary_details') != null) {
            return $auditorPermission->update([
                "salary_details" => $request->get('salary_details') == "true" ? 1 : 0,
            ]);
        } else if ($request->get('documents') != null) {
            return $auditorPermission->update([
                "documents" => $request->get('documents') == "true" ? 1 : 0,
            ]);
        } else if ($request->get('leave') != null) {
            return $auditorPermission->update([
                "leave" => $request->get('leave') == "true" ? 1 : 0,
            ]);
        } else if ($request->get('payslips') != null) {
            return $auditorPermission->update([
                "payslips" => $request->get('payslips') == "true" ? 1 : 0,
            ]);
        }
    }

    public function employeeList(Request $request)
    {

        $session = $request->get('session');
        $location = $request->get('location');
        $employees = Employee::where('location_id', $location)->paginate();

        foreach ($employees as $employee) {
            $employee->check = AuditorPermission::hasAccess($session, $employee->id);
            $employee->location = Location::name($employee->location_id);
        }
        return $employees;
    }

    public function employeeIndex()
    {
        return Inertia::render('Auditor/Employee/Index', [
            'requests' => QueryRequest::all(['filter', 'sort']),
            'locations' => Location::all(),
            'sessions' => QueryBuilder::for(AuditorPermission::class)
                ->with(['employee.user', 'employee.location', 'auditSession'])
                ->whereHas('auditSession', function (Builder $query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->allowedFilters('employee.official_name', 'employee.date_of_join', 'employee.user.phone', 'employee.user.status', 'employee.location.name')
                ->allowedSorts(['user_id'])
                ->latest('id')
                ->paginate()
                ->appends(\request()->query()),
        ]);
    }

    public function employeeShow($id)
    {
        $auditorPermission = AuditorPermission::where('id', $id)->first();


        return Inertia::render('Auditor/Employee/Show', [
            'employeeDetails' => $auditorPermission->load(
                'employee.user',
                'employee.contactDetails',
                'employee.contactNumbers',
                'employee.contactEmails',
                'employee.contactAddress',
                'employee.contribution',
                'employee.salaryDetails',
                'employee.bankDetails',
                'employee.documents',
                'employee.payslips',
                'employee.leaveQuota',
            )
        ]);
    }
}
