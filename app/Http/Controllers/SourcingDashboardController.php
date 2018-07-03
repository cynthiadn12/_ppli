<?php

namespace App\Http\Controllers;

use App\Sourcing;
use Illuminate\Http\Request;

class SourcingDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $sourcings = Sourcing::paginate(5);

        return view('sourcing-dshbrd/index', ['sourcings' => $sourcings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sourcing-dshbrd/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateInput($request);
        Sourcing::create([
            'id_loc_lvl1' => $request['id_loc_lvl1'],
            'id_loc_lvl2' => $request['id_loc_lvl2'],
            'id_vendor' => $request['id_vendor'],
            'id_fish' => $request['id_fish'],
            'qty' => $request['qty'],
            'id_measurement' => $request['id_measurement'],
            'price' => $request['price'],
            'valid_until' => $request['valid_until'],
        ]);

        return redirect()->intended('/sourcing-dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sourcing = Sourcing::find($id);

        if ($sourcing == null || count($sourcing) == 0){
            return redirect()->intended('/
            sourcing-dashboard');
        }

        return view('sourcing-dshbrd/edit', ['sourcing' => $sourcing]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sourcing = Sourcing::findOrFail($id);
        $input = [
            'id_loc_lvl1' => $request['id_loc_lvl1'],
            'id_loc_lvl2' => $request['id_loc_lvl2'],
            'id_vendor' => $request['id_vendor'],
            'id_fish' => $request['id_fish'],
            'qty' => $request['qty'],
            'id_measurement' => $request['id_measurement'],
            'price' => $request['price'],
            'valid_until' => $request['valid_until'],
        ];
        $this->validate($request, [
             'id_loc_lvl1' => 'required|max:11',
             'id_loc_lvl2' => 'required|max:11',
             'id_vendor' => 'required|max:11',
             'id_fish' => 'required|max:11',
             'id_measurement' => 'required|max:11',
        ]);
        Sourcing::where('id', $id)
            ->update($input);

        return redirect()->intended('sourcing-dashboard');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sourcing::where('id', $id)->delete();
        return redirect()->intended('/sourcing-dashboard');
    }

    public function search(Request $request){
        $constraints = [
            'id_loc_lvl1' => $request['id_loc_lvl1'],
            'id_loc_lvl2' => $request['id_loc_lvl2'],
            'id_vendor' => $request['id_vendor'],
            'id_fish' => $request['id_fish'],
            'qty' => $request['qty'],
            'id_measurement' => $request['id_measurement'],
            'price' => $request['price'],
            'valid_until' => $request['valid_until'],
        ];

        $sourcings = $this->doSearchingQuery($constraints);
        return view('sourcing-dshbrd/index',['sourcings' => $sourcings, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints){
        $query = Sourcing::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint){
            if ($constraint != null){
                $query = $query->where($fields[$index],'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }

    private function validateInput($request){
        $this->validate($request, [
            'id_loc_lvl1' => 'required|max:11',
            'id_loc_lvl2' => 'required|max:11',
            'id_vendor' => 'required|max:11',
            'id_fish' => 'required|max:11',
            'id_measurement' => 'required|max:11',
        ]);
    }

}
