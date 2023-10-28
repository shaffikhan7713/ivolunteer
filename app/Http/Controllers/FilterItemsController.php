<?php

namespace App\Http\Controllers;
use App\Models\FilterItems;
use Illuminate\Http\Request;

class FilterItemsController extends Controller
{
    public function list(){
        $filterItemLists = FilterItems::orderBy('id', 'asc')->get();
        $data = compact('filterItemLists');
        return view('filterItem/list')->with($data);
    }

    public function edit(Request $request, int $id){
        $filterItemDet = FilterItems::where('id', $id)->first();
        $data = compact('filterItemDet');
        // dd($data);
        return view('filterItem/edit')->with($data);
    }

    public function updateFilterItem(Request $request){  
        $request->validate([
            'filterValue' => 'required',
        ]);
        
        $filterValue = $request->input('filterValue');
        
        if($filterValue) {
            $res = FilterItems::where('id', $request->input('id'))
                ->update(['filterValue' => $filterValue]);
            return redirect()->back()->with('success', 'Filter Item updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong! Please try again');
        }
    }
}