<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Auth;

class AboutController extends Controller
{
    //
    public function __construct(){
      $this->middleware('auth');
    }
    public function HomeAbout(){
    	$homeabouts = HomeAbout::latest()->get();
    	return view('admin.home.index', compact('homeabouts'));
    }
    public function AddAbout(){
    	return view('admin.home.create');
    }
    public function StoreAbout(Request $request){

      HomeAbout::insert([
        'title' => $request->title,
        'short_dis' => $request->short_description,
        'long_dis' => $request->long_description,
        'created_at' => Carbon::now()
        ]);
       
       return Redirect()->route('home.about')->with('success','Home About Inserted Successfull');
    }
    public function EditAbout($id){

    	$homeabout = HomeAbout::find($id);
    	return view('admin.home.edit', compact('homeabout'));
    }
    public function UpdateAbout(Request $request, $id){
    	 $update = HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_dis' => $request->short_description,
            'long_dis' => $request->long_description,
            
             
        ]);
    	  return Redirect()->route('home.about')->with('success','Home About Update Successfull');
    }
    public function DeleteAbout($id){
    	$delete = HomeAbout::find($id)->Delete();
    	return Redirect()->back()->with('success','About Deleted Successfully');
    }
    public function Portfolio(){
    $images = Multipic::all();
    return view('pages.portfolio',compact('images'));
    }
    public function Contact(){
    $images = Multipic::all();
    return view('pages.contact',compact('images'));
    }
}
