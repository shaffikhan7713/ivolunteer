<?php

namespace App\Http\Controllers;
use App\Models\Volunteer;

use Illuminate\Http\Request;

class VolunteersController extends Controller
{
    public function list(){
        $volunteerLists = Volunteer::orderBy('id', 'asc')->get();
        $data = compact('volunteerLists');
        return view('volunteer/list')->with($data);
    }

    public function edit(Request $request, int $id){
        $volunteerDet = Volunteer::where('id', $id)->first();
        $data = compact('volunteerDet');
        // dd($data);
        return view('volunteer/edit')->with($data);
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