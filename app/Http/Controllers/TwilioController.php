<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

use App\Models\User;

class TwilioController extends Controller
{
    public function sendsms()
    {
/*    	$recipients = '18173004076';
        $account_sid = getenv("TWILIO_SID");
    $auth_token = getenv("TWILIO_AUTH_TOKEN");
    $twilio_number = getenv("TWILIO_NUMBER");
    $client = new Client($account_sid, $auth_token);
    $client->messages->create($recipients, 
            ['from' => $twilio_number, 'body' => 'this is a test'] );


    // Find your Account SID and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure
$sid = getenv("TWILIO_SID");
$token = getenv("TWILIO_AUTH_TOKEN");
$twilio = new Client($sid, $token);

$conversation = $twilio->conversations->v1->conversations
                                          ->create([
                                                       "friendlyName" => "My First Conversation"
                                                   ]
                                          );


 $conversation = $twilio->conversations->v1->conversations($conversation->sid)
                                          ->fetch();

print($conversation->chatServiceSid);

$participant = $twilio->conversations->v1->conversations($conversation->sid)
                                         ->participants
                                         ->create([
                                                      "messagingBindingAddress" => "+18173004076",
                                                      "messagingBindingProxyAddress" => "+17175101807"
                                                  ]
                                         );

print($participant->sid); */

//getenv("RINGCENTRAL_DEV_PASSWORD"):

$rcsdk = new \RingCentral\SDK\SDK(getenv("RINGCENTRAL_CLIENT_ID"), getenv("RINGCENTRAL_SECRET"), getenv("RINGCENTRAL_DEV_URL"));

dd($platform = $rcsdk->platform());

 $platform->login(getenv("RINGCENTRAL_DEV_NUMBER"), '101', getenv("RINGCENTRAL_DEV_PASSWORD"));

/* $resp = $platform->post('/account/~/extension/~/ring-out',
    array(
      'from' => array('phoneNumber' => getenv("RINGCENTRAL_DEV_NUMBER")),
      'to' => array('phoneNumber' => getenv("RINGCENTRAL_TESTNUMBER")),
      'playPrompt' => false
    ));

print_r ("Call placed. Call status: " . $resp->json()->status->callStatus); */




    }
}
