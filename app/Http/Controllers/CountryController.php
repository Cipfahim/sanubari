<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as QueryRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Country/Index', [
            'requests' => QueryRequest::all(['filter', 'sort']),
            'countries' => QueryBuilder::for(Country::class)
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
        return Inertia::render('Country/Create');
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
            "name" => ['required', 'string', 'max:90', 'unique:countries'],
            "country_code" => ['required', 'integer', 'unique:countries'],
            "flag" => ['required', 'image']
        ]);

        Country::create([
            'name' => $request->get('name'),
            'country_code' => $request->get('country_code'),
            'slug' => Str::of($request->get('name'))->slug('-'),
            'flag_path' => upload(file: $request->file('flag'),
                folder: 'country',
                disk: 'public')
        ]);
<<<<<<< HEAD
        return Redirect::route('cars.index')->with('success',"Car Added");
=======
        return Redirect::route('settings.countries.index')
            ->with('success', "Country Added");
>>>>>>> 58fb838795fef3b6850a0ef9cdecf3772de3d7b5
    }

    /**
     * Display the specified resource.
     *
     * @param Country $country
     * @return Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Country $country
     * @return \Inertia\Response
     */
    public function edit(Country $country): \Inertia\Response
    {
        return Inertia::render('Country/Edit', [
            'country' => $country
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Country $country
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Country $country): RedirectResponse
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:50', 'unique:countries,name,' . $country->id],
            'country_code' => ['required', 'integer', 'min:4', 'unique:countries,country_code,' . $country->id],
            'flag' => ['required', 'image']
        ]);

        if ($country->file_path) {
            Storage::disk('public')->delete($country->flag_path);
        }

        $country->update([
            'name' => $request->get('name'),
            'country_code' => $request->get('country_code'),
            'slug' => Str::of($request->get('name'))->slug('-'),
            'flag_path' => upload(file: $request->file('flag'),
                folder: 'country',
                disk: 'public')
        ]);
        return Redirect::back()
            ->with('success', 'Country Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Country $country
     * @return Response
     */
    public function destroy(Country $country)
    {
        //
    }
}
