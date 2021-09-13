<?php

namespace App\Http\Controllers;

use App\Enums\ContactAddressType;
use App\Enums\ContactNumberType;
use App\Models\ContactDetails;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class ContactDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return Response
     */
    public function index($id)
    {
        return Inertia::render('Employees/Edit/ContactDetails/Index', [
            'employee' => Employee::with('user', 'contactNumbers', 'contactEmails', 'contactAddress')->findOrFail($id),
            'addressTypes' => ContactAddressType::getValues(),
            'numberTypes' => ContactNumberType::getValues()
        ]);
    }

    /**
     * @param $employeeId
     * @param $contactDetailsId
     * @return RedirectResponse
     */
    public function destroyItem($employeeId, $contactDetailsId): RedirectResponse
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
     * @return void
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function storeNumber(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'items.*.contact_number' => ['required', 'string', 'min:3', 'max:255'],
            'items.*.contact_number_type' => ['required']
        ]);

        $employee = Employee::findOrFail($id);

        foreach ($request->get('items') as $item) {
            if (isset($item['id'])) {
                $employee->contactNumbers()->find($item['id'])->update([
                    'number' => $item['contact_number'],
                    'contact_type' => $item['contact_number_type']
                ]);
            } else {
                $employee->contactNumbers()->create([
                    'contact_type' => $item['contact_number_type'],
                    'number' => $item['contact_number'],
                ]);
            }
        }
        if ($request->get('continue') == true) {
            return Redirect::route('employees.edit.contributions.index', $id)
                ->with('success', 'Contact Details Saved.');
        }
        return Redirect::back()->with('success', 'Contact Details Saved.');
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function storeEmail(Request $request, $id): RedirectResponse
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

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function storeAddress(Request $request, $id): RedirectResponse
    {
        // dd($request->all());
        $this->validate($request, [
            'items.*.type' => ['required'],
            // 'items.*.nationality' => ['required'],
            'items.*.city' => ['required'],
            'items.*.postal_code' => ['required'],
            'items.*.state' => ['required'],
            'items.*.address_line_one' => ['required'],
            'items.*.address_line_two' => ['nullable'],
            'items.*.address_line_three' => ['nullable'],
        ]);

        $employee = Employee::findOrFail($id);

        foreach ($request->get('items') as $item) {
            $employee->contactAddress()->updateOrCreate([
                'employee_id' => $employee->id,
                'type' => $item['type'],
                // 'country' => $item['country'],
                'address_line_one' => $item['address_line_one'],
                'address_line_two' => $item['address_line_one'],
                'address_line_three' => $item['address_line_three'],
                'postal_code' => $item['postal_code'],
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
     * @param ContactDetails $contactDetails
     * @return \Illuminate\Http\Response
     */
    public function show(ContactDetails $contactDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ContactDetails $contactDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactDetails $contactDetails): \Illuminate\Http\Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ContactDetails $contactDetails
     * @return void
     */
    public function update(Request $request, ContactDetails $contactDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ContactDetails $contactDetails
     * @return void
     */
    public function destroy(ContactDetails $contactDetails)
    {
        //
    }
}
