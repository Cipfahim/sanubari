<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as QueryRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\QueryBuilder\QueryBuilder;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('City/Index', [
            'requests' => QueryRequest::all(['filter', 'sort']),
            'cities' => QueryBuilder::for(City::class)
                ->allowedFilters(['name'])
                ->allowedSorts(['name'])
                ->orderBy('name')
                ->with('country')
                ->paginate()
                ->appends(\request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return  Inertia::render('City/Create', [
           'countries' => Country::all()
        ]);
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
        $this->validate($request, [
            "name" => ['required', 'string', 'max:90', 'unique:cities'],
            "country" => ['required', 'integer'],
        ]);

        City::create([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'country_id' => $request->get('country')
        ]);

        return Redirect::route('settings.cities.index')->with('success', "City Added");
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
     * @param City $city
     * @return Response
     */
    public function edit(City $city): Response
    {
        return  Inertia::render('City/Edit', [
            'countries' => Country::all(),
            'city' => $city
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param City $city
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, City $city): RedirectResponse
    {
        $this->validate($request, [
            "name" => ['required', 'string', 'max:90', 'unique:cities,name,' . $city->id],
            "country" => ['required', 'integer'],
        ]);

        $city->update([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'country_id' => $request->get('country')
        ]);

        return Redirect::back()->with('success', "City Updated");
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
