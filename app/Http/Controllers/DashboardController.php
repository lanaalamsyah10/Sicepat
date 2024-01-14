<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Saran;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        App::setLocale('id');
        return view('dashboard.index');
    }
}
