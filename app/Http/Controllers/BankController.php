<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Bank/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        return Redirect::route('banks.index')->with('success',"Bank Added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
