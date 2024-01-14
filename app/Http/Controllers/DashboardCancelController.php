<?php

namespace App\Http\Controllers;

use App\Models\Cancel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardCancelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Cancel::query();
        $cancels = clone $query;
        if (auth()->user()->id == 1) {

            $cancels = $cancels->distinct('user_id')->get(['user_id', 'id', 'district', 'created_at'])->groupBy('user_id')->map(function ($group) {
                return $group->first();
            });
        } else {
            $cancels = $query->where('user_id', auth()->user()->id)->limit(1)->get();
        }

        return view('dashboard.cancel.index', compact('cancels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.cancel.tambah');
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
            Cancel::create([
                'user_id' => $user->id,
                'district' => $user->district,
                'no_resi' => $no_resi,
            ]);
        }

        return redirect()->route('dashboard.cancel.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        $query = Cancel::query();
        $cancels = clone $query;
        if (auth()->user()->id == 1) {

            $cancels = $cancels->get(['user_id', 'id', 'district', 'created_at', 'no_resi'])->map(function ($group) {
                return $group->first();
            });
        } else {
            $cancels = $query->where('user_id', auth()->user()->id)->limit(1)->get();
        }
        $cancels = Cancel::where('user_id', $user_id)->get();
        return view('dashboard.cancel.view', compact('cancels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cancel $cancel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cancel $cancel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        Cancel::where('user_id', $id)->delete();
        return back();
    }
}
