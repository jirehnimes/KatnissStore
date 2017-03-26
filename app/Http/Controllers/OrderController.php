<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Order;
use App\OrderProduct;
use App\Product;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $oRequest = $request->all();
        
        $iTotal = $this->computeTotal($oRequest);
        $sInvoice = date('Ymdhis').'-'.str_random(8);

        if ($oRequest['fare'] === 'paypal') {
            $aData['total'] = $iTotal;
            $aData['invoice'] = $sInvoice;

            $oPayPal = $this->doPayPal($aData);

            if (isset($oPayPal->name)) {
                if ($oPayPal->name === 'VALIDATION_ERROR') {
                    return redirect('/')->with('error', 'PayPal Message: '.$oPayPal->details[0]->issue);
                }
            }
        }

        $oOrder = new Order;
        $oOrder->user_id = Auth::user()->id;
        $oOrder->invoice_number = $sInvoice;
        $oOrder->fare_type = $oRequest['fare'];
        $oOrder->amount = $iTotal;
        $oOrder->shipping_address = $oRequest['shipAd'];
        $oOrder->message = $oRequest['msg'];

        // PayPal links
        if (isset($oPayPal)) {
            $oOrder->paypal_id = $oPayPal->id;
            $oOrder->paypal_info = $oPayPal->links[0]->href;
        }

        $oOrder->save();

        foreach ($oRequest['id'] as $iKey => $sValue) {
            $oOrderProd = new OrderProduct;
            $oOrderProd->order_id = $oOrder->id;
            $oOrderProd->product_id = $sValue;
            $oOrderProd->quantity = $oRequest['quantity'][$iKey];
            $oOrderProd->save();  
        }

        if (isset($oPayPal)) {
            header('LOCATION: '.$oPayPal->links[1]->href);
            exit();
        }
        return redirect('/')->with('ok', 'Checkout successful.');
    }

    public function payPayPal(Request $request)
    {
        $oRequest = $request->all();

        $sToken = $this->getPayPalToken();

        $sURL = 'https://api.sandbox.paypal.com/v1/payments/payment/'.$oRequest['paymentId'].'/execute';
        $aHeader = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$sToken
        ];
        $aParams['payer_id'] = $oRequest['PayerID'];

        $oCurl = curl_init();
        curl_setopt($oCurl, CURLOPT_URL, $sURL);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_HTTPHEADER, $aHeader);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, json_encode($aParams));
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, true);
        $oRes = curl_exec($oCurl);

        curl_close($oCurl);

        $oOrder = Order::where('paypal_id', $oRequest['paymentId'])->first();
        $oOrder->paid = 1;
        $oOrder->save();

        return redirect('/')->with('ok', 'Checkout with PayPal successful.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function computeTotal($oRequest)
    {
        $iTotal = 0.00;

        foreach ($oRequest['id'] as $iKey => $sValue) {
            $oProduct = Product::find($sValue);
            $iPrice = (float)$oProduct->price;
            $iTotal += $iPrice * $oRequest['quantity'][$iKey];
        }

        return round(($iTotal * 0.02), 2);
    }

    private function doPayPal($aData)
    {
        $sToken = $this->getPayPalToken();

        // Payment
        $sURL = 'https://api.sandbox.paypal.com/v1/payments/payment';
        $aHeader = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$sToken
        ];
        $aParams['intent'] = 'sale';
        $aParams['payer']['payment_method'] = 'paypal';
        $aParams['transactions'][0]['amount']['total'] = $aData['total'];
        $aParams['transactions'][0]['amount']['currency'] = 'USD';
        $aParams['transactions'][0]['invoice_number'] = $aData['invoice'];
        $aParams['note_to_payer'] = 'Contact us for any questions on your order.';
        $aParams['redirect_urls']['return_url'] = 'http://katniss.com.local/paypal/pay';
        $aParams['redirect_urls']['cancel_url'] = 'http://katniss.com.local';

        $oCurl = curl_init();
        curl_setopt($oCurl, CURLOPT_URL, $sURL);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_HTTPHEADER, $aHeader);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, json_encode($aParams));
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, true);
        $oRes = curl_exec($oCurl);

        curl_close($oCurl);

        return json_decode($oRes);
    }

    /**
     * Get PayPal Access Token
     * @return string Access token
     */
    private function getPayPalToken()
    {
        $sTokenURL = 'https://api.sandbox.paypal.com/v1/oauth2/token';
        $sClient = 'AZECvP8ho13KCHmB-xuYMA_Mvxxc01BCizA376dCTxdByUDYe8p1jCEKkYDNeTbzi2iLpwsbUWLifbyQ';
        $sSecret = 'EPT1KeLom0IfQwDT7wpLD3udY9ffGdQZKXjHcHX_qSE55pw51iDTLmEjCusu9dhnettyJpUd7wsaT7yH';
        $sToken = '';

        // Get Access Token
        $oTokenCurl = curl_init();
        curl_setopt($oTokenCurl, CURLOPT_URL, $sTokenURL);
        curl_setopt($oTokenCurl, CURLOPT_HEADER, false);
        curl_setopt($oTokenCurl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($oTokenCurl, CURLOPT_POST, true);
        curl_setopt($oTokenCurl, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($oTokenCurl, CURLOPT_USERPWD, $sClient.':'.$sSecret);
        curl_setopt($oTokenCurl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        $oTokenRes = curl_exec($oTokenCurl);

        if(empty($oTokenRes))die("Error: No response.");
        else {
            $json = json_decode($oTokenRes);
            $sToken = $json->access_token;
        }

        curl_close($oTokenCurl);

        return $sToken;
    }
}
