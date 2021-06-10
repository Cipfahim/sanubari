<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index($id)
    {
        return Inertia::render('Employees/Edit/AnnualLeave', [
            'employee' => Employee::with('user')->findOrFail($id)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'leave_quota' => ['required', 'min:1', 'max:255', 'numeric']
        ]);

        $employee = Employee::findOrFail($id);

        $employee->update([
            'annual_leave_quota' => $request->get('leave_quota'),
        ]);

        return Redirect::back()->with('success', 'Employee info Saved.');
    }
}
