<?php

namespace App\Http\Controllers;

use App\Models\Saran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Saran::query();

        // Jika user yang sedang login bukan user dengan id 1
        if (auth()->user()->id != 1) {
            $sarans = $query->where('user_id', auth()->user()->id)->get();
        } else {
            // Jika user yang sedang login adalah user dengan id 1
            $sarans = $query->distinct('user_id')->get(['user_id', 'id', 'district', 'saran',])->groupBy('user_id')->map(function ($group) {
                return $group->first();
            });
        }

        return view('dashboard.saran.index', compact('sarans'));
    }

    public function create()
    {
        return view('dashboard.saran.tambah');
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'saran' => 'required',
        ]);
        Saran::create([
            'user_id' => $user->id,
            'district' => $user->district,
            'saran' => $request->saran,
        ]);

        return redirect()->route('dashboard.saran.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saran  $saran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $saran = Saran::find($id);
        $saran->delete();

        return back();
    }
}
