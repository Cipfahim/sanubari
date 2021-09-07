<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payslip;
use App\Models\PayslipSession;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as QueryRequest;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class PayslipController extends Controller
{
    public function index()
    {
        return Inertia::render('PaySlips/Index', [
            'requests' => QueryRequest::all(['filter', 'sort']),
            'payslips' => QueryBuilder::for(PayslipSession::class)
                ->allowedFilters(['description', 'date_from', 'date_to'])
                ->allowedSorts(['description', 'date_from', 'date_to'])
                ->latest('id')
                ->paginate()
                ->appends(request()->query()),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'date_from' => ['required'],
            'date_to' => ['required']
        ]);
        $payslip = PayslipSession::create([
            'description' => PayslipSession::generateDescription($request->get('date_from')),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
        ]);
        return Redirect::route('payslips.show', $payslip->id);
    }

    public function show($id)
    {
        $paySlipSession = PayslipSession::findOrFail($id);
        return Inertia::render('PaySlips/Upload', [
            'paySlipSession' => $paySlipSession,
            'payslips' => $paySlipSession->payslips()->with('employee')->success()->get(),
            'failedUploads' => $paySlipSession->payslips()->failed()->get()
        ]);
    }

    public function upload(Request $request, $id)
    {
        $payslipSession = PayslipSession::find($id);

        if ($request->hasFile('payslip')) {
            $file = $request->file('payslip');
            $originalFileName = $file->getClientOriginalName();
            $onlyFileName = explode('.', $originalFileName)[0];

            if (preg_match('/^.*_*._.*$/i', $onlyFileName)) {
                $employeeId = explode('_', $onlyFileName)[0];
                //                $year = explode('_', $onlyFileName)[1];
                //                $month = explode('_', $onlyFileName)[2];
                $employee = Employee::find($employeeId);
                if (isset($employeeId) && isset($employee)) {
                    $payslipPath = 'payslips/payslip-session-' . $payslipSession->id .
                        '/' . uniqid() . '-' . now()->timestamp;
                    $file->storeAs('public/' . $payslipPath, $originalFileName);
                    $employee->payslips()->create([
                        'payslip_session_id' => $payslipSession->id,
                        'file_name' => $originalFileName,
                        'file_path' => $payslipPath . '/' . $originalFileName,
                        'note' => 'Employee found.'
                    ]);
                    return $payslipPath;
                } else {
                    $payslipPath = 'payslips/payslip-session-' . $payslipSession->id
                        . '/unknown/' . uniqid() . '-' . now()->timestamp;
                    $file->storeAs('public/' . $payslipPath, $originalFileName);
                    $payslipSession->payslips()->create([
                        'file_name' => $originalFileName,
                        'file_path' => $payslipPath . '/' . $originalFileName,
                        'note' => 'Employee not found.'
                    ]);
                    return $payslipPath;
                }
            } else {
                $payslipPath = 'payslips/payslip-session-' . $payslipSession->id
                    . '/unknown/' . uniqid() . '-' . now()->timestamp;
                $file->storeAs('public/' . $payslipPath, $originalFileName);
                $payslipSession->payslips()->create([
                    'file_name' => $originalFileName,
                    'file_path' => $payslipPath . '/' . $originalFileName,
                    'note' => 'File name format not match.'
                ]);
                return $payslipPath;
            }
        }
    }
}
