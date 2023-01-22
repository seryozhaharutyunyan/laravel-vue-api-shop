<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Mail\PasswordMail;
use App\Models\City;
use App\Models\Edge;
use App\Models\Like;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(50);
        $edges = Edge::all();
        return \response([
            'users' => $users,
            'edges' => $edges
        ]);
    }

    public function store(StoreRequest $request)
    {
        $data=$request->validated();

            $roles=Role::all();
            unset($data['edge_id']);
            if($data['gender']==='female'){
                $data['img'] = \url(Storage::url('users/image/female.png'));
            }else{
                $data['img'] = \url(Storage::url('users/image/male.png'));
            }

            foreach ($roles as $role){
                if($role->role==='moderator'){
                    $data['role_id']=$role->id;
                }
            }

            $password=Str::random(10);
            $data['password']=Hash::make($password);

            User::firstOrCreate(['email'=>$data['email']], $data);
            Mail::to($data['email'])->send(new PasswordMail($password));

    }

    public function show(User $user)
    {
        return \response($user);
    }

    public function block(User $user){

        if($user->block){
            $user->update(['block'=>false]);
        }else{
            $user->update(['block'=>true]);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        Like::where('user_id', $user->id)->delete();

    }

    public function edgeRegions(Edge $edge)
    {
        $regions = Region::where('edge_id', $edge->id)->get();

        return \response($regions);
    }

    public function edgeCities(Edge $edge)
    {
        $cities = City::where('edge_id', $edge->id)->where('region_id', null)->get();

        return \response($cities);
    }

    public function regionCities(Region $region)
    {
        $cities = City::where('region_id', $region->id)->get();

        return \response($cities);
    }
}
