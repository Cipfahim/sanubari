<?php

namespace App\Http\Controllers;

use App\Enums\ContactAddressType;
use App\Models\ContactAddress;
use App\Models\ContactDetails;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ContactDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index($id)
    {
        return Inertia::render('Employees/Edit/ContactDetails/Index', [
            'employee' => Employee::with('user', 'contactNumbers', 'contactEmails', 'contactAddress')->findOrFail($id),
            'addressTypes' => ContactAddressType::getValues()
        ]);
    }

    public function destroyItem($employeeId, $contactDetailsId)
    {
        Employee::findOrFail($employeeId)
            ->contactDetails()
            ->findOrFail($contactDetailsId)
            ->delete();
        return Redirect::back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNumber(Request $request, $id)
    {
        $this->validate($request, [
            'items.*.contact_number' => ['required', 'string', 'min:3', 'max:255', 'regex:/^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/']
        ]);

        $employee = Employee::findOrFail($id);

        foreach ($request->get('items') as $item) {
            if (isset($item['id'])) {
                $employee->contactNumbers()->find($item['id'])->update([
                    'value' => $item['contact_number'],
                ]);
            } else {
                $employee->contactNumbers()->create([
                    'type' => 'number',
                    'value' => $item['contact_number'],
                ]);
            }
        }
        if ($request->get('continue') == true) {
            return Redirect::route('employees.edit.contributions.index', $id)
                ->with('success', 'Contact Details Saved.');
        }
        return Redirect::back()->with('success', 'Contact Details Saved.');
    }

    public function storeEmail(Request $request, $id)
    {
        $this->validate($request, [
            'items.*.email' => ['required', 'string', 'min:3', 'max:255', 'email']
        ]);

        $employee = Employee::findOrFail($id);

        foreach ($request->get('items') as $item) {
            $employee->contactEmails()->updateOrCreate([
                'employee_id' => $employee->id,
                'type' => 'email',
                'value' => $item['email'],
            ], []);
        }
        if ($request->get('continue') == true) {
            return Redirect::route('employees.edit.contributions.index', $id)
                ->with('success', 'Contact Details Saved.');
        }
        return Redirect::back()->with('success', 'Contact Details Saved.');
    }

    public function storeAddress(Request $request, $id)
    {
//        $this->validate($request, [
//            'items.*.address' => ['required', 'string', 'min:3', 'max:255']
//        ]);

        $employee = Employee::findOrFail($id);

        foreach ($request->get('items') as $item) {
            $employee->contactAddress()->updateOrCreate([
                'employee_id' => $employee->id,
                'type' => $item['addressType'],
                'country' => $item['country'],
                'address_line_one' => $item['address_line_one'],
                'address_line_two' => $item['address_line_one'],
                'address_line_three' => $item['address_line_three'],
                'city' => $item['city'],
                'state' => $item['state']
            ]);
        }
        if ($request->get('continue') == true) {
            return Redirect::route('employees.edit.contributions.index', $id)
                ->with('success', 'Contact Details Saved.');
        }
        return Redirect::back()->with('success', 'Contact Details Saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ContactDetails $contactDetails
     * @return \Illuminate\Http\Response
     */
    public function show(ContactDetails $contactDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ContactDetails $contactDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactDetails $contactDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ContactDetails $contactDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactDetails $contactDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ContactDetails $contactDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactDetails $contactDetails)
    {
        //
    }
}
