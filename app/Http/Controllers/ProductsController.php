<?php

namespace App\Http\Controllers;
use App\products as products;
use App\categories as categories;
use App\product_calculations as product_calculations;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct(products $products,categories $categories,product_calculations $product_calculations)
    {
        $this->products = $products;
        $this->categories = $categories;
        $this->product_calculations = $product_calculations;
    }
    public function index()
    {
        $data = [];
        $data['products'] = products::with('categories')->get();
        $data['categories'] = categories::all();

        return view('products.index',$data);
    }

    public function add_product(products $products,request $request,product_calculations $product_calculations)
    {

        // This is inserting main product data
        $product = [];
        $product["name"] =  $request->name;
        $product["buying_price"] =  $request->buying_price;
        $product["selling_price"] =  $request->selling_price;
        $product["category_id"] =  $request->category_id;
        $product["threshold"] =  $request->threshold;
        $products->insert($product);

        $product_id = products::orderby('id','desc')->get()->first()->id;

        $product_calcs = [];
        $product_calcs["product_id"] =  $product_id;
        $product_calcs["stock"] =  0;
        $product_calcs["status"] =  'initial';
        $product_calcs["sold_price"] =  0;
        $product_calcs["responsible"] =  Auth::user()->id;
        $product_calculations->insert($product_calcs);


        return redirect()->back();


    }
    public function edit_product(products $products,request $request)
    {

        // This is inserting main product data
        $product = products::find($request->product_id);
        $product->name =  $request->name;
        $product->buying_price =  $request->buying_price;
        $product->selling_price =  $request->selling_price;
        $product->category_id =  $product->category_id;
        $product->threshold =  $product->threshold;

        $product->save();

        return redirect()->back();


    }
    public function delete_product(products $products,request $request)
    {


        $product = products::find($request->product_id);
        $product->delete();

        return redirect()->back();


    }
}
