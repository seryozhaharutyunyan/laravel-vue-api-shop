<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Aut\Registration\ResetRequest;
use App\Http\Requests\Aut\Registration\StoreRequest;
use App\Http\Requests\Aut\Registration\UpdateAccountRequest;
use App\Http\Requests\Aut\Registration\UpdatePasswordRequest;
use App\Mail\PasswordMail;
use App\Models\City;
use App\Models\Edge;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function registration(StoreRequest $request)
    {
        $data = $request->validated();

        $roles = Role::all();
        unset($data['edge_id']);

        if (isset($data['img']) && ! empty($data['img'])) {
            $data['img'] = \url('storage/' . Storage::disk('public')->
                put('img/users/' . $data['email'], $data['img']));
        } else {
            if ($data['gender'] === 'female') {
                $data['img'] = \url(Storage::url('users/image/female.png'));
            } else {
                $data['img'] = \url(Storage::url('users/image/male.png'));
            }
        }

        foreach ($roles as $role) {
            if ($role->role === 'user') {
                $data['role_id'] = $role->id;
            }
        }

        $password         = Str::random(10);
        $data['password'] = Hash::make($password);

        User::firstOrCreate(['email' => $data['email']], $data);
        Mail::to($data['email'])->send(new PasswordMail($password));

        return \response('Your password has been sent to your email address.');
    }

    public function resetPassword(ResetRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        $password      = Str::random(10);
        $data_password = Hash::make($password);

        $user->update(['password' => $data_password]);
        Mail::to($data['email'])->send(new PasswordMail($password));
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $data = $request->validated();

        unset($data['passwordNew_confirmation']);
        $data['passwordNew'] = Hash::make($data['passwordNew']);

        $user = \auth()->user();

        if (Hash::check($data['password'], $user->password)) {
            $user->update(['password' => $data['passwordNew']]);
        } else {
            return \response(['errors' => ['password' => ['Password is not correct']]], '422');
        }
    }

    public function updateAccount(UpdateAccountRequest $request)
    {
        $data = $request->validated();
        unset($data['edge_id']);

        $user = \auth()->user();

        if (Hash::check($data['password'], $user->password)) {
            unset($data['password']);
            if (isset($data['img']) && ! empty($data['img'])) {
                $data['img'] = \url('storage/' . Storage::disk('public')->
                    put('img/users/' . $user->email, $data['img']));

                //Storage::disk('public')->delete($user->img);
            }else{
                unset($data['img']);
            }
            $user->update($data);
        } else {
            return \response(['errors' => ['password' => ['Password is not correct']]], '422');
        }
    }


    /*888888888888888*/
    public function edges()
    {
        $edges = Edge::all();

        return \response($edges);
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
