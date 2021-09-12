<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveQuota;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return Response
     */
    public function index($id): Response
    {
        return Inertia::render('Employees/Edit/AnnualLeave', [
            'employee' => Employee::with(['user', 'leaveQuota'])->findOrFail($id),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'annual_quota' => ['nullable', 'min:1', 'max:2', 'numeric'],
            'medical_quota' => ['nullable', 'min:1', 'max:2', 'numeric'],
            'bereavement_quota' => ['nullable', 'min:1', 'max:2', 'numeric'],
            'hospital_quota' => ['nullable', 'min:1', 'max:2', 'numeric'],
            'paternity_maternity_quota' => ['nullable', 'min:1', 'max:2', 'numeric'],
        ]);

        LeaveQuota::updateOrCreate([
            'employee_id' => $id
        ], [
            'annual_leave' => $request->get('annual_leave'),
            'medical_leave' => $request->get('medical_leave'),
            'bereavement_leave' => $request->get('bereavement_leave'),
            'hospital_leave' => $request->get('hospital_leave'),
            'paternity_maternity_leave' => $request->get('paternity_maternity_leave'),
        ]);

        return Redirect::back()->with('success', 'Employee info Saved.');
    }
}
