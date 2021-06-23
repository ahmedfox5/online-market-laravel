<?php

namespace App\Http\Controllers;

use App\Like;
use App\Product;
use App\Image;
use App\Section;
use App\Section_product;
use App\Shoppingcart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class dProductCont extends Controller
{

    public function index()
    {
//        $products = Product::paginate(20);
        $products = array();
        if(auth()->user()->job === 1 ){
            $products = Product::all();
        }else{
            $products = auth()->user()->products;
        }
        $images = Image::all();
        return view('dashboard.products.products')->with([
            'products'=>$products,
            'images' => $images,
        ]);

    }//end of index function


    public function create()
    {
        $sections = Section::all();
        return view('dashboard.products.create')->with(['sections' => $sections]);
    }


    public function store(Request $request)
    {


        $request->validate([
            'product_name_en'=>'required',
            'product_name_ar'=>'required',
            'product_desc_en'=>'required',
            'product_desc_ar'=>'required',
            'price'=>'required|numeric',
            'section0'=>'required',
        ]);

        for($i = 0 ; $i < count($request->file()) ;$i++){
            $name = 'image' . $i;
            $request->validate([
                $name => 'required|mimes:png,jpeg,jpg|max:8000'
            ]);
        }


        $new_product = new Product();
        $new_product->product_name_en = $request->product_name_en;
        $new_product->product_name_ar = $request->product_name_ar;
        $new_product->product_desc_en = $request->product_desc_en;
        $new_product->product_desc_ar = $request->product_desc_ar;
        $new_product->price = $request->price;
        $new_product->after_discount = $request->price;
        $new_product->discount_present = 0;
        $new_product->priority = 20;
        $new_product->section_id = 30;
        $new_product->user_id = auth()->user()->id;
        $new_product->save();


        $last = Product::all()->last();
        for ($i = 0 ;$i < count($request->file()) ;$i++){
            $name = 'image' . $i;
            $file_extension = $request ->$name ->getClientOriginalExtension();
            $file_name =$request->$name ->getSize() . str_replace('.','' ,$request->$name ->getClientOriginalName()) . time() . '.' . $file_extension;
            $request ->$name ->move('img/products',$file_name);

            $new_img = new Image();
            $new_img->image_name =$file_name;
            $new_img->product_id = $last->id ;
            $new_img->save();
        }  /// end of register images

        $section_index = 0;
        for ($i = 6 ;$i < (count($request->all()) - count($request->file())) ;$i++){
            $section_name = 'section' . $section_index;
            $section_value = $request->$section_name;
            DB::insert('insert into section_product (section_id ,product_id) values (?,?)' ,[intval($section_value) ,$last->id]);
            $section_index++;
        }

        return redirect()->back();

    }//end  of store products


    // public function show(Product $product)
    // {
    //     //
    // }


    public function edit($id)
    {
        $product = Product::where("id",$id)->get();
        $images = Image::where("product_id",$id)->get();
        $sections = Section::all();
        if(session()->has('product_update')){
            session()->remove('product_update');
        }
        session()->put('product_update' ,$product[0]->id);
        return view('dashboard.products.edit')->with(['product'=>$product[0],'images'=>$images ,'sections' => $sections]);

    }   // end of edit function

    public function img_destroy($id){
        $image = Image::where("id",$id)->get();
        if(File::exists(public_path('img/products/' . $image[0]->image_name))){
            File::delete(public_path('img/products/' . $image[0]->image_name));
        }
        Image::destroy($id);
        return redirect()->back();
    }

    public function deleteProductSection($sec_id,$pro_id){
        $sec = Section_product::where('section_id' ,$sec_id)->where('product_id',$pro_id)->get();
        Section_product::destroy($sec[0] ->id);
        return redirect()->back();
    }


    /////// update the product
    public function update(Request $request)
    {

        $request->validate([
            'product_name_en' => 'required',
            'product_name_ar' => 'required',
            'product_desc_en' => 'required',
            'product_desc_ar' => 'required',
            'price' => 'required|numeric',
        ]);

        if (session()->has('product_update')){
            for($i = 0 ; $i < count($request->file()) ;$i++){
                $name = 'image' . $i;
                $request->validate([
                    $name => 'mimes:png,jpeg,jpg|max:8000'
                ]);
            }


            $product = Product::find(session()->get('product_update'));


            $price_after_disc = $request->price - (($request->price / 100) * $product->discount_present);

            if($price_after_disc != $product->after_discount){
                $product->update([
                    'after_discount' => $price_after_disc,
                ]);
            }

            $product->update([
                'product_name_en' => $request->product_name_en,
                'product_name_ar' => $request->product_name_ar,
                'product_desc_en' => $request->product_desc_en,
                'product_desc_ar' => $request->product_desc_ar,
                'price' => $request->price,
            ]);

            for ($i = 0 ; $i < count($request->file());$i++ ){
                $name = 'image' . $i;

                $fileExtension = $request->$name ->getClientOriginalExtension();
                $fileName = $request->$name ->getSize() . str_replace('.' , '' ,$request->$name->getClientOriginalName()) . time() . '.' . $fileExtension;
                $request->$name ->move('img/products' ,$fileName);

                $img = new Image();
                $img->image_name = $fileName;
                $img->product_id = session()->get('product_update');
                $img->save();
            }

            $section_index = 0;
            for ($i = 6 ;$i < (count($request->all()) - count($request->file())) ;$i++){
                $section_name = 'section' . $section_index;

                $section_product = new Section_product();
                $section_product->product_id = session()->get('product_update');
                $section_product->section_id = $request->$section_name;
                $section_product->save();

                $section_index++;
            }
        }
        return redirect() ->back();
    }  /////////// end of update function


    public function update_price_disc($id ,$present){
        $product = Product::find($id);
        $price = $product->price;
        if( isset($present) && $present > 0){
            $price_after_disc = $price - (($price / 100) * $present);
            return $price_after_disc;
        }else{
            return $price;
        }
    }////// end of update price discount function


    public function discount(Request $request){
        $request->validate([
            'present'=>'required|numeric',
        ]);

        $new_price = $this->update_price_disc($request->id ,$request->present);

        Product::find($request->id)->update([
            'after_discount' => $new_price,
            'discount_present' => $request->present,
        ]);

        return response()->json([
            'new_price' => $new_price ,
            'present' => $request->present
        ]);
    }


    public function destroy($id)
    {
        Product::destroy($id);
        $images = Image::where('product_id',$id)->get();
        for ($i = 0 ; $i < count($images) ;$i++){
            Image::destroy($images[$i]->id);
            if(File::exists(public_path('img/products/'.$images[$i]->image_name))){
                File::delete(public_path('img/products/'.$images[$i]->image_name));
            }
        } // /// end of delete images

        $sections = Section_product::where('product_id',$id)->get();
        foreach ($sections as $section){
            Section_product::destroy($section->id);
        }  ///// destroy sections of the product

       Shoppingcart::where('user_id' ,auth()->user()->id)->where('product_id' ,$id)->delete();

        return redirect() ->back();
    }// end of destroy


    //////////////  start of likes functions
    public function setLike(Request $request){
        $new_like = new Like();
        $new_like->product_id = $request->id;
        $new_like->user_id = auth()->user()->id;
        $new_like->save();
    }


    public function deleteLike(Request $request){
        $like = Like::where('product_id' ,$request->id)->where('user_id' ,auth()->user()->id)->get();
        Like::destroy($like[0]->id);
    }


//    search
    public function search (Request $request){
        $products = Product::where("product_name_en" ,"like" ,"%" . $request->value . "%")
            -> orwhere("product_name_ar" ,"like" ,"%" . $request->value . "%")
            -> with('user')
            -> with('images')
            -> get();

        return response()->json([
            "products" => $products,
            "success" => true,
        ]);
    }


}// end of controller


