<?php

namespace App\Http\Controllers;

use App\Image;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class sectionsController extends Controller
{

    public function index()
    {
        $sections = Section::all();
        return view('dashboard.sections.sections')->with(['sections' => $sections]);
    }


    public function create()
    {
        return view('dashboard.sections.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'section_name_en' => 'required|max:255|unique:sections,section_name_en',
            'section_name_ar' => 'required|max:255|unique:sections,section_name_ar',
            'image' => 'mimes:jpg,jpeg,png',
        ]);

        $file_extension = $request->image->getClientOriginalExtension();
        $file_name = time() . '_' . str_replace(['.' ,'p'] ,'' ,$request->image->getClientOriginalName()) . $request->image->getSize()  . '.' . $file_extension;
        $request->image->move('img/sections/' ,$file_name);


        $newSection = new Section();
        $newSection->section_name_en = $request->section_name_en;
        $newSection->section_name_ar = $request->section_name_ar;
        $newSection->section_image = $file_name;
        $newSection->save();
        return redirect()->to('/dashboard/sections');
    }// end of store function


    public function show(Section $section)
    {
        //
    }


    public function edit($id)
    {
        $section = Section::find($id);
        if (session()->has('section_update')){
            session()->remove('section_update');
        }
        session()->put('section_update',$id);
        return view('dashboard.sections.edit')->with(['section'=>$section]);
    }


    public function update(Request $request)
    {
        $request->validate([
            'section_name_en' => 'required|max:255',
            'section_name_ar' => 'required|max:255',
            'image' => 'mimes:jpeg,jpg,png,webp',
        ]);

        if (session()->has('section_update')){
            $section = Section::find(session()->get('section_update'));
            $section_image = $section->section_image;

            if($request->file()){
                if ($section_image){
                    File::delete(public_path('img/sections/' . $section_image));
                    $request->image->move('img/sections/' ,$section_image);
                }else{
                    $file_extension = $request->image->getClientOriginalExtension();
                    $section_image = time() . '_' . $request->image->getSize() . '.' . $file_extension;
                    $request->image->move('img/sections/' ,$section_image);
                }
            }

            $section->update([
                'section_name_en' => $request->section_name_en,
                'section_name_ar' => $request->section_name_ar,
                'section_image' => $section_image,
            ]);
        }

        return redirect()->to('/dashboard/sections');
    }    // end of update function


    public function destroy($id)
    {
        $section = Section::find($id);
        Section::destroy($id);
        if(File::exists(public_path('img/sections/' . $section->section_image))){
            File::delete(public_path('img/sections/' . $section->section_image));
        }
        return redirect()->to('/dashboard/sections');
    }


//    start of get section products
    public function products($id){
        $products = Section::find($id)->product;
        $section_name = Section::find($id);
        $sec_name = 'section_name_' . app()->getLocale();
        $section_name = $section_name->$sec_name;
        $images = Image::all();
        return view('dashboard.sections.products')->with(['products'=>$products ,'images'=>$images,'section_name'=>$section_name]);
    }
}
