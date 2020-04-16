<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;

class PriceController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  int  $porduct_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product_id)
    {
        $this->validate($request, [
            'amount' => 'required'
        ]);
        $product = new Price;
        $product->product_id = $product_id;
        $product->amount = $request->input('amount');
        $product->save();
        return redirect('/products/'.$product_id)->with('success', 'Price created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $product_id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $product_id)
    {
        $price = Price::find($id);
        return  view('price.edit',['price'=> $price, 'productId'=> $product_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $product_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $product_id)
    {
        $this->validate($request, [
            'amount' => 'required'
        ]);
        $product = Price::find($id);
        $product->amount = $request->input('amount');
        $product->save();
        return redirect('/products/'.$product_id)->with('success', 'Price update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $product_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $product_id)
    {
        $product = Price::find($id);
        $product->delete();
        return redirect('/products/'.$product_id)->with('success', 'Price removed');
    }
}
