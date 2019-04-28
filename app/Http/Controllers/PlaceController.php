<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\PlaceUpdateRequest;
use App\Http\Requests\PlaceStoreRequest;
use App\Place;

class PlaceController extends Controller
{

     public function __construct()
    {
        date_default_timezone_set('US/Central');
    }
    public function index(Request $request)
    {
        $search=$request->input('search');
        $places = Place::orderBy('domain','asc')
            ->orderBy('municipality','asc')
            ->orderBy('address','asc')
            ->search($search)
            ->paginate(20);
        return view('admin_menu.places',compact('places','search'));
    }

    public function create()
    {
        return view('admin_menu.add_place');
    }

    public function store(PlaceStoreRequest $request)
    {
        $place = new Place([
            'domain'=>$request->input('domain'),
            'municipality'=>$request->input('municipality'),
            'address'=>$request->input('address')
        ]);
        $place->save();

        return redirect()->route('lugares.index');
    }

    public function edit($id)
    {
        $place = Place::find($id);
        return view('admin_menu.edit_place',compact('place'));
    }

    public function update(PlaceUpdateRequest $request, $id)
    {
        $place = Place::find($id);
        $place->domain = $request->input('domain');
        $place->municipality = $request->input('municipality');
        $place->address = $request->input('address');
        $place->save();
        return redirect()->route('lugares.index');
    }

    public function destroy($id)
    {
        $place = Place::find($id);
        $place->delete();
        return redirect()->route('lugares.index');
    }
}
