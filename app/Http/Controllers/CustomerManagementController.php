<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerManagementController extends Controller
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
        $customers = Customer::paginate(5);

        return view('customers-mgmt/index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers-mgmt/create');
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
        Customer::create([
            'comp_title' => $request['comp_title'],
            'comp_name' => $request['comp_name'],
            'address' => $request['address'],
            'npwp' => $request['npwp'],
            'sap_num' => $request['sap_num'],
        ]);
        //return Redirect::to('customer-management');
        return redirect()->intended('/customer-management');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
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
        $customer = Customer::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($customer == null || count($customer) == 0) {
            return redirect()->intended('/customer-management');
        }

        return view('customers-mgmt/edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
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
        Customer::where('id', $id)
            ->update($input);

        return redirect()->intended('customer-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::where('id', $id)->delete();
        return redirect()->intended('/customer-management');
    }

    public function search(Request $request) {
        $constraints = [
            'comp_title' => $request['comp_title'],
            'comp_name' => $request['comp_name'],
            'address' => $request['address'],
            'npwp' => $request['npwp'],
        ];

        $customers = $this->doSearchingQuery($constraints);
        return view('customers-mgmt/index', ['customers' => $customers, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Customer::query();
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
