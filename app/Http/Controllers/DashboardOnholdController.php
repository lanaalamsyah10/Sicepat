<?php

namespace App\Http\Controllers;

use App\Models\Onhold;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class DashboardOnholdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Onhold::query();
        $onholds = clone $query;
        if (auth()->user()->id == 1) {

            $onholds = $onholds->distinct('user_id')->get(['user_id', 'id', 'district',  'created_at'])->groupBy('user_id')->map(function ($group) {
                return $group->first();
            });
        } else {
            $onholds = $query->where('user_id', auth()->user()->id)->limit(1)->get();
        }

        return view('dashboard.onhold.index', compact('onholds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.onhold.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'no_resi.*' => 'required|string|max:255',
        ]);

        foreach ($request->input('no_resi') as $no_resi) {
            Onhold::create([
                'user_id' => $user->id,
                'district' => $user->district,
                'no_resi' => $no_resi,
            ]);
        }

        return redirect()->route('dashboard.onhold.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        $query = Onhold::query();
        $onholds = clone $query;
        if (auth()->user()->id == 1) {

            $onholds = $onholds->get(['user_id', 'id', 'district', 'created_at', 'no_resi'])->map(function ($group) {
                return $group->first();
            });
        } else {
            $onholds = $query->where('user_id', auth()->user()->id)->limit(1)->get();
        }
        $onholds = Onhold::where('user_id', $user_id)->get();

        return view('dashboard.onhold.view', compact('onholds'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Onhold $onhold)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Onhold $onhold)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        Onhold::where('user_id', $id)->delete();
        return back();
    }
}
