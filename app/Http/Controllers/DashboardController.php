<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Saran;
use App\Models\Cancel;
use App\Models\Onhold;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        App::setLocale('id');
        $onhold = Onhold::count();
        $useronhold = Onhold::distinct('user_id')->count();
        $cancel = Cancel::count();
        $usercancel = Cancel::distinct('user_id')->count();
        $saranQuery = Saran::query();

        if (auth()->user()->id != 1) {
            $sarans = $saranQuery->where('user_id', auth()->user()->id)->get();
        } else {
            $sarans = $saranQuery->distinct('user_id')->get(['user_id', 'id', 'district', 'saran',])->groupBy('user_id')->map(function ($group) {
                return $group->first();
            });
        }
        $data = [
            'onhold' => $onhold,
            'cancel' => $cancel,
            'useronhold' => $useronhold,
            'usercancel' => $usercancel,
            'sarans' => $sarans,
        ];
        return view('dashboard.index', $data);
    }
}
