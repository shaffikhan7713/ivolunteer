<?php

namespace App\Http\Controllers;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function list(){
        $contacts = ContactUs::orderBy('id', 'desc')->get();
        $data = compact('contacts');
        return view('contact/list')->with($data);
    }

    public function add(){
        return view('contact/add');
    }

    public function edit(Request $request, int $id){
        $contactDet = ContactUs::where('id', $id)->first();
        $data = compact('contactDet');
        return view('contact/edit')->with($data);
    }

    public function addUpdateContact(Request $request){  
        $request->validate([
            'name' => 'required',
        ]);

        if($request->file()) {
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads/contact'), $imageName);      
            
            if($request->input('id')) {
                $res = ContactUs::where('id', $request->input('id'))
                ->update(['image' => $imageName, 'name' => $request->name, 'bio' => $request->bio, 'role' => $request->role]);
                return redirect()->back()->with('success', 'contact updated successfully!');
            } else {
                ContactUs::create(array('image' => $imageName, 'name' => $request->name, 'bio' => $request->bio, 'role' => $request->role));
                return redirect()->back()->with('success', 'contact added successfully!');
            }
        } else {
            if($request->input('id')) {
                $res = ContactUs::where('id', $request->input('id'))
                ->update(['name' => $request->name, 'bio' => $request->bio, 'role' => $request->role]);
                return redirect()->back()->with('success', 'contact updated successfully!');
            } else {
                ContactUs::create(array('name' => $request->name, 'bio' => $request->bio, 'role' => $request->role));
                return redirect()->back()->with('success', 'contact added successfully!');
            }
        } 
    }
}