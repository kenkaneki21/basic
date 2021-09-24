<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Image;
use Auth;
class HomeController extends Controller
{
    //
    public function __construct(){
      $this->middleware('auth');
    }
    public function HomeSlider(){
    	 $sliders = Slider::latest()->get();
    	return view('admin.slider.index',compact('sliders'));
    }
    public function AddSlider(){
    	return view('admin.slider.create');
    }
    public function StoreSlider(Request $request){
    	  // $validated = $request->validate([
       //      'title' => 'required|unique:brands|min:4',
       //      'description' =>'required|unique:brands|min:4',
       //      'image' => 'required|mimes:jpg,jpeg,png',
       //  ],
       //  [
       //      'title.required' => 'Please Input Brand Name',
       //      'description.required' => 'Please Input Slider Description',
       //      'image.min' => 'Brand Longer than 4 Characters',   
       //  ]);
        $slider_image = $request->file('image');
       
          
         
        
         $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
         $last_img = 'images/slider/'.$name_gen;
         Image::make($slider_image)->resize(1920,1088)->save('images/slider/'.$name_gen);

        
       
         
 
         
        
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,

            'image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('home.slider')->with('success','Slider Inserted Succesfully');
       

    }
    public function EditSlider($id){
      $sliders = Slider::find($id);

      return view('admin.slider.edit',compact('sliders'));
    }
    public function UpdateSLider(Request $request, $id){
     
       

        $validated = $request->validate(
        [
             
            'image.min' => 'Brand Longer than 4 Characters',
            
        ]);
        $old_image = $request->old_image;

        $brand_image = $request->file('image');
        if($brand_image){
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'images/slider/';
        $last_img = $up_location.$img_name;
        $brand_image->move($up_location,$img_name);
        unlink($old_image);
        
        Slider::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now(),
        ]);
        
            
        }else{
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => Carbon::now(),
            ]);
          

        }
        return Redirect()->back()->with('success','Brand Update Succesfully');
        

    }

}
