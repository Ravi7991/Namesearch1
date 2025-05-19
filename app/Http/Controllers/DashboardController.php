<?php

namespace App\Http\Controllers;

use App\Models\PoliceRecord;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $totalRecords = PoliceRecord::count();
        $recentRecords = PoliceRecord::orderBy('created_at', 'desc')->take(5)->get();
        $openCases = PoliceRecord::where('status', 'open')->count();
        $closedCases = PoliceRecord::where('status', 'closed')->count();
        
        return view('dashboard', compact(
            'totalRecords',
            'recentRecords',
            'openCases',
            'closedCases'
        ));
    }
}
