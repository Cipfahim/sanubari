<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request as QueryRequest;
use Inertia\Inertia;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\QueryBuilder;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('ActivityLogs/Index', [
            'requests' => QueryRequest::all(['filter', 'sort']),
            'activityLogs' => QueryBuilder::for(Activity::class)
                ->with('causer')
                ->allowedFilters(['subject_type'])
                ->allowedSorts(['subject_type', 'description', 'created_at'])
                ->latest('id')
                ->paginate()
                ->appends(request()->query()),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        return Inertia::render('ActivityLogs/Show', [
            'activityLog' => Activity::with('causer')
                ->findOrFail($id),
        ]);

    }
}
