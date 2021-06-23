<?php

namespace App\Http\Controllers;

use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class sliderCont extends Controller
{

    public function index()
    {
        $slides = Slide::all();
        return view('dashboard.slider.slides')->with(['slides' => $slides]);
    }


    public function create()
    {
        return view('dashboard.slider.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg',
            'image2' => 'required|mimes:png,jpg,jpeg',
        ]);

        $file_extension = $request->image->getClientOriginalExtension();
        $file_name = time() . '_' . str_replace(['.' ,'g'] ,'' ,$request->image->getClientOriginalName()) . rand(0 ,1000) . '.' . $file_extension;
        $request->image ->move('img/slides' ,$file_name);
        $request->image2 ->move('img/slides/mobile' ,$file_name);

        Slide::create([
            'image_name'=>$file_name,
        ]);

        return redirect()->to('/dashboard/slider');
    }


    public function show(Slide $slide)
    {
        //
    }


    public function edit($id)
    {
        $slide = Slide::find($id);
        return view('dashboard.slider.edit')->with(['slide'=>$slide]);
    }


    public function update($id, Request $request)//////////////////////////sedfsfewfwefewfwefewfewf///////////////
    {
        if($request->file()){
            $old_img = Slide::find($id);
            if ($request->image){

                if (File::exists(public_path('img/slides/' . $old_img->image_name))){
                    File::delete(public_path('img/slides/' . $old_img->image_name));
                }
                $request->image->move('img/slides' ,$old_img->image_name);

            }

            if ($request->image2){

                if (File::exists(public_path('img/slides/mobile/' . $old_img->image_name))){
                    File::delete(public_path('img/slides/mobile/' . $old_img->image_name));
                }
                $request->image2->move('img/slides/mobile' ,$old_img->image_name);

            }
        }
        return redirect()->to('/dashboard/slider');
    }


    public function destroy($id)
    {
        $img = Slide::find($id);
        if(File::exists(public_path('img/slides/' . $img->image_name))){
            File::delete(public_path('img/slides/' . $img->image_name));
        }
        Slide::destroy($id);
        return redirect() -> to('/dashboard/slider');
    }
}
