<?php

namespace App\Http\Controllers;
use App\Models\PeoplesReview;
use Illuminate\Http\Request;

class PeoplesReviewController extends Controller
{
    public function list(){
        $pReview = PeoplesReview::orderBy('id', 'asc')->get();
        $data = compact('pReview');
        return view('peoplesReview/list')->with($data);
    }

    public function add(){
        return view('peoplesReview/add');
    }

    public function edit(Request $request, int $id){
        $pReview = PeoplesReview::where('id', $id)->first();
        $data = compact('pReview');
        return view('peoplesReview/edit')->with($data);
    }

    public function addUpdate(Request $request){  
        if($request->input('id')) {
            $res = PeoplesReview::where('id', $request->input('id'))
            ->update(['name' => $request->name, 'place' => $request->place, 'description' => $request->description]);
            return redirect()->back()->with('success', 'Peoples Review updated successfully!');
        } else {
            PeoplesReview::create(array('name' => $request->name, 'place' => $request->place, 'description' => $request->description));
            return redirect()->back()->with('success', 'Peoples Review added successfully!');
        }       
    }
}