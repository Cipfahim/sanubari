<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Employee;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as QueryRequest;
use Illuminate\Support\Facades\Storage;
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
        return Inertia::render('Employees/Documents/Create', [
            'employee' => Employee::with('user')->findOrFail($id),
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'description' => ['required', 'string'],
            'year' => ['required', 'string'],
            'document' => ['required', 'string'],
        ]);
        $employee = Employee::findOrFail($id);

        $tempFile = TemporaryFile::where('folder', $request->get('document'))->first();
        if (!isset($tempFile)) {
            return Redirect::back()->with('error', 'Document was not uploaded');
        }

        $documentPath = Storage::move('temp/' . $tempFile->folder . '/' . $tempFile->filename, 'public/documents/' . $tempFile->filename);

        $employee->documents()->create([
            'description' => $request->get('description'),
            'year' => $request->get('year'),
            'file_path' => $documentPath,
        ]);

        $tempFile->delete();
        return Redirect::route('employees.documents.index', $id);
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
