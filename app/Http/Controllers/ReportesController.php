<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function reporteBalanceFinal(){
        return view('admin.reports.balance-final');
    }
}
