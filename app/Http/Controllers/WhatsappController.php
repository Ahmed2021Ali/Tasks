<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
class WhatsappController extends Controller
{
    public function index()
    {
        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');

        $twilioWhatsAppNumber = env('TWILIO_WHATSAPP_NUMBER');

        $recipientNumber = 'whatsapp:+201141752767';
        $message = "Hello from Programming Experience";

        $twilio = new Client($twilioSid, $twilioToken);

        try
        {
            $twilio->messages->create(
                $recipientNumber,
                [
                    "from" => 'whatsapp:'.$twilioWhatsAppNumber,
                    "body" => $message,
                ]
            );
            return response()->json(['message' => 'WhatsApp message sent successfully']);
        }
        catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function whatsapp()
    {
        $phone='201017786080';
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://graph.facebook.com/v17.0/147957821742045/messages',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "messaging_product": "whatsapp",
            "to": '. $phone.',
            "type": "template",
            "template": {
                "name": "hello_world",
                "language": {
                    "code": "en_US"
                }
            }
        }',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer EAALZBoTcUkUQBOwHQGJLn1EUjedgZCXfq8gt7VHb2SsYa3Otl6IYquVFURuZCnVeRqG3M7tIONGWRVdxFswsRYiBJ6euq6NZAPnFRMtdgEThd2aE5MDuOXOG5j0N7lp79YQuWSpDjHY8AWZBOGVWCPRuehpnIw87h7WXHjbUh7gPOz6RM6P81WhH4FZA4hdZCKBJZBg0DtwOkFYVyAac9U5T4y95zqeuvxotFq8ZD',
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        echo $response;
    }

}
