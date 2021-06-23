<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class dUserCont extends Controller
{

    public function index()
    {
        $users = User::where('job' ,3)->orwhere('job',2)->paginate(10);
        return view('dashboard.users.users')->with(['users' => $users]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, User $user)
    {
        //
    }

    public function editJob(Request $request){
        User::find($request->id)->update([
            'job' => $request->job,
        ]);
    }


    public function destroy($id)
    {
        if($id !== 1){
            User::destroy($id);
        }
        return redirect()->back();
    }
}
