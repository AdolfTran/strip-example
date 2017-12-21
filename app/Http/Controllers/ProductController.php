<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Show the index page.
     *
     * @var App\Product $products
     * @return Illuminate\View\View
     */
    public function index()
    {
        $products = \App\Product::all();
        return view('index', compact('products'));
    }
    public function selects($id)
    {
        $products = \App\Product::find($id);
        return view('select', compact('products'));
    }

    public function payment( Request $request)
    {
        // convert cent to USD (1 USD = 100 cent).
        $amount = $request->input('amount')*100;
        \Stripe\Stripe::setApiKey (config('services.stripe.secret'));
        try {
            \Stripe\Charge::create ( array (
                "amount" => $amount,
                "currency" => "USD",
                "source" => $request->input ( 'stripeToken' ), // obtained with Stripe.js
                "description" => "Test payment.",
            ) );
            return redirect()
                ->route('index')
                ->with('msg', "Payment done successfully with " . $request->input('amount') . " $");
        } catch ( \Exception $e ) {
            return redirect()
                ->route('index')
                ->with('error', 'Error !');
        }
    }

    public function select1($id)
    {
        $products = \App\Product::find($id);
        return view('select1', compact('products'));
    }
}
