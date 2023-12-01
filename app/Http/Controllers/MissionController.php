<?php

namespace App\Http\Controllers;
use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function list(){
        $mission = Mission::orderBy('id', 'asc')->get();
        $data = compact('mission');
        return view('mission/list')->with($data);
    }

    public function add(){
        return view('homeSlider/add');
    }

    public function edit(Request $request, int $id){
        $missionDet = Mission::where('id', $id)->first();
        $data = compact('missionDet');
        return view('mission/edit')->with($data);
    }

    public function addUpdateMission(Request $request){  
        $request->validate([
            'image' => 'required',
        ]);

        if($request->file()) {
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads/mission'), $imageName);

            if($request->input('id')) {
                $res = Mission::where('id', $request->input('id'))
                ->update(['image' => $imageName]);
                return redirect()->back()->with('success', 'Mission updated successfully!');
            } else {
                Mission::create(array('image' => $imageName));
                return redirect()->back()->with('success', 'Mission added successfully!');
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