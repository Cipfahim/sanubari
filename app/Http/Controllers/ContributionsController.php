<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employees\ContributionRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ContributionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index($id)
    {
        return Inertia::render('Employees/Edit/Contributions', [
            'employee' => Employee::with('user', 'contribution')->findOrFail($id)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ContributionRequest $request, $id)
    {
        Employee::findOrFail($id)->contribution()->updateOrCreate([
            'employee_id' => $id,
            'epf_employee' => $request->get('epf_employee'),
        ], [
            'epf_employer' => $request->get('epf_employer'),
            'socso_group' => $request->get('socso_group'),
            'epf_no' => $request->get('epf_no'),
        ]);
        if ($request->get('continue') == true) {
            return Redirect::route('employees.salary-details.index', $id)
                ->with('success', 'Contribution Details Saved.');
        }
        return Redirect::back()->with('success', 'Contribution Details Saved.');
    }
}
