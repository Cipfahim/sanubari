<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Inertia\Inertia;

class IdentificationController extends Controller
{
    public function index($id)
    {
        return Inertia::render('Employees/IdentificationDetails', [
            'employee' => Employee::with('user')->findOrFail($id)
        ]);
    }
}
