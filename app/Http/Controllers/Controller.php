<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

abstract class Controller
{
    //
    public function notify_frontend($data) {
        // Send a notification to the Socket.IO server
        $client = new Client();
        $socketServerUrl = 'https://pod-laravel.cypherdemo.co.uk:3000/send-notification';

        try {
            $client->post($socketServerUrl, [
                'json' => [
                    'message' => 'New data saved!',
                    'data' => $data // Send any data you want to broadcast
                ]
            ]);
        } catch (\Exception $e) {
            // Log errors if the request fails
            \Log::error("Failed to send notification to Socket.IO server: " . $e->getMessage());
        }
    }
}

