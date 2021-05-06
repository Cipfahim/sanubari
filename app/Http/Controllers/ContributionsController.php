<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as QueryRequest;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class ContributionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Contribution/Create', [
            'requests' => QueryRequest::all(['filter', 'sort']),
            'honorariumCategories' => QueryBuilder::for(Contribution::class)
                ->allowedFilters(['epf_no'])
                ->allowedSorts(['epf_no'])
                ->latest('id')
                ->paginate()
                ->appends(request()->query()),
        ]);
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
     * @param  \App\Models\Contribution  $contributions
     * @return \Illuminate\Http\Response
     */
    public function show(Contribution $contributions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contribution  $contributions
     * @return \Illuminate\Http\Response
     */
    public function edit(Contribution $contributions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contribution  $contributions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contribution $contributions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contribution  $contributions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contribution $contributions)
    {
        //
    }
}
