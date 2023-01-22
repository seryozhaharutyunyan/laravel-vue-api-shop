<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\StoreRequest;
use App\Http\Requests\Admin\City\UpdateRequest;
use App\Models\City;
use App\Models\Edge;
use App\Models\Region;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::paginate(50);
        $edges  = Edge::all();

        return \response([
            'cities' => $cities,
            'edges'  => $edges,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        City::firstOrCreate($data);
    }

    public function update(UpdateRequest $request, City $city)
    {
        $data = $request->validated();

        $city->update($data);
    }

    public function destroy(City $city)
    {
        $city->delete();
    }

    public function searchRegions(Edge $edge)
    {
        $regions = Region::where('edge_id', $edge->id)->get();

        return \response($regions);
    }
}
