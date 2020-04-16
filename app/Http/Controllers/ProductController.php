<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Price;
use DB;

class ProductController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')->simplePaginate(25);
        return view('product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $product = new Product;
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->save();
        return redirect('/products')->with('success', 'Product created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $prices = Price::where('product_id', $id)->get();
        return  view('product.show',['product'=> $product, 'prices'=> $prices]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function edit(Request $request, $id)
    {
        if(!$request->user()) {
            return redirect('/login');
        }
        $product = Product::find($id);
        return  view('product.edit')->with('product', $product);
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
        if(!$request->user()) {
            return redirect('/login');
        }
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $product = Product::find($id);
        $product->description = $request->input('description');
        $product->name = $request->input('name');
        $product->save();
        return redirect('/products')->with('success', 'Product update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$request->user()) {
            return redirect('/login');
        }
        $product = Product::find($id);
        $prices = Price::where('product_id', $id)->get();
        if(count($prices) > 0){
            foreach ($prices as $price) {
                $price->delete();     
            }
        }
        $product->delete();
        return redirect('/products')->with('success', 'Product removed');
    }
}
