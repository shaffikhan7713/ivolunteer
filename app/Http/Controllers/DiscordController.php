<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DiscordController extends Controller
{
    public function sharePost(Request $request)
    {
        $webhookUrl = env('DISCORD_URL'); // Replace with your Discord webhook URL

        $content = $request->input('content'); // The content of the post you want to share

        $data = [
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