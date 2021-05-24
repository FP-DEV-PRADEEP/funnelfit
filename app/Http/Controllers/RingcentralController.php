<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RingcentralController extends Controller
{
    public function callout()
    {
    $rcsdk = new \RingCentral\SDK\SDK(getenv("RINGCENTRAL_CLIENT_ID"), getenv("RINGCENTRAL_SECRET"), getenv("RINGCENTRAL_DEV_URL"));

	$platform = $rcsdk->platform();

 	//$platform->login(getenv("RINGCENTRAL_DEV_NUMBER"), '101', getenv("RINGCENTRAL_DEV_PASSWORD"));
 }
}
