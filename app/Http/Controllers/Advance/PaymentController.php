<?php

namespace App\Http\Controllers\Advance;

use App\Model\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function prepareCheckOut(Request $request)
    {
        $price = $request->has('price')? $request->price : 'a';
        if($request->has('offer_id')){
            $offer_id = 0;
            $offer_id = $request->offer_id;
            try{
                $offer = Offer::find($offer_id);
                if(! $offer)
                    return response()->json(['status' => false, 'msg' => 'this product not found']);
            }
            catch(\Exception $ex){

            }
        }

        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=$price" .
                    "&currency=EUR" .
                    "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return response()->json(['status' => false, 'msg' => 'nvalid check out']);
        }
        curl_close($ch);
        $responseData = collect(json_decode($responseData, true));
        if(! $responseData->has('id'))
            return response()->json(['status' => false, 'msg' => 'invalid check out']);

        $view = view('ajax.form')
            ->with(['type' => 'paymentCheckOut',
                'responseData' => $responseData,
                'offer_id' => $offer_id
                ])
            ->renderSections();

        return response()->json(["status" => true,   'content' => $view['paymentForm'] ]);
    }// end prepareCheckOut


}// end controller
