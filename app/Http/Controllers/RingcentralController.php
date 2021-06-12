<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RingcentralController extends Controller
{

    public function handleCallback() {
        if (isset($_REQUEST['webhookcallback'])){
            if (array_key_exists('HTTP_VALIDATION_TOKEN', $_SERVER)) {
                return header("Validation-Token: {$_SERVER['HTTP_VALIDATION_TOKEN']}");
            }else{
                $jsonStr = file_get_contents('php://input');
                Log::info($jsonStr);
                $jsonObj = json_decode($jsonStr, TRUE);
            }
        }
    }

    public function callout()
    {
        $DELIVERY_ADDRESS='https://93a978d9a4a8.ngrok.io/api/handleCallback?webhookcallback';

        $rcsdk = new \RingCentral\SDK\SDK(getenv("RINGCENTRAL_CLIENT_ID"), getenv("RINGCENTRAL_SECRET"), getenv("RINGCENTRAL_SERVER"));
        $platform = $rcsdk->platform();

        $platform->login(getenv("RINGCENTRAL_USERNAME"), getenv("RINGCENTRAL_EXTENSION"), getenv("RINGCENTRAL_PASSWORD"));
        $params = array(
                'eventFilters' => array(
                    '/restapi/v1.0/account/~/extension/~/message-store/instant?type=SMS',
                    '/restapi/v1.0/account/~/telephony/sessions',
                ),
                'deliveryMode' => array(
                    'transportType' => "WebHook",
                    'address' => $DELIVERY_ADDRESS
                ));
        try {
            $apiResponse = $platform->post('/subscription', $params);
            print_r ("Response: " . $apiResponse->text());
        }catch (\Exception $e){
            print_r ("Exception: " . $e->getMessage());
        }
    }
}
