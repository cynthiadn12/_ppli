<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;

class VendorManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vendors = Vendor::paginate(5);

        return view('vendor-mgmt/index', ['vendors' => $vendors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor-mgmt/create');
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
        Vendor::create([
            'comp_title' => $request['comp_title'],
            'comp_name' => $request['comp_name'],
            'address' => $request['address'],
            'npwp' => $request['npwp'],
            'sap_num' => $request['sap_num'],
        ]);

        return redirect()->intended('/vendor-management');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($vendor == null || count($vendor) == 0) {
            return redirect()->intended('/vendor-management');
        }

        return view('vendor-mgmt/edit', ['vendor' => $vendor]);
    }

    /**
     * Update the
     * specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $input = [
            'comp_title' => $request['comp_title'],
            'comp_name' => $request['comp_name'],
            'address' => $request['address'],
            'npwp' => $request['npwp'],
            'sap_num' => $request['sap_num'],
        ];
        $this->validate($request, [
            'comp_title' => 'required|max:60',
            'comp_name' => 'required|max:60',
        ]);
        Vendor::where('id', $id)
            ->update($input);

        return redirect()->intended('vendor-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vendor::where('id', $id)->delete();
        return redirect()->intended('/vendor-management');
    }

    public function search(Request $request) {
        $constraints = [
            'comp_title' => $request['comp_title'],
            'comp_name' => $request['comp_name'],
            'address' => $request['address'],
            'npwp' => $request['npwp']
        ];

        $vendors = $this->doSearchingQuery($constraints);
        return view('vendor-mgmt/index', ['vendors' => $vendors, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Vendor::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }

    private function validateInput($request) {
        $this->validate($request, [
            'comp_title' => 'required|string|max:255',
            'comp_name' => 'required|string|max:255',
            'address' => 'required|string|min:2',
        ]);
    }
}
