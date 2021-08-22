<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as QueryRequest;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;
use Spatie\QueryBuilder\QueryBuilder;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return Response
     */
    public function index($id): Response
    {
        $employee = Employee::with('user')
            ->findOrfail($id);
        return Inertia::render('Employees/Documents/Index', [
            'employee' => $employee,
            'requests' => QueryRequest::all(['filter', 'sort']),
            'documents' => QueryBuilder::for(Document::class)
                ->where('employee_id', $employee->id)
                ->allowedFilters(['description'])
                ->allowedSorts(['description', 'year'])
                ->latest('id')
                ->paginate()
                ->appends(\request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return Response
     */
    public function create($id): Response
    {
        $employee = Employee::where('user_id', $id)->with('user')->first();

        return Inertia::render('Employees/Documents/Create', [
            'employee' => $employee,
        ]);
    }

    /**
     * @return Response|ResponseFactory
     */
    public function documents()
    {
        return inertia('Employees/Documents', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
