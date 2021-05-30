<?php

namespace App\Http\Controllers;

use App\Models\HonorariumCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as QueryRequest;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class HonorariumCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('HonorariumCategories/Index', [
            'requests' => QueryRequest::all(['filter', 'sort']),
            'honorariumCategories' => QueryBuilder::for(HonorariumCategory::class)
                ->allowedFilters(['name'])
                ->allowedSorts(['name', 'description', 'status'])
                ->latest('id')
                ->paginate()
                ->appends(request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('HonorariumCategories/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate Request.
        $this->validate($request, [
            'name' => ['required', 'string', 'max:50', 'unique:honorarium_categories'],
            'description' => ['nullable', 'string', 'max:200'],
        ]);

        // Create new category.
        HonorariumCategory::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'status' => $request->get('status')
        ]);
        return Redirect::route('honorarium-categories.index')
            ->with('success', 'Category Added');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\HonorariumCategory $honorariumCategory
     * @return \Illuminate\Http\Response
     */
    public function show(HonorariumCategory $honorariumCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\HonorariumCategory $honorariumCategory
     * @return \Inertia\Response
     */
    public function edit(HonorariumCategory $honorariumCategory)
    {
        return Inertia::render('HonorariumCategories/Edit', [
            'honorariumCategory' => $honorariumCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\HonorariumCategory $honorariumCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, HonorariumCategory $honorariumCategory)
    {
        // Validate Request.
        $this->validate($request, [
            'name' => ['required', 'string', 'max:50', 'unique:honorarium_categories,name,' . $honorariumCategory->id],
            'description' => ['nullable', 'string', 'max:200'],
        ]);

        // Create new category.
        $honorariumCategory->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'status' => $request->get('status')
        ]);
        return Redirect::back()
            ->with('success', 'Category Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\HonorariumCategory $honorariumCategory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(HonorariumCategory $honorariumCategory)
    {
        $honorariumCategory->delete();
        return Redirect::back()
            ->with('success', 'Category Deleted.');
    }
}
