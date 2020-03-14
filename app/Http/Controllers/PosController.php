<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products as products;
use App\categories as categories;
use App\product_calculations as product_calculations;
use Illuminate\Support\Facades\Auth;
use Excel;
use App\Exports\DailyDataExport;
use App\Mail\CloseDay;
use Illuminate\Support\Facades\Mail;

use DB;
class PosController extends Controller
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

        $data['products'] = DB::table('tbl_product_calculations')->join('tbl_products','tbl_products.id','=',"product_id")->select(DB::raw("SUM(CASE when status = 'sale' THEN stock END) AS amount_sold,SUM(CASE when status = 'buy' THEN stock END) AS amount_bought,name,selling_price,tbl_products.id as id,threshold,SUM(CASE when DATEDIFF ( CURDATE(), tbl_product_calculations.created_at) > 1 and status ='buy' THEN stock END) AS old_stock_add,SUM(CASE when DATEDIFF ( CURDATE(), tbl_product_calculations.created_at) = 0 and status ='sale' THEN stock END) AS sold_today,SUM(CASE when DATEDIFF ( CURDATE(), tbl_product_calculations.created_at) > 1 and status ='sale' THEN stock END) AS old_stock_subtract, tbl_product_calculations.status as status,SUM(CASE when status = 'sale' THEN stock END) AS actual"))->groupBy('tbl_products.id')->orderby('product_id','desc')->get();
        // dd($data);
        $data['categories'] = categories::all();

        return view('pos.index',$data);
    }

    public function stock_calculations(product_calculations $product_calculations,request $request)
    {
        $data = [];

        $stock = [];
        $stock["stock"] =  $request->stock;
        $stock["product_id"] =  $request->product_id;
        $stock["sold_price"] =  $request->sold_price;
        $stock["status"] =  $request->status;
        $stock["responsible"] =  Auth::user()->id;
        $product_calculations->insert($stock);

        return redirect()->back();

    }
    public function export()
    {
        return Excel::download(new DailyDataExport, DATE('d M Y').'.xlsx');
    }
    public function send_mail()
    {
    Mail::to('bit-055-16@must.ac.mw')->send(new CloseDay());
    return back()->withStatus(__('An email has been sent!'));
    }
}
