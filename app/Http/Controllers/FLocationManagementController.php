<?php

namespace App\Http\Controllers;

use App\FLocation;
use Illuminate\Http\Request;
use Yajra\DataTables\Services\DataTable;

class FLocationManagementController extends Controller
{
    public function index()
    {
        $data = FLocation::all ();
        return view ( 'flocation-mgmt.index' )->withData ( $data );
        //return view('flocation-mgmt.index');
    }

    public function listData()
    {
        $loc1 = FLocation::orderBy('id', 'desc')->get();
        return DataTable::of($loc1)->make(true);
    }

    public function store(Request $request)
    {
        $flocation = new FLocation;
        $flocation->loc_lvl1 = $request['loc_lvl1'];
        $flocation->save();
    }

    public function edit($id)
    {
        $flocation = FLocation::find($id);
        echo json_encode($flocation);
    }

    public function update(Request $request, $id)
    {
        $flocation = FLocation::find($id);
        $flocation->loc_lvl1 = $request['loc_lvl1'];
        $flocation->update();
    }

    public function destroy($id)
    {
        $flocation = FLocation::find($id);
        $flocation->delete();
    }
}
