<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Image;
use Auth;
 

class BrandController extends Controller
{
    //
    public function __construct(){
      $this->middleware('auth');
    }

    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }
    public function StoreBrand(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_image.min' => 'Brand Longer than 4 Characters',   
        ]);
        $brand_image = $request->file('brand_image');
       
          
        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'images/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location,$img_name);
        
         $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
         $last_img = 'images/brand/'.$name_gen;
         Image::make($brand_image)->resize(300,200)->save('images/brand/'.$name_gen);

        
       
         
 
         
        
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Brand Update Succesfully');
       

        
    }
    public function Edit($id){
        $brand = Brand::find($id);
        return view('admin.brand.edit',compact('brand'));

    }
    public function Update(Request $request, $id){
        $validated = $request->validate([
            'brand_name' => 'required|min:4',
             
            
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_image.min' => 'Brand Longer than 4 Characters',
            
        ]);
        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');
        if($brand_image){
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'images/brand/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);
        unlink($old_image);
        
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);
        
            
        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                
                'created_at' => Carbon::now(),
            ]);
          

        }
        return Redirect()->back()->with('success','Brand Update Succesfully');
        

    }
    public function Delete($id){
        $image = Brand::find($id);
        unlink($image->brand_image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('success','Brand Delete Succesfully');
    }
    public function Multipic(){
        $images = Multipic::all();
        return view('admin.multipic.index',compact('images'));
    }
    public function StoreImage(Request $request){
        
        $image = $request->file('image');

        foreach($image as $multi_img){

        $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
       
        
        
       Image::make($multi_img)->resize(300,300)->save('images/multi/'.$name_gen);

        
       
         
 
       $last_img = 'images/multi/'.$name_gen;
        
        Multipic::insert([
            
            'image' => $last_img,
            'created_at' => Carbon::now(),
        ]);
    } //end of the foreach

        return Redirect()->back()->with('success','Multi Image Create Succesfully');
       


    }
    public function Logout(){
        Auth::logout();

        return Redirect()->route('login')->with('success','User Logout');
    }
}
