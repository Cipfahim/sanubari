<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Payslip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as QueryRequest;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class PayslipController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $employee = Employee::with('user')
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return Inertia::render('Employee/Payslips', [
            'employee' => $employee,
            'requests' => QueryRequest::all(['filter', 'sort']),
            'payslips' => QueryBuilder::for(Payslip::class)
                ->where('employee_id', $employee->id)
                ->allowedFilters(['description'])
                ->allowedSorts(['description', 'date_from', 'date_to'])
                ->latest('id')
                ->paginate()
                ->appends(\request()->query()),
        ]);
    }
}
