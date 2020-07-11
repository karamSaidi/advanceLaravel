<?php

namespace App\Http\Controllers\Advance;
use App\Model\Offer;
use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{

    private $view = 'advance.offers.';
    private $disk = 'offers';

    public function index()
    {
        $offers = Offer::get();
        return view($this->view . 'index', compact('offers'));

    }// end of index


    public function create()
    {
        return view($this->view . 'create');
    }// end of create


    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required|min:3|string',
            'price'         => 'required|numeric',
            'photo'         => 'required|file|image',
        ]);

        try{
                $data = $request->except('photo');
            $photo = '';
            if($request->has('photo')){
                $photo = $request->photo->store('/', $this->disk);
            }
            $data['photo'] = $photo;
            // return $photo;
            Offer::create($data);
            return redirect()->route('offer.create')->with('success', 'product added success');
        }
        catch(\Exception $ex){
            return redirect()->route('offer.create')->with('error', 'fail to add .. try again later....!');
        }

    }// end of store


    public function details($id)
    {
        try{
            $offer = Offer::find($id);
            // return $offer->orders;

            if(request()->has('id') && request()->has('resourcePath')){
                $payment_status =  $this->checkPaymentStatus(request('id'));
                if(isset($payment_status['id'])){
                    Order::create([
                        'offer_id'              => $offer->id,
                        'transaction_id'        => $payment_status['id'],
                        'transaction_info'      => json_encode($payment_status),
                        ]);
                    return view($this->view  . 'details')->with('offer', $offer)->with('success', 'Payment Success');
                }
                return view($this->view  . 'details', compact('offer'))->with('error', 'Payment fail');
            }


            if(! $offer){
                return redirect()->route('offers')->with('error', 'Nodata found');
            }
            return view($this->view  . 'details', compact('offer'));
        }
        catch(\Exception $ex){
            // return $ex;
            return redirect()->route('offers')->with('error', 'there are an problem.. try later or call your support');
        }
    }// end of show


    public function checkPaymentStatus($payment_id)
    {
        $url = "https://test.oppwa.com/v1/checkouts/$payment_id/payment";
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return collect(json_decode($responseData, true));
    }// end checkPaymentStatus


    public function orders($offer_id)
    {
        try{
            $offer = Offer::find($offer_id);
            $orders = $offer->orders;
            return view($this->view . 'orders.index', compact('orders'));
        }
        catch(\Exception $ex)
        {
            // return $ex;
            return redirect()->route('offers')->with('error', 'there are an problem.. try later or call your support');
        }
    }


}
