<?php

namespace App\Http\Controllers;

use App\Fish;
use Illuminate\Http\Request;

class FishManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fishes = Fish::paginate(5);

        return view('fish-mgmt/index', ['fishes' => $fishes]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fish-mgmt/create');
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
        $path = $request->file('pict')->store('avatars');
        $keys = ['fish_name', 'type', 'size', 'description'];
        $input = $this->createQueryInput($keys, $request);
        $input['pict'] = $path;

        Fish::create($input);

        return redirect()->intended('fish-management');
    }
    /**
     * Load image resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function load($name) {
        $path = storage_path().'/app/avatars/'.$name;
        if (file_exists($path)) {
            return Response::download($path);
        }
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
        $fish = Fish::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($fish == null || count($fish) == 0) {
            return redirect()->intended('/fish-management');
        }

        return view('fish-mgmt/edit', ['fish' => $fish]);
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
        $fish = Fish::findOrFail($id);
        $input = [
            'fish_name' => $request['fish_name'],
            'pict' => $request['pict'],
            'type' => $request['type'],
            'size' => $request['size'],
            'description' => $request['description'],
        ];
        $this->validate($request, [
            'fish_name' => 'required|max:60'
        ]);
        Fish::where('id', $id)->update($input);

        return redirect()->intended('fish-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fish::where('id', $id)->delete();
        return redirect()->intended('fish-management');
    }


    /**
     * Search country from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'fish_name' => $request['fish_name'],
            'type' => $request['type'],
        ];

        $fishes = $this->doSearchingQuery($constraints);
        return view('fish-mgmt/index', ['fishes' => $fishes, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Fish::query();
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
            'fish_name' => 'required|max:60',
            'type' => 'required|min:3'
        ]);
    }
}
