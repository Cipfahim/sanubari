<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employees\BankDetailsRequest;
use App\Models\Bank;
use App\Models\Employee;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BankDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index($id)
    {
        return Inertia::render('Employees/BankDetails', [
            'banks' => Bank::select('id', 'name')->get(),
            'employee' => Employee::with('user', 'bankDetails')
                ->findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BankDetailsRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BankDetailsRequest $request, $id)
    {
        Employee::findOrFail($id)->bankDetails()->updateOrCreate([
            'employee_id' => $id,
            'bank_id' => $request->get('bank'),
        ], [
            'account_number' => $request->get('account_number'),
        ]);
        if ($request->get('continue') == true) {
            return Redirect::route('employees.salary-details.index', $id)
                ->with('success', 'Bank Details Saved.');
        }
        return Redirect::back()->with('success', 'Bank Details Saved.');
    }
}
