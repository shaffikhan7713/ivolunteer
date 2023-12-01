<?php

namespace App\Http\Controllers;
use App\Models\Founders;
use Illuminate\Http\Request;

class FoundersController extends Controller
{
    public function list(){
        $founders = Founders::orderBy('id', 'asc')->get();
        $data = compact('founders');
        return view('founder/list')->with($data);
    }

    public function add(){
        return view('founder/add');
    }

    public function edit(Request $request, int $id){
        $founderDet = Founders::where('id', $id)->first();
        $data = compact('founderDet');
        return view('founder/edit')->with($data);
    }

    public function addUpdateFounder(Request $request){  
        $request->validate([
            'name' => 'required',
        ]);

        if($request->file()) {
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads/founder'), $imageName);      
            
            if($request->input('id')) {
                $res = Founders::where('id', $request->input('id'))
                ->update(['image' => $imageName, 'name' => $request->name, 'bio' => $request->bio, 'role' => $request->role]);
                return redirect()->back()->with('success', 'Founder updated successfully!');
            } else {
                Founders::create(array('image' => $imageName, 'name' => $request->name, 'bio' => $request->bio, 'role' => $request->role));
                return redirect()->back()->with('success', 'Founder added successfully!');
            }
        } else {
            if($request->input('id')) {
                $res = Founders::where('id', $request->input('id'))
                ->update(['name' => $request->name, 'bio' => $request->bio, 'role' => $request->role]);
                return redirect()->back()->with('success', 'Founder updated successfully!');
            } else {
                Founders::create(array('name' => $request->name, 'bio' => $request->bio, 'role' => $request->role));
                return redirect()->back()->with('success', 'Founder added successfully!');
            }
        } 
    }
}