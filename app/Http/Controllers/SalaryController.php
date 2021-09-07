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
        return Inertia::render('Employees/Edit/SalaryDetails', [
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
            'basic_salary' => $this->changeString($request->get('basic_salary'))
        ], [
            'living_allowance' => $this->changeString($request->get('living_allowance')),
            'attendance_allowance' => $this->changeString($request->get('attendance_allowance')),
            'levy' => $this->changeString($request->get('levy')),
            'in_charge_allowance' => $this->changeString($request->get('in_charge_allowance')),
        ]);
        if ($request->get('continue') == true) {
            return Redirect::route('employees.edit.annual-leave.index', $id)
                ->with('success', 'Salary Details Saved.');
        }
        return Redirect::back()->with('success', 'Salary Details Saved.');
    }

    public function changeString($string){
        return str_replace(',', '',$string);
    }
}
