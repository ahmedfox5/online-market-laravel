<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class accountSettingsCont extends Controller
{
    public function index(){
        return view('account-settings.account-settings');
    }

    /////change image
    public function img(){
        return view('account-settings.change-image');
    }

    public function imgUpdate(Request $request){
        $request->validate([
           'ch_avatar' => 'mimes:jpg,jpeg,png',
        ]);

        $user = User::find(auth()->user()->id);

        if ($request->file()){

            if($user->img_name == 'default.png'){
                $file_extension = $request->ch_avatar -> getClientOriginalExtension();
                $file_name = time() . '_' . str_replace(['. ,p'] ,'' ,$request->ch_avatar->getClientOriginalName()) . $request->ch_avatar->getSize() . '.' . $file_extension;
                $request->ch_avatar->move('img/users' ,$file_name);
                $user->update([
                    'img_name' => $file_name,
                ]);
            }else{
                if (File::exists(public_path('img/users/' . $user->img_name))){
                    File::delete(public_path('img/users/' . $user->img_name));
                }
                $request->ch_avatar->move('img/users' ,$user->img_name);
            }

        }
        return redirect()->to('/account');

    }


//    password
    public function password(){
        return view('account-settings.change-password');
    }

    public function passwordUpdate(Request $request){
        $request->validate([
           'old_password' => 'required|min:8',
           'new_password' => 'required|min:8',
        ]);
        $user = User::find(auth()->user()->id);
        if (Hash::check($request->old_password ,$user->password)){
            $user->update([
               'password' => Hash::make($request->new_password),
            ]);
            return redirect()->to('/account');
        }else{
            return redirect()->back()->withErrors([
                'old_password' => 'not match!!',
            ]);
        }

    }

}////// end of the class
