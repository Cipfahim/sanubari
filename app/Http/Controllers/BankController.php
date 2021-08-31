<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as QueryRequest;
use Illuminate\Support\Str;
use App\Models\Bank;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Bank/Index',[
            'requests' => QueryRequest::all(['filter','sort']),
            'banks' => QueryBuilder::for(Bank::class)
                        ->allowedFilters(['name'])
                        ->allowedSorts(['name'])
                        ->latest('id')
                        ->paginate()
                        ->appends(\request()->query()),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Bank/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request , [
            "name" => ['required','string','max:90','unique:banks'],
            "swift_code" => ['required','regex:/^[a-z]{6}[0-9a-z]{2}([0-9a-z]{3})?\z/i'],
        ]);
        Bank::create([
            'name' => $request->get('name'),
            'swift_code' => $request->get('swift_code'),
            'slug' => Str::of($request->get('name'))->slug('-'),
        ]);
        return Redirect::route('settings.banks.index')->with('success',"Bank Added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Bank $bank)
    {
        return Inertia::render('Bank/Edit', [
            'banks' => $bank
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Bank $bank)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:50', 'unique:banks,name,' . $bank->id],
            "swift_code" => ['required','regex:/^[a-z]{6}[0-9a-z]{2}([0-9a-z]{3})?\z/i'],
        ]);

        // Create new category.
        $bank->update([
            'name' => $request->get('name'),
            'swift_code' => $request->get('swift_code'),

        ]);
        return Redirect::back()
            ->with('success', 'Bank Details Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
