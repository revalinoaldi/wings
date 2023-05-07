<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.report.index',[
            'config' => [
                'title' => 'Reporting Page'
            ],
            'transaksi' => Transaksi::all()
        ]);
    }
}
