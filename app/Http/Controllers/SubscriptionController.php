<?php

namespace App\Http\Controllers;
use App\Models\Subscriptions;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function list(){
        $subscriptions = Subscriptions::orderBy('id', 'asc')->get();
        $data = compact('subscriptions');
        return view('subscription/list')->with($data);
    }

    public function add(){
        return view('subscription/add');
    }

    public function edit(Request $request, int $id){
        $subscriptionDet = Subscriptions::where('id', $id)->first();
        $data = compact('subscriptionDet');
        return view('subscription/edit')->with($data);
    }

    public function addUpdateSubscription(Request $request){  
        $request->validate([
            'image' => 'required',
        ]);

        if($request->file()) {
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads/subscriptionimages'), $imageName);

            if($request->input('id')) {
                $res = Subscriptions::where('id', $request->input('id'))
                ->update(['image' => $imageName]);
                return redirect()->back()->with('success', 'Home slider updated successfully!');
            } else {
                Subscriptions::create(array('image' => $imageName));
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