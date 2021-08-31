<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PayslipController extends Controller
{
    public function index()
    {
        return Inertia::render('PaySlips/Index');
    }

    public function upload()
    {
        return Inertia::render('PaySlips/UploadAll');
    }
}
