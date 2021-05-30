<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employees\SalaryDetailsRequest;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index($id)
    {
        return Inertia::render('Employees/SalaryDetails', [
            'employee' => Employee::with('user', 'salaryDetails')
                ->findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Salary $salary
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SalaryDetailsRequest $request, $id)
    {
        Employee::findOrFail($id)->salaryDetails()->updateOrCreate([
            'employee_id' => $id,
            'basic_salary' => $request->get('basic_salary'),
        ], [
            'living_allowance' => $request->get('living_allowance'),
            'attendance_allowance' => $request->get('attendance_allowance'),
            'levy' => $request->get('levy'),
            'in_charge_allowance' => $request->get('in_charge_allowance'),
        ]);
        if ($request->get('continue') == true) {
            return Redirect::route('employees.annual-leave.index', $id)
                ->with('success', 'Salary Details Saved.');
        }
        return Redirect::back()->with('success', 'Salary Details Saved.');
    }
}
