<?php

namespace App\Http\Controllers;
use App\Models\HomeSliders;
use Illuminate\Http\Request;

class HomeSlidersController extends Controller
{
    public function list(){
        $homeSliderLists = HomeSliders::orderBy('id', 'asc')->get();
        $data = compact('homeSliderLists');
        return view('homeSlider/list')->with($data);
    }

    public function add(){
        return view('homeSlider/add');
    }

    public function edit(Request $request, int $id){
        $homeSliderDet = HomeSliders::where('id', $id)->first();
        $data = compact('homeSliderDet');
        return view('homeSlider/edit')->with($data);
    }

    public function addUpdateHomeSlider(Request $request){  
        $request->validate([
            'image' => 'required',
        ]);

        if($request->file()) {
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads/homesliderimages'), $imageName);

            if($request->input('id')) {
                $res = HomeSliders::where('id', $request->input('id'))
                ->update(['image' => $imageName]);
                return redirect()->back()->with('success', 'Home slider updated successfully!');
            } else {
                HomeSliders::create(array('image' => $imageName));
                return redirect()->back()->with('success', 'Home slider added successfully!');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong! Please try again');
        }
    }

    public function uploadVolunteerImage(Request $request){        
        $request->validate([
            'mainImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        // echo "<pre>"; print_r($_FILES); die;

        if($request->file()) {
            // $mainImage = $request->file('mainImage');
            $imageName = time().'.'.$request->mainImage->extension();  
            // dd($imageName, public_path('uploads'));
            $request->mainImage->move(public_path('uploads'), $imageName);
            $res = Volunteer::where('id', $request->input('volunteerId'))
                ->update(['mainImage' => $imageName]);
            return redirect()->back()->with('success', 'Image uploaded successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong! Please try again');
        }
    }
}