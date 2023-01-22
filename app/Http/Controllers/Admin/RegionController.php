<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Region\StoreRequest;
use App\Http\Requests\Admin\Region\UpdateRequest;
use App\Models\Edge;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::paginate(50);
        $edge    = Edge::all();
        return \response([
            'regions' => $regions,
            'edges'   => $edge,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $data=$request->validated();

        Region::firstOrCreate($data);
    }

    public function update(UpdateRequest $request, Region $region)
    {
        $data=$request->validated();

        $region->update($data);
    }


    public function destroy(Region $region)
    {
        $region->delete();
    }
}
