<?php

namespace App\Http\Controllers;

use App\Models\ContactDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as QueryRequest;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class ContactDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('ContactDetails/Index', [
            'requests' => QueryRequest::all(['filter', 'sort']),
            'honorariumCategories' => QueryBuilder::for(ContactDetails::class)
                ->allowedFilters(['number'])
                ->allowedSorts(['number'])
                ->latest('id')
                ->paginate()
                ->appends(request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactDetails  $contactDetails
     * @return \Illuminate\Http\Response
     */
    public function show(ContactDetails $contactDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactDetails  $contactDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactDetails $contactDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactDetails  $contactDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactDetails $contactDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactDetails  $contactDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactDetails $contactDetails)
    {
        //
    }
}
