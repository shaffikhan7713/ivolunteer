<?php

namespace App\Http\Controllers;
use Facebook\Facebook;
use Illuminate\Session\Store;

class SocialController extends Controller
{
    protected $facebook;

    public function __construct()
    {
        $this->facebook = new Facebook([
            'app_id' => env('APP_ID'),
            'app_secret' => env('APP_SECRET'),
            'default_graph_version' => 'v11.0'
        ]);
    }

    public function redirectToProvider()
    {
        // return redirect($this->facebook->redirectTo());
        $helper = $this->facebook->getRedirectLoginHelper();

        $permissions = [
            'email',
            // 'pages_manage_posts',
            // 'pages_read_engagement'
        ];

        $redirectUri = 'http://localhost:8000/fb/callback';

        $redirectURL = $helper->getLoginUrl($redirectUri, $permissions);

        return redirect($redirectURL);
    }

    public function handleProviderCallback()
    {
        if (request('error') == 'access_denied') {
            dd('Something went wroing in accessing fb access token');
        }
            

        // $accessToken = $this->facebook->handleCallback(); 

        $helper = $this->facebook->getRedirectLoginHelper();

        if (request('state')) {
            $helper->getPersistentDataHandler()->set('state', request('state'));
        }

        try {
            $accessToken = $helper->getAccessToken();
        } catch(FacebookResponseException $e) {
            throw new Exception("Graph returned an error: {$e->getMessage()}");
        } catch(FacebookSDKException $e) {
            throw new Exception("Facebook SDK returned an error: {$e->getMessage()}");
        }
    
        if (!isset($accessToken)) {
            throw new Exception('Access token error');
        }
    
        if (!$accessToken->isLongLived()) {
            try {
                $oAuth2Client = $this->facebook->getOAuth2Client();
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (FacebookSDKException $e) {
                throw new Exception("Error getting a long-lived access token: {$e->getMessage()}");
            }
        }
    
        $finalAccessToken =  $accessToken->getValue();

        \Session::put('fbAccessToken', $finalAccessToken);

        $response  = $this->facebook->get('/me?fields=id,name', $finalAccessToken);
        $user = $response->getGraphUser();
        $id = $user->getId();

        $data = ['message' => 'Test content'];

        try {
            $response = $this->facebook->post(
                "$id/feed",
                $data,
                $finalAccessToken
            );
            return $response->getGraphNode();

        } catch (FacebookResponseException $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        } catch (FacebookSDKException $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getPages()
    {
        dd(\Session::get('fbAccessToken'));
        $accessToken = \Session::get('fbAccessToken');
        $pages = $this->facebook->get('/me/accounts', $accessToken);
        $pages = $pages->getGraphEdge()->asArray();

        return array_map(function ($item) {
            return [
                'access_token' => $item['access_token'],
                'id' => $item['id'],
                'name' => $item['name'],
                'image' => "https://graph.facebook.com/{$item['id']}/picture?type=large"
            ];
        }, $pages);
    }
}