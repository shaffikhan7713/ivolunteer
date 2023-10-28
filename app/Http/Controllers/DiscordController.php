<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Volunteer;

class DiscordController extends Controller
{
    public function sharePost(Request $request)
    {
        $webhookUrl = env('DISCORD_URL'); // Replace with your Discord webhook URL

        $voulnteerId = \Session::get('vid');
        $volunteerDetails = Volunteer::where('id', $voulnteerId)->first();
        $volunteerDetails = $volunteerDetails->toArray();

        $content = '**'.$volunteerDetails['title'].'**';
        $content .= '```'.$volunteerDetails['shortDescription'].'```';
        $content .= url('product/'.$volunteerDetails['seoUri'].'/'.$volunteerDetails['id']);

        // $imagePath = url('uploads/'.$volunteerDetails['mainImage']);;

        $data = [
            'username'=> 'Acrozzi',
            'content' => $content,
        ];

        $client = new Client();
        $client->post($webhookUrl, [
            'json' => $data,
        ]);

        // return response()->json(['message' => 'Post shared on Discord']);
        return redirect()->back()->with('success', 'Post shared on Discord');
    }
}

?>