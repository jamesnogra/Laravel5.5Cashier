<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('home', ['user'=>$user]);
    }

    public function pay(Request $request)
    {
        $user = Auth::user();
        $user->newSubscription($request->plan, $request->plan_id)->withCoupon($request->coupon)->create($request->stripeToken);
        return redirect('/home');
    }

    public function cancel(Request $request)
    {
        $user = Auth::user();
        if ($request->process == "ordinary") {
            $user->subscription($request->plan)->cancel();
        } else if ($request->process == "immediate") {
            $user->subscription($request->plan)->cancelNow();
        }
        return redirect('/home');
    }

    public function invoice(Request $request)
    {
        return $request->user()->downloadInvoice($request->invoice_id, [
            'vendor' => 'Dog Treats',
            'product' => 'Dog Treats Something',
        ]);
    }
}
