<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductsResource;
use App\Http\Resources\sectionsResourse;
use App\Product;
use App\Section;
use App\Slide;
use App\Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {

    }


    public function get_best_of_group($group ,$column ,$length){
        $ids = array();
        $id = 0;
        $best_products = array();
        for ($i = 0 ; $i < $length ;$i++){
            $the_best = 0;
            for ($a = 0 ; $a < count($group) ;$a++){
                if($group[$a]->$column > $the_best && !in_array($a ,$ids)){
                    $the_best = $group[$a]->$column;
                    $id = $a;
                }
            }
            if(!in_array($id ,$ids)){
                $ids[] = $id;
                $best_products[] = $group[$id];
            }
        }
        return $best_products;
    }

    public function index()
    {
        $products = ProductsResource::collection(Product::all());

        $sections = sectionsResourse::collection(Section::selectRaw('id ,section_name_en ,section_name_ar ,section_image')->get());
        return view('home')->with([
            'sections'=>$sections,
            'slides' => Slide::all(),
            'best_products' => $this->get_best_of_group($products ,'number_of_sell' ,5),
            'suggestions' => $this->get_best_of_group($products ,'discount_present' ,9),
        ]);
    }

    public function products_section ($id){
        $products = Section::find($id)->product;
        $section_name = Section::find($id);
        $sec_name = 'section_name_' . app()->getLocale();
        $section_name = $section_name->$sec_name;
        $images = Image::all();
        return view('section-products')->with(['products'=>$products ,'images'=>$images,'section_name'=>$section_name]);

    }


//    search
    public $last_search = '';
    public function search(Request $request){

        if ($request->value != $this->last_search){
            $result = Product::where('product_name_en' ,'like' ,'%' . $request->value . '%')->orwhere('product_name_ar' ,'like' ,'%' . $request->value . '%')->get();
            $images = array();
            for ($i = 0 ;$i < count($result) ;$i++){
                $images[] = $result[$i]->images[0];
            }


            return response()->json([
                'result' => $result,
                'images' => $images,
            ]);
        }else{
            return response()->json([
                'result' => 0,
            ]);
        }

        $this->last_search = $request->value;
    }


//    all products
    public function allProducts(){
        $products = Product::orderby("created_at" ,"desc")->paginate(25);
        return view('allProducts')->with([
            'products' => $products,
        ]);
    }

//    view product
    public function viewProduct($id){
        return view('view-product') ->with([
            'product' => Product::find($id),
        ]);
    }



} //// end of the class
