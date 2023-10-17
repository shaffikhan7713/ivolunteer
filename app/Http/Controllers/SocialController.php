<?php

namespace App\Http\Controllers;
use App\Models\Volunteer;
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
            // 'email',
            'pages_manage_posts',
            'pages_read_engagement',
            // 'publish_to_groups'
        ];

        $redirectUri = 'https://ivol.cintaxsolutions.com/fb/callback';

        $redirectURL = $helper->getLoginUrl($redirectUri, $permissions);
        // $redirectURL = $redirectURL.'&vid='.$vid;
        // $redirectURL = $redirectURL.'&config_id=865718911816544';

        return redirect($redirectURL);
    }

    public function handleProviderCallback()
    {
        if (request('error') == 'access_denied') {
            dd('Something went wroing in accessing fb access token');
        }
        
        $voulnteerId = \Session::get('vid');
        $volunteerDetails = Volunteer::where('id', $voulnteerId)->first();
        $volunteerDetails = $volunteerDetails->toArray();
            

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

        $response  = $this->facebook->get('/me?fields=id,name', $finalAccessToken);
        $user = $response->getGraphUser();
        $id = $user->getId();
        
        //get fb pages
        $fbPagesArray = $this->facebook->get($id.'/accounts', $finalAccessToken);
        $fbPagesArray = $fbPagesArray->getGraphEdge()->asArray();
        if(count($fbPagesArray) > 0) {
            $pageId = $fbPagesArray[0]['id'];
            $pageToken = $fbPagesArray[0]['access_token'];
            // $data = ['message' => 'Test content'];
            $content = $volunteerDetails['title'];
            $volunteerLink = $volunteerDetails['link'];
            $imagePath = url('uploads/'.$volunteerDetails['mainImage']);
            $volunteerImage = array($imagePath);
            try {
                $result = $this->sharePost($pageId, $pageToken, $content, $volunteerImage, $volunteerLink);
                
                $postPath = url('product/'.$volunteerDetails['seoUri'].'/'.$volunteerDetails['id']);
                return redirect($postPath)->with('success', 'Post shared successfully!');
                
                /* $response = $this->facebook->post(
                    "$pageId/feed",
                    $data,
                    $pageToken
                );
                echo "<pre>responseresponse";print_r($response);
                return $response->getGraphNode(); */
    
            } catch (FacebookResponseException $e) {
                throw new Exception($e->getMessage(), $e->getCode());
            } catch (FacebookSDKException $e) {
                throw new Exception($e->getMessage(), $e->getCode());
            }
        } else {
            throw new Exception('No pages found');
        }

        
    }

    public function sharePost($accountId, $accessToken, $content, $images = [], $volunteerLink)
    {
        $data = ['message' => $content, 'link' => $volunteerLink];
    
        if(count($images) > 0){
            $attachments = $this->uploadImages($accountId, $accessToken, $images);
        
            foreach ($attachments as $i => $attachment) {
                $data["attached_media[$i]"] = "{\"media_fbid\":\"$attachment\"}";
            }
        }
    
        try {
            return $this->postData($accessToken, "$accountId/feed", $data);
        } catch (\Exception $exception) {
              //notify user about error
              return false;
        }
    }
    
    private function uploadImages($accountId, $accessToken, $images = [])
    {
        $attachments = [];
    
        foreach ($images as $image) {
            if (!file_exists($image)) continue;
    
            $data = [
                'source' => $this->facebook->fileToUpload($image),
            ];
    
            try {
                $response = $this->postData($accessToken, "$accountId/photos?published=false", $data);
                if ($response) $attachments[] = $response['id'];
            } catch (\Exception $exception) {
                throw new Exception("Error while posting: {$exception->getMessage()}", $exception->getCode());
            }
        }
    
        return $attachments;
    }
    
    private function postData($accessToken, $endpoint, $data)
    {
        try {
            $response = $this->facebook->post(
                $endpoint,
                $data,
                $accessToken
            );
            return $response->getGraphNode();
    
        } catch (FacebookResponseException $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        } catch (FacebookSDKException $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }   
}