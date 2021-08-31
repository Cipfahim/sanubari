<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Employee;
use App\Models\Payslip;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as QueryRequest;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\QueryBuilder\QueryBuilder;

class SinglePayslipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $employeeId
     * @return Response
     */
    public function index($employeeId): Response
    {
        $employee = Employee::with('user')->findOrFail($employeeId);

        return Inertia::render('Employees/Payslips/Index', [
            'employee' => $employee,
            'requests' => QueryRequest::all(['filter', 'sort']),
            'payslips' => QueryBuilder::for(Payslip::class)
                ->where('employee_id', $employee->id)
                ->allowedFilters(['description'])
                ->allowedSorts(['description', 'date_from', 'date_to'])
                ->latest('id')
                ->paginate()
                ->appends(\request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($employeeId)
    {
        return Inertia::render('Employees/Payslips/Create', [
            'employee' => Employee::with('user')->findOrFail($employeeId),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, $employeeId)
    {
        $this->validate($request, [
            'date_from' => ['required', 'string'],
            'date_to' => ['required', 'string'],
            'payslip' => ['required', 'string'],
        ]);

        $employee = Employee::findOrFail($employeeId);

        $tempFile = TemporaryFile::where('folder', $request->get('payslip'))->first();
        if (!isset($tempFile)) {
            return Redirect::back()->with('error', 'Payslip was not uploaded');
        }

        $payslipPath = 'payslips/' . $employee->id . '/' . now()->toDateString() . '-' . now()->timestamp . '/' . $tempFile->filename;
        Storage::move('temp/' . $tempFile->folder . '/' . $tempFile->filename, 'public/' . $payslipPath);

        $employee->payslips()->create([
            'description' => Payslip::generateDescription($request->get('date_from')),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
            'file_path' => $payslipPath,
        ]);

        $tempFile->delete();
        return Redirect::route('employees.payslips.index', $employeeId);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Payslip $payslip
     * @return \Illuminate\Http\Response
     */
    public function show(Payslip $payslip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Payslip $payslip
     * @return Response
     */
    public function edit($employeeId, $payslipId)
    {
        $employee = Employee::with('user')->findOrFail($employeeId);
        return Inertia::render('Employees/Payslips/Edit', [
            'employee' => $employee,
            'payslip' => $employee->payslips()->findOrFail($payslipId)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Payslip $payslip
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $employeeId, $payslipId)
    {
        $this->validate($request, [
            'date_from' => ['required', 'string'],
            'date_to' => ['required', 'string'],
            'payslip' => ['required', 'string'],
        ]);

        $employee = Employee::findOrFail($employeeId);

        $tempFile = TemporaryFile::where('folder', $request->get('payslip'))->first();
        if (!isset($tempFile)) {
            return Redirect::back()->with('error', 'Payslip was not uploaded');
        }

        $payslipPath = 'payslips/' . $employee->id .
            '/' . now()->toDateString() . '-' . now()->timestamp .
            '/' . $tempFile->filename;
        Storage::move('temp/' . $tempFile->folder . '/' . $tempFile->filename,
            'public/' . $payslipPath);

        $employee->payslips()->findOrFail($payslipId)->update([
            'description' => Payslip::generateDescription($request->get('date_from')),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
            'file_path' => $payslipPath,
        ]);

        $tempFile->delete();
        return Redirect::route('employees.payslips.index', $employeeId)
            ->with('success', 'Payslip Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Payslip $payslip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payslip $payslip)
    {
        //
    }
}
