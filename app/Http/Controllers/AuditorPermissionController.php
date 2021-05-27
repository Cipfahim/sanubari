<?php

namespace App\Http\Controllers;

use App\Models\AuditorPermission;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as QueryRequest;
use Illuminate\Support\Str;

class AuditorPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('AuditorAccess/Create');
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
     * @param  \App\Models\AuditorPermission  $auditorPermission
     * @return \Illuminate\Http\Response
     */
    public function show(AuditorPermission $auditorPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuditorPermission  $auditorPermission
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditorPermission $auditorPermission)
    {
        return Inertia::render('AuditorAccess/Edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AuditorPermission  $auditorPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuditorPermission $auditorPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuditorPermission  $auditorPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuditorPermission $auditorPermission)
    {
        //
    }
}
