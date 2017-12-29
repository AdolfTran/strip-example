<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Overtrue\Wechat\Payment;
use Overtrue\Wechat\Payment\Order;
use Overtrue\Wechat\Payment\Business;
use Overtrue\Wechat\Payment\UnifiedOrder;
use Overtrue\Wechat\QRCode;
class WechatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function wechat($product_id)
    {
        $product = Product::where('id', $product_id)->first();
        $qr = new QRCode('wx426b3015555a46be','01c6d59a3f9024db6336662ac95c8e74');

        $business = new Business(
            'wx426b3015555a46be',
            'e10adc3949ba59abbe56e057f20f883e',
            '1225312702',
            '01c6d59a3f9024db6336662ac95c8e74'
        );


        $order = new Order();
        $order->body = 'test body';
        $order->out_trade_no = md5(uniqid().microtime());
        $order->total_fee = $product->price; // 单位为 “分”, 字符串类型
        $order->openid = 'o6_bmjrPTlm6_2sgVt7hMZOPfL2M';
        $order->notify_url = 'http://wechat-example.site/wechat/payment/notify';

        $unifiedOrder = new UnifiedOrder($business, $order);


        $payment = new Payment($unifiedOrder);
        return view('wpay',$payment)->with('price', $product->price);
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
        //
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
}
