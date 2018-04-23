<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request as IlluminateRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ElqController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function contact(IlluminateRequest $request) {
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $emailAddress = $request->input('emailAddress');
        $title = $request->input('title');
        $company = $request->input('company');
        $contactUsMsg = $request->input('contactUsMsg');
        $areYouAgency = $request->input('areYouAgency');

        $authorizationValue = 'Basic VGVjaG5vbG9neVBhcnRuZXJTbWFydGVtcG9MTENcU2ViYXN0aWFuLk9zcGluYTpTbWFydGVtcG8xMjM=';
        $body = '{
          "fieldValues": [
            {
              "type": "FieldValue",
              "id": "174",
              "value": "'.$firstName.'"
            },
            {
              "type": "FieldValue",
              "id": "175",
              "value": "'.$lastName.'"
            },
            {
              "type": "FieldValue",
              "id": "176",
              "value": "'.$emailAddress.'"
            },
            {
              "type": "FieldValue",
              "id": "177",
              "value": "'.$title.'"
            },
            {
              "type": "FieldValue",
              "id": "178",
              "value": "'.$company.'"
            },
            {
              "type": "FieldValue",
              "id": "180",
              "value": "'.$areYouAgency.'"
            },
            {
              "type": "FieldValue",
              "id": "181",
              "value": "'.$contactUsMsg.'"
            }
          ]
        }';

        $client = new Client();
        $headers = ['Authorization' => $authorizationValue, 'Content-Type' => 'application/json'];

        $request = new Request('POST', 
                               'https://secure.p02.eloqua.com/api/rest/1.0/data/form/18', 
                               $headers, 
                               $body);

        $response = $client->send($request);

        return response()->json(['status'       => $response->getStatusCode(),
                                 'reasonPhrase' => $response->getReasonPhrase()], 
                                 $response->getStatusCode());
    }

}
