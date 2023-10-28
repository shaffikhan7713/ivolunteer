<?php

namespace App\Http\Controllers;

use App\Imports\VolunteersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Volunteer;
use App\Models\Ratings;
use App\Models\FilterItems;
use Illuminate\Http\Request;
use Instagram\FacebookLogin\FacebookLogin;
use Instagram\AccessToken\AccessToken;
use Instagram\User\User;
use App\Models\HomeSliders;
// Use DB;

class HomeController extends Controller
{
    public function index(Request $request){
        // DB::enableQueryLog();
        $search = $request['search'] ?? '';
        $where = "";
        $getArray = array();

        if($request['location'] && $request['location'] !== '' && $where === ''){
            $where = $where."location = '".$request['location']."'";
            array_push($getArray, $request['location']);
        }

        if($request['age'] && $request['age'] !== ''){
            $where = ($where === '') ? $where."age = '".$request['age']."'" : $where." AND age = '".$request['age']."'";
            array_push($getArray, $request['age']);
        }

        if($request['forWho'] && $request['forWho'] !== ''){
            $where = ($where === '') ? $where."forWho = '".$request['forWho']."'" : $where." AND forWho = '".$request['forWho']."'";
            array_push($getArray, $request['forWho']);
        }

        if($request['timeCommitment'] && $request['timeCommitment'] !== ''){
            $where = ($where === '') ? $where."timeCommitment = '".$request['timeCommitment']."'" : $where." AND timeCommitment = '".$request['timeCommitment']."'";
            array_push($getArray, $request['timeCommitment']);
        }

        if($request['collegeApplication'] && $request['collegeApplication'] !== ''){
            $where = ($where === '') ? $where."collegeApplication = '".$request['collegeApplication']."'" : $where." AND collegeApplication = '".$request['collegeApplication']."'";
            array_push($getArray, $request['collegeApplication']);
        }

        if($request['review'] && $request['review'] !== ''){
            $where = ($where === '') ? $where."review = '".$request['review']."'" : $where." AND review = '".$request['review']."'";
            array_push($getArray, $request['review']);
        }

        // dd($where);

        if($search || $where){
            // dd($request->all());
            if($search && $where){
                $volunteerLists = Volunteer::where('title', 'like', '%'.$search.'%')
                ->orWhere('summary', 'like', $search)
                ->orWhere('shortDescription', 'like', $search)
                ->orWhere('email', 'like', $search)
                ->orWhere('criteria', 'like', $search)
                ->orWhere('whereLocation', 'like', $search)
                ->orWhere('dateAndTime', 'like', $search)
                ->orWhere('timeCommitment', 'like', $search)
                ->orWhere('whatVolunteerDoes', 'like', $search)
                ->orWhere('link', 'like', $search)
                ->whereRaw($where)
                ->orderBy('id', 'asc')
                ->paginate(8);
            }

            if($search && !$where){
                $volunteerLists = Volunteer::where('title', 'like', '%'.$search.'%')
                ->orWhere('summary', 'like', $search)
                ->orWhere('shortDescription', 'like', $search)
                ->orWhere('email', 'like', $search)
                ->orWhere('criteria', 'like', $search)
                ->orWhere('whereLocation', 'like', $search)
                ->orWhere('dateAndTime', 'like', $search)
                ->orWhere('timeCommitment', 'like', $search)
                ->orWhere('whatVolunteerDoes', 'like', $search)
                ->orWhere('link', 'like', $search)                
                ->orderBy('id', 'asc')
                ->paginate(8);
            }

            if($where && !$search){
                $volunteerLists = Volunteer::whereRaw($where)                
                ->orderBy('id', 'asc')
                ->paginate(8);
                // ->toSql();
                // dd($volunteerLists);
            }            
        } else {
            $volunteerLists = Volunteer::orderBy('id', 'asc')->paginate(8);
        }        

        $filterItems = FilterItems::all();
        foreach($filterItems as $k=>$filterItem){
            $filterStrToArray = explode(',', $filterItem->filterValue);
            $filterItems[$k]['filterValueArray'] = $filterStrToArray;
        }
        // dd($filterItems->toArray());
        // $volunteerLists = $volunteerLists->toArray();
        $homeSliderList = HomeSliders::all();
        $data = compact('volunteerLists', 'search', 'filterItems', 'getArray', 'homeSliderList');
        // dd($data['volunteerLists']);
        return view('home')->with($data);
    }

    public function uploadExcel(){
        return view('uploadExcel');
    }

    public function importExcel(Request $request){
        
        $request->validate([
            'uploadExcel' => 'required|mimes:csv,xlsx,xls'
        ]);

        // echo "<pre>"; print_r($_FILES); die;

        if($request->file()) {
            $myfile = $request->file('uploadExcel');
            Excel::import(new VolunteersImport, $myfile);
            return redirect('/upload-excel')->with('success', 'All good!');
        } else {
            return redirect('/upload-excel')->with('error', 'Invalid file extension');
        }
    }

    public function details(Request $request, string $title, int $id) {
        if($id > 0) {
            \Session::put('vid', $id);
            $volunteerDetails = Volunteer::where('id', $id)->first();
            // dd($volunteerDetails->toArray());
            $volunteerDetails = $volunteerDetails->toArray();

            //Instagram
            $config = array( // instantiation config params
                'app_id' => env('APP_ID'), // facebook app id
                'app_secret' => env('APP_SECRET'), // facebook app secret
                'default_graph_version' => 'v2.10',
            );
            
            // uri facebook will send the user to after they login
            $redirectUri = 'http://localhost:8000/sandbox/igtest';
            
            $permissions = array( // permissions to request from the user
                'email',
                // 'instagram_content_publish', 
                // 'instagram_graph_user_profile', 
                // 'instagram_manage_comments',
                // 'pages_show_list', 
                // 'ads_management', 
                // 'business_management', 
                // 'pages_read_engagement'
            );
            
            // instantiate new facebook login
            $facebookLogin = new FacebookLogin( $config );

            $link = '<a href="' . $facebookLogin->getLoginDialogUrl( $redirectUri, $permissions ) . '">' .
            'Log in with Facebook' .
        '</a>';

            // $data = array(
            //     'volunteerDetails' => $volunteerDetails,
            //     'facebookLogin' => $facebookLogin,
            //     'redirectUri' => $redirectUri,
            //     'permissions' => $permissions,
            //     'link' => $link,
            // );

            $count = Ratings::where('volunteerId', '=', $id)->where('status', '=', 1)->count();
            $avgStars = Ratings::where('volunteerId', '=', $id)->where('status', '=', 1)->avg('starRating');
            $avgStars = intval(round($avgStars));

            $ratings = Ratings::where('volunteerId', '=', $id)->where('status', '=', 1)->get();
            
            $data = compact('volunteerDetails', 'facebookLogin', 'redirectUri', 'permissions', 'link', 'count', 'avgStars', 'ratings');
            return view('volunteerDetails')->with($data);
        } else {
            return redirect('/');
        }
    }

    public function fbRedirect(Request $request) {
        // dd($request->toArray());

        if ($request->code != '') {
            //Instagram
            $config = array( // instantiation config params
                'app_id' => env('APP_ID'), // facebook app id
                'app_secret' => env('APP_SECRET'), // facebook app secret
                'default_graph_version' => 'v2.10',
            );

            $redirectUri = 'http://localhost:8000/sandbox/igtest';

            $accessToken = new AccessToken( $config );

            // exchange our code for an access token
            $newToken = $accessToken->getAccessTokenFromCode( $request->code, $redirectUri );
            echo "newTokenindise<pre>"; print_r($newToken);
            if ( !$accessToken->isLongLived() ) { // check if our access token is short lived (expires in hours)
                // exchange the short lived token for a long lived token which last about 60 days
                $newToken = $accessToken->getLongLivedAccessToken( $newToken['access_token'] );
                echo "newTokenindise<pre>"; print_r($newToken);
            }

            $config = array( // instantiation config params
                'access_token' => $newToken['access_token'],
            );
            
            // instantiate and get the users info
            $user = new User( $config );
            
            // get the users pages
            $pages = $user->getUserPages();
            dd($pages);
        } else {
            return redirect()->back()->with('error', 'Something went wrong, Please refresh and try again');
        }
    }

    public function postRating(Request $request){
        
        $inputRating = $request->input('inputRating');
        $comments = $request->input('comments');

        if($inputRating) {
            Ratings::create(array('starRating' => $inputRating, 'comments' => $comments, 'volunteerId' => $request->input('volunteerId')));
            return redirect()->back()->with('success', 'Ratings submitted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong, Please refresh and try again');
        }
    }

    public function aboutUs(){
        return view('aboutUs');
    }

    public function contactUs(){
        return view('contactUs');
    }
    
    public function fetchData(Request $request) {
        if($request->ajax())
        {
            $search = $request['search'] ?? '';
            $where = "";
            $getArray = array();

            if($request['location'] && $request['location'] !== '' && $where === ''){
                $where = $where."location = '".$request['location']."'";
                array_push($getArray, $request['location']);
            }

            if($request['age'] && $request['age'] !== ''){
                $where = ($where === '') ? $where."age = '".$request['age']."'" : $where." AND age = '".$request['age']."'";
                array_push($getArray, $request['age']);
            }

            if($request['forWho'] && $request['forWho'] !== ''){
                $where = ($where === '') ? $where."forWho = '".$request['forWho']."'" : $where." AND forWho = '".$request['forWho']."'";
                array_push($getArray, $request['forWho']);
            }

            if($request['timeCommitment'] && $request['timeCommitment'] !== ''){
                $where = ($where === '') ? $where."timeCommitment = '".$request['timeCommitment']."'" : $where." AND timeCommitment = '".$request['timeCommitment']."'";
                array_push($getArray, $request['timeCommitment']);
            }

            if($request['collegeApplication'] && $request['collegeApplication'] !== ''){
                $where = ($where === '') ? $where."collegeApplication = '".$request['collegeApplication']."'" : $where." AND collegeApplication = '".$request['collegeApplication']."'";
                array_push($getArray, $request['collegeApplication']);
            }

            if($request['review'] && $request['review'] !== ''){
                $where = ($where === '') ? $where."review = '".$request['review']."'" : $where." AND review = '".$request['review']."'";
                array_push($getArray, $request['review']);
            }

            if($search || $where){
                if($search && $where){
                    $volunteerLists = Volunteer::where('title', 'like', '%'.$search.'%')
                    ->orWhere('summary', 'like', $search)
                    ->orWhere('shortDescription', 'like', $search)
                    ->orWhere('email', 'like', $search)
                    ->orWhere('criteria', 'like', $search)
                    ->orWhere('whereLocation', 'like', $search)
                    ->orWhere('dateAndTime', 'like', $search)
                    ->orWhere('timeCommitment', 'like', $search)
                    ->orWhere('whatVolunteerDoes', 'like', $search)
                    ->orWhere('link', 'like', $search)
                    ->whereRaw($where)
                    ->orderBy('id', 'asc')
                    ->paginate(8);
                }

                if($search && !$where){
                    $volunteerLists = Volunteer::where('title', 'like', '%'.$search.'%')
                    ->orWhere('summary', 'like', $search)
                    ->orWhere('shortDescription', 'like', $search)
                    ->orWhere('email', 'like', $search)
                    ->orWhere('criteria', 'like', $search)
                    ->orWhere('whereLocation', 'like', $search)
                    ->orWhere('dateAndTime', 'like', $search)
                    ->orWhere('timeCommitment', 'like', $search)
                    ->orWhere('whatVolunteerDoes', 'like', $search)
                    ->orWhere('link', 'like', $search)                
                    ->orderBy('id', 'asc')
                    ->paginate(8);
                }

                if($where && !$search){
                    $volunteerLists = Volunteer::whereRaw($where)               
                    ->orderBy('id', 'asc')
                    ->paginate(8);
                }            
            } else {
                $volunteerLists = Volunteer::orderBy('id', 'asc')->paginate(8);
            }  
            return view('load', ['volunteerLists' => $volunteerLists])->render();
        }
    }
}