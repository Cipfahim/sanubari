<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employees\UpdateIdentificationDetailsRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class IdentificationController extends Controller
{
    public function index($id)
    {
        $countryId = request('country_id');
        return Inertia::render('Employees/Edit/IdentificationDetails', [
            'countries' => Country::select(['id', 'name', 'flag_path'])->get(),
            'cities' => isset($countryId)
                ? City::where('country_id', $countryId)->get()
                : [],
            'employee' => Employee::with('user')->findOrFail($id)
        ]);
    }


    public function update(UpdateIdentificationDetailsRequest $request, $id)
    {
        $request->dd();
        Employee::findOrFail($id)->update([
            'country_id' => $request->get('nationality'),
            'ic_number' => $request->get('identity_card_number'),
            'passport_number' => $request->get('passport_number'),
            'passport_issue_date' => $request->get('passport_issue_date'),
            'passport_expiry_date' => $request->get('passport_expiry_date'),
            'passport_issuing_authority' => $request->get('passport_issuing_authority'),
            'date_of_birth' => Carbon::parse($request->get('date_of_birth'))->toDateString(),
            'country_of_birth' => $request->get('country_of_birth'),
            'state_of_birth' => $request->get('state_of_birth'),
            'sex' => $request->get('sex'),
        ]);
        if ($request->get('continue') == true) {
            return Redirect::route('employees.edit.contact-details.index', $id)
                ->with('success', 'Identification Details Saved.');
        }
        return Redirect::back()->with('success', 'Identification Details Saved.');
    }
}
