<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Edge\StoreRequest;
use App\Http\Requests\Admin\Edge\UpdateRequest;
use App\Models\Edge;
use Illuminate\Http\Request;

class EdgeController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $edge=Edge::paginate(50);

        return \response($edge);
    }

    /**
     * @param   StoreRequest  $request
     *
     * @return void
     */
    public function store(StoreRequest $request)
    {
        $data=$request->validated();

        Edge::firstOrCreate(['name'=>$data['name']], $data);
    }

    /**
     * @param   UpdateRequest  $request
     * @param   Edge           $edge
     *
     * @return void
     */
    public function update(UpdateRequest $request, Edge $edge)
    {
        $data=$request->validated();

        $edge->update($data);
    }

    /**
     * @param   Edge  $edge
     *
     * @return void
     */
    public function destroy(Edge $edge)
    {
        $edge->delete();
    }
}
