<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employees\UpdateIdentificationDetailsRequest;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class IdentificationController extends Controller
{
    public function index($id)
    {
        return Inertia::render('Employees/Edit/IdentificationDetails', [
            'employee' => Employee::with('user')->findOrFail($id)
        ]);
    }


    public function update(UpdateIdentificationDetailsRequest $request, $id)
    {
        Employee::findOrFail($id)->update([
            'citizenship' => $request->get('citizenship'),
            'ic_number' => $request->get('identity_card_number'),
            'passport_number' => $request->get('passport_number'),
            'date_of_birth' => Carbon::parse($request->get('date_of_birth'))->toDateString(),
            'country_of_birth' => $request->get('country_of_birth'),
            'state_of_birth' => $request->get('state_of_birth'),
            'sex' => $request->get('sex'),
        ]);
        if ($request->get('continue') == true) {
            return Redirect::route('employees.contact-details.index', $id)
                ->with('success', 'Identification Details Saved.');
        }
        return Redirect::back()->with('success', 'Identification Details Saved.');
    }
}
